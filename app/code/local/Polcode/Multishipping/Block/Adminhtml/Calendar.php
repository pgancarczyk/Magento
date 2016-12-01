<?php
class Polcode_Multishipping_Block_Adminhtml_Calendar extends Mage_Adminhtml_Block_Template {
    
    protected $_orders = array();
    
    public function __construct()
    {
        $orders = Mage::getModel('sales/order')->getCollection()->addFieldToFilter('shipping_date', array('from' => date('Y-m-d H:i:s', time()), 'to' => date('Y-m-d H:i:s', time()+7*24*60*60)))->addFieldToFilter('status', array('neq' => 'canceled'))->addAttributeToSelect('shipping_date')->addAttributeToSelect('increment_id')->addAttributeToSelect('entity_id');
        foreach ($orders as $order) {
            $orderDate = strtotime($order->getShippingDate());
            $orderDay = intval(date('N', $orderDate))-1;
            $orderHour = intval(date('G', $orderDate));            
            if (!isset($this->_orders[$orderDay][$orderHour])) {
                $this->_orders[$orderDay][$orderHour] = array();
            }
            $this->_orders[$orderDay][$orderHour][] = array('url' => Mage::helper('adminhtml')->getUrl("adminhtml/sales_order/view", array('order_id' => $order->getId())), 'id' => $order->getIncrementId());
        }
        
    }    
    
    public function getOrders($day, $hour) {
        if (isset($this->_orders[$day][$hour])) {
            return $this->_orders[$day][$hour];
        }
        else return false;
    }
    
    public function getDays() {
        $timestamp = strtotime('monday this week');
        $days = array();
        for ($i = 0; $i < 7; $i++) {
            $days[] = array('name' => $this->__(date('l', $timestamp)), 'number' => intval(date('N', $timestamp))-1, 'sufix' => $timestamp !== strtotime('today') ? date('jS', $timestamp): $this->__("today"));
            $timestamp = strtotime('+1 day', $timestamp);
        }
        return $days;
    }    
}                                                