<?php
class Polcode_Multishipping_Block_Adminhtml_Config extends Mage_Adminhtml_Block_Template {
   
    protected $_collection;
    
    public function __construct() {
        $_collection = Mage::getModel('multishipping/multishipping')->getCollection();
        parent::__construct();
    }
    
    public function getPrice($day, $hour) {
        $collection = $this->collection;
        return Mage::getModel('multishipping/multishipping')->getCollection()
                ->addFieldToFilter('day', array('eq' => 1))
                ->addFieldToFilter('hour', array('eq' => 12))
                ->load();
//        return $row;
    }
    
    public function getInputClass($day, $hour) {
        return 'enabled';
    }
    
}