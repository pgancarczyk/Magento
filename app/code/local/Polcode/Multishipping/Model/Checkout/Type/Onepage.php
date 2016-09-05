<?php
class Polcode_Multishipping_Model_Checkout_Type_Onepage extends Mage_Checkout_Model_Type_Onepage {
    public function saveMultishipping($data){
        if (empty($data)) {
            return array('error' => -1, 'message' => $this->_helper->__('Invalid data.'));
        }
        $this->getQuote()->setMultishipping($data['day'].":".$data['hour']);
        $this->getQuote()->collectTotals();
        $this->getQuote()->save();
 
        $this->getCheckout()
        ->setStepData('multishipping', 'allow', true)
        ->setStepData('multishipping', 'complete', true)
        ->setStepData('shipping_method', 'allow', true);
 
        return array();
    }
}