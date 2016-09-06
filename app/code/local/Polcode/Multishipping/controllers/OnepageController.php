<?php
require_once 'Mage/Checkout/controllers/OnepageController.php';
class Polcode_Multishipping_OnepageController extends  Mage_Checkout_OnepageController {
    public function saveMultishippingAction() {
        Mage::log('dsupadasd');
        if ($this->_expireAjax()) {
            return;
        }
        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getPost('multishipping', array());
            Mage::log(json_encode($data));
//            $result = $this->getOnepage()->saveMultishipping($data);
            $result = array();
            Mage::log(json_encode($data));
            Mage::getSingleton('core/session')->setMultishippingDate($data['date']); // do zmiany
            Mage::getSingleton('core/session')->setMultishippingCost(30.5); // do zmiany
            
            $result['goto_section'] = 'shipping_method';
 
            $this->getResponse()->setBody(Mage::helper('core')->jsonEncode($result));
        }
    }
    
    /**
     * Save checkout billing address
     */
    public function saveBillingAction()
    {
        if ($this->_expireAjax()) {
            return;
        }
        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getPost('billing', array());
            $customerAddressId = $this->getRequest()->getPost('billing_address_id', false);

            if (isset($data['email'])) {
                $data['email'] = trim($data['email']);
            }
            $result = $this->getOnepage()->saveBilling($data, $customerAddressId);

            if (!isset($result['error'])) {
                if ($this->getOnepage()->getQuote()->isVirtual()) {
                    $result['goto_section'] = 'payment';
                    $result['update_section'] = array(
                        'name' => 'payment-method',
                        'html' => $this->_getPaymentMethodsHtml()
                    );
                } elseif (isset($data['use_for_shipping']) && $data['use_for_shipping'] == 1) {
                    $result['goto_section'] = 'multishipping';
                    $result['update_section'] = array(
                        'name' => 'shipping-method',
                        'html' => $this->_getShippingMethodsHtml()
                    );

                    $result['allow_sections'] = array('shipping');
                    $result['duplicateBillingInfo'] = 'true';
                } else {
                    $result['goto_section'] = 'shipping';
                }
            }

            $this->getResponse()->setBody(Mage::helper('core')->jsonEncode($result));
        }
    }

    /**
     * Shipping address save action
     */
    public function saveShippingAction()
    {
        if ($this->_expireAjax()) {
            return;
        }
        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getPost('shipping', array());
            $customerAddressId = $this->getRequest()->getPost('shipping_address_id', false);
            $result = $this->getOnepage()->saveShipping($data, $customerAddressId);

            if (!isset($result['error'])) {
                $result['goto_section'] = 'multishipping';
//                $result['update_section'] = array(
//                    'name' => 'shipping-method',
//                    'html' => $this->_getShippingMethodsHtml()
//                );
            }
            $this->getResponse()->setBody(Mage::helper('core')->jsonEncode($result));
        }
    }
    
}