<?php
class Polcode_Multishipping_Adminhtml_MultishippingController extends Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {
        $this->_redirect('adminhtml');
    }
    
    public function configAction()
    {
        $this->loadLayout();
        $this->_addContent($this->getLayout()->createBlock('multishipping/adminhtml_form_edit'));
        $this->renderLayout();
    }
    
    public function calendarAction()
    {
        $this->loadLayout();
        $this->renderLayout();
    }    
    
    public function saveAction() {
        $updateTable = array();
        if (!$this->_validateFormKey()) {
            return $this->_redirect('*/*/');
        }
//        echo "<code>";
//        echo json_encode($this->getRequest()->getParam('table'), JSON_PRETTY_PRINT);
//        echo "</code>";
//        die;
        foreach ($this->getRequest()->getParam('table') as $day => $hours) {
            foreach($hours as $hour => $values) {
                $model = Mage::getModel('multishipping/multishipping')->getCollection()
                        ->addFieldToFilter('day', array('eq' => $day))->addFieldToFilter('hour', array('eq' => $hour))
                        ->load()->getFirstItem();
                
                if ($values['limit']) $model->setLimit($values['limit']);
                if ($values['price']) $model->setPrice($values['price']);
                if ($values['is_enabled']) $model->setIsEnabled($values['is_enabled']);
                
                $model->setDay($day)->setHour($hour);
                $model->save();
            }
        }
        return $this->_redirect('adminhtml/multishipping/config');
    }
}

