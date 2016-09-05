<?php
class Polcode_Multishipping_Model_Carrier extends Mage_Shipping_Model_Carrier_Abstract implements Mage_Shipping_Model_Carrier_Interface {
    
    protected $_code = 'multishipping';

    public function getAllowedMethods() {
        return array(
            'standard' => 'Standard delivery'
        );
    }
    
    public function collectRates(Mage_Shipping_Model_Rate_Request $request) {
        $result = Mage::getModel('shipping/rate_result');
        $result->append($this->_getStandardRate());
        return $result;
    }
    
    protected function _getStandardRate() {
        $rate = Mage::getModel('shipping/rate_result_method');
        $rate->setCarrier($this->_code);
        $rate->setCarrierTitle($this->getConfigData('title'));
        $rate->setMethod('large');
        $rate->setMethodTitle('Standard delivery');
        $rate->setPrice(69.69);
        $rate->setCost(0);
        
        return $rate;
    }
    
}