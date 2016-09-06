<?php
class Polcode_Multishipping_Model_Observer
{
    public function addDeliveryDate(Varien_Event_Observer $observer)
    {
        $date = explode("x", Mage::getSingleton('core/session', array('name' => 'frontend'))->getMultishippingDate());
        $day = $date[0];
        $hour = $date[1];
        $weekdays = array('monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday');
        $finalDate = new DateTime();
        $finalDate->modify('next '.$weekdays[$day]);
        $finalDate->modify('+'.$hour.' hours');
        $order = $observer->getEvent()->getOrder();
        $order->setShippingDate($finalDate->format("Y-m-d H:i:s"));
        $order->save();
    }
}