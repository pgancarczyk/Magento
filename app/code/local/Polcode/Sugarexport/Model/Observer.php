<?php
class Polcode_Sugarexport_Model_Observer
{
    private $_url;
    private $_username;
    private $_password;
    private $_sessionId;
    
    public function export()
    {
        $this->_url = $this->getUrl();
        $this->_username = $this->getUsername();
        $this->_password = $this->getPassword();   

        $this->_sessionId = $this->login();

        $notesResult = $this->getNotes();

        $importedCustomersIDs = array();

        foreach ($notesResult->entry_list as $entry)
        {
            $importedCustomersIDs[$entry->name_value_list->description->value] = true;
        }

        $users = $this->getUsersCollection();

        $usersToInsert = array();
        $notesToInsert = array();

        foreach ($users as $user)
        {
            if (!isset($importedCustomersIDs[$user->getId()]))
            {
                array_push($usersToInsert, array(
                    array("name" => "first_name", "value" => $user->getFirstname()),
                    array("name" => "last_name", "value" => $user->getLastname()),
                    array("name" => "phone_office", "value" => $user->getBillingTelephone()),
                    array("name" => "email", "value" => $user->getEmail()),
                ));
                array_push($notesToInsert, array(
                      array("name" => "name", "value" => "Magento Customer ID"),
                      array("name" => "description", "value" => $user->getID()),
                ));
            }
        }

        $contactsResult = $this->addContacts($usersToInsert);

        foreach ($notesToInsert as $index => &$note)
        {
            array_push($note, array(
                "name" => "contact_id",
                "value" => $contactsResult->ids[$index],
            ));
        }

        $this->addNotes($notesToInsert);
        
        return 'Exported ' . count($usersToInsert) . ' customers.';
    }
    
    protected function call($method, $parameters, $url)
    {
        ob_start();
        $curl_request = curl_init();

        curl_setopt($curl_request, CURLOPT_URL, $url);
        curl_setopt($curl_request, CURLOPT_POST, 1);
        curl_setopt($curl_request, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);
        curl_setopt($curl_request, CURLOPT_HEADER, 1);
        curl_setopt($curl_request, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl_request, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_request, CURLOPT_FOLLOWLOCATION, 0);

        $jsonEncodedData = json_encode($parameters);

        $post = array(
             "method" => $method,
             "input_type" => "JSON",
             "response_type" => "JSON",
             "rest_data" => $jsonEncodedData
        );

        curl_setopt($curl_request, CURLOPT_POSTFIELDS, $post);
        $result = explode("\r\n\r\n", curl_exec($curl_request), 2);
        curl_close($curl_request);
        $response = json_decode($result[1]);
        ob_end_flush();

        return $response;
    } 
    
    protected function getUrl()
    {
        $url = Mage::getStoreConfig('sugarexport/messages/url');
        return rtrim($url, '/') . '/service/v4_1/rest.php';
    }

    protected function getUsername()
    {
        return Mage::getStoreConfig('sugarexport/messages/username');
    }

    protected function getPassword()
    {
        return Mage::getStoreConfig('sugarexport/messages/password');
    }
    
    protected function login()
    {
        $loginResult = $this->call("login", array(
             "user_auth" => array(
                  "user_name" => $this->_username,
                  "password" => md5($this->_password),
                  "version" => "1"
             ),
             "application_name" => "Magento Import",
             "name_value_list" => array(),
        ), $this->_url);
        return $loginResult->id;
    }
    
    protected function getNotes()        
    {
        return $this->call('get_entry_list', array(
            'session' => $this->_sessionId,
            'module_name' => 'Notes',
            'query' => "name = 'Magento Customer ID'",
        ), $this->_url);
    }
    
    protected function addContacts($contacts)
    {
        return $this->call("set_entries", array(
            "session" => $this->_sessionId,
            "module_name" => "Contacts",
            "name_value_list" => $contacts,
        ), $this->_url);
    }
    
    protected function addNotes($notes)
    {
        return $this->call("set_entries", array(
                 "session" => $this->_sessionId,
                 "module_name" => "Notes",
                 "name_value_list" => $notes,
        ), $this->_url);        
    }
    
    protected function getUsersCollection()
    {
        return mage::getModel('customer/customer')->getCollection()
                ->addAttributeToSelect('id')
                ->addAttributeToSelect('firstname')
                ->addAttributeToSelect('lastname')
                ->addAttributeToSelect('email')
                ->joinAttribute('billing_telephone', 'customer_address/telephone', 'default_billing', null, 'left');        
    }
    
}