<?php
class Polcode_Multishipping_Block_Checkout_Onepage_Multishipping extends Mage_Checkout_Block_Onepage_Abstract {
    protected function _construct()
    {
        $this->getCheckout()->setStepData('multishipping', array(
            'label'     => 'Multishipping',
            'is_show'   => $this->isShow()
        ));
        if ($this->isCustomerLoggedIn()) {
            $this->getCheckout()->setStepData('multishipping', 'allow', true);
            $this->getCheckout()->setStepData('shipping_method', 'allow', false);
        }
 
        parent::_construct();
    }
}