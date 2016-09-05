<?php
require_once 'Mage/Checkout/controllers/OnepageController.php';
class Polcode_Multishipping_OnepageController extends  Mage_Checkout_OnepageController {
    public function saveMultishippingAction(){
        if ($this->_expireAjax()) {
            return;
        }
        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getPost('multishipping', array());
 
            $result = $this->getOnepage()->saveMultishipping($data);
 
            if (!isset($result['error'])) {
                $result['goto_section'] = 'shipping_method';
            }
 
            $this->getResponse()->setBody(Mage::helper('core')->jsonEncode($result));
        }
    }
}