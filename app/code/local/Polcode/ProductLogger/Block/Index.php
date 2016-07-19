<?php
class Polcode_ProductLogger_Block_Index extends Mage_Core_Block_Template
{
    public function getProducts() {
        $collection = Mage::getModel('productlogger/productlogger')->getCollection();
        return $collection;
    }
}
