<?php
class Polcode_ProductLogger_Model_Observer extends Mage_Core_Model_Abstract
{
    public function orderPlaced(Varien_Event_Observer $observer)
    {
        $order = $observer->getEvent()->getOrder();
        $items = $order->getAllVisibleItems();
        foreach($items as $item){
            $sku = $item->getSku();
            $skuToCheck = Mage::getStoreConfig('productlogger/messages/sku'); 
            if ($sku !== $skuToCheck)
            {
                continue;
            }
            $model = Mage::getModel('productlogger/productlogger');
            $model->setSku($sku)
            ->setProductId($item->getItemId())
            ->setProductName($item->getName())
            ->setPrice($item->getPrice())
            ->setQty($item->getQtyOrdered())
            ->setOrderDate($item->getCreatedAt())
            ->save();                 
        }
    }
}
