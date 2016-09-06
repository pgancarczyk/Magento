<?php
class Polcode_Multishipping_Block_Checkout_Onepage extends Mage_Checkout_Block_Onepage {
 
    public function getSteps()
    {
        $steps = array();
        $stepCodes = array('login', 'billing', 'shipping', 'multishipping', 'shipping_method', 'payment', 'review');

        if ($this->isCustomerLoggedIn()) {
            $stepCodes = array_diff($stepCodes, array('login'));
        }

        foreach ($stepCodes as $step) {
            $steps[$step] = $this->getCheckout()->getStepData($step);
        }

        return $steps;
    }
 
}