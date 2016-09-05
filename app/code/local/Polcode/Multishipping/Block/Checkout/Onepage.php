<?php
class Polcode_Multishipping_Block_Checkout_Onepage extends Mage_Checkout_Block_Onepage {
 
    public function getSteps()
    {
        $steps = array();
 
        if (!$this->isCustomerLoggedIn()) {
            $steps['login'] = $this->getCheckout()->getStepData('login');
        }
 
        //New Code Adding step excellence here
        $stepCodes = array('billing', 'shipping', 'multishipping', 'shipping_method', 'payment', 'review');
 
        foreach ($stepCodes as $step) {
            $steps[$step] = $this->getCheckout()->getStepData($step);
        }
        return $steps;
    }
 
}