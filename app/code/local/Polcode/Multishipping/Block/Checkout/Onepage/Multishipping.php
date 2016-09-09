<?php
class Polcode_Multishipping_Block_Checkout_Onepage_Multishipping extends Mage_Checkout_Block_Onepage_Abstract {
    
    protected $_configTable;
    const DEFAULT_WEEK = 7; // 8th weekday = default for the entire week
    const DEFAULT_WEEKDAY = 24; // 25th hour of a day = default for a single weekday
    const SELECT_DISABLED = 2;
    const SELECT_ENABLED = 1;
    const SELECT_DEFAULT = 0;    
    
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
             $limit = $row->getLimit() ? intval($row->getLimit()): 0;
             $is_enabled = $row->getIsEnabled();
             $this->_configTable[$day][$hour]['price'] = $price;
             $this->_configTable[$day][$hour]['limit'] = $limit;
             $this->_configTable[$day][$hour]['is_enabled'] = $is_enabled;  
        }
        $orders = Mage::getModel('sales/order')->getCollection()->addFieldToFilter('shipping_date', array('from' => date('Y-m-d H:i:s', time()), 'to' => date('Y-m-d H:i:s', time()+7*24*60*60)))->addFieldToFilter('status', array('neq' => 'canceled'))->addAttributeToSelect('shipping_date');
        foreach ($orders as $order)
        {
            $orderDate = strtotime($order->getShippingDate());
            $orderDay = intval(date('N', $orderDate))-1;
            $orderHour = intval(date('G', $orderDate));
            if (isset($this->_configTable[$orderDay][$orderHour]['limit'])) {
                $this->_configTable[$orderDay][$orderHour]['limit']--;
            }
        }
        
        parent::_construct();
    }
    
    public function getRadio($day, $hour)
    {
        if ($price = $this->getPrice($day, $hour)) {
            return '<!-- '.$this->_configTable[$day][$hour]['limit'].' --><input class="required-entry multishipping-date" type="button" value="'. $price .'" data-multishipping-value="'. $day ."x". $hour .'">';
        }
    }
    
    protected function getPrice($day, $hour)
    {
        $price = isset($this->_configTable[$day][$hour]['price']) ? Mage::helper('core')->currency($this->_configTable[$day][$hour]['price'], true, false) : 0;
//        $limit = $this->getLimit($day, $hour);
//        $is_enabled->$this->getIsEnabled($day, $hour);
//        if (isset($this->_configTable[$day][$hour]['limit']) and isset($this->_configTable[$day][$hour]['is_enabled'])) {
//            if (intval($this->_configTable[$day][$hour]['limit']) > 0 and intval($this->_configTable[$day][$hour]['is_enabled']) !== self::SELECT_DISABLED) {
//                return $price;
//            }
//        }
//        return false;
        if (isset($this->_configTable[$day][$hour]['limit'])) {
            if (intval($this->_configTable[$day][$hour]['limit']) > 0) {
                return $price;
            }
        }
        return false;        
    }
    
//    protected function getLimit($day, $hour)
//    {
//        
//    }
    
//    protected function getFieldValue($day, $hour, $field) {
//        if (isset($this->_configTable[$day][$hour][$field])) {
//            return $this->_configTable[$day][$hour][$field];
//        }
//        if ($field == 'is_enabled') {
//            return false;
//        }
//        if ($this->getFieldValue($day, $hour, 'is_enabled') == self::SELECT_DEFAULT) {
//            return $this->getFieldValue($day, self::DEFAULT_WEEKDAY, $field)
//        }
//    }
            
}