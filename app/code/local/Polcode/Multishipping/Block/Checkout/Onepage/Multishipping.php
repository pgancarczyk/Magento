<?php
class Polcode_Multishipping_Block_Checkout_Onepage_Multishipping extends Mage_Checkout_Block_Onepage_Abstract {
    
    protected $_configTable;  
    
    protected function _construct()
    {
        $this->getCheckout()->setStepData('multishipping', array(
            'label'     => 'Multishipping',
            'is_show'   => $this->isShow()
        ));
        
        $collection = Mage::getModel('multishipping/multishipping')->getCollection();
        foreach ($collection as $row)
        {
             $day = $row->getDay();
             $hour = $row->getHour();
             $price = $row->getPrice();
             $limit = $row->getLimit();
             $is_enabled = $row->getIsEnabled();
             $this->_configTable[$day][$hour]['price'] = $price;
             $this->_configTable[$day][$hour]['limit'] = $limit;
             $this->_configTable[$day][$hour]['is_enabled'] = $is_enabled;  
        }        
        
        parent::_construct();
    }
    
    public function getRadio($day, $hour)
    {
        if ($price = $this->getPrice($day, $hour)) {
            return '<input class="required-entry multishipping-date" type="button" value="'. $price .'" data-multishipping-value="'. $day ."x". $hour .'">';
        }
    }
    
    protected function getPrice($day, $hour)
    {
        $price = isset($this->_configTable[$day][$hour]['price']) ? $this->_configTable[$day][$hour]['price'] : 0;
        return Mage::helper('core')->currency($price, true, false);
    }
            
}