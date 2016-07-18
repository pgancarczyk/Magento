<?php
class Polcode_HelloWorld_Block_Pages extends Mage_Core_Block_Template
{
    public function getPages()
    {
        return Mage::getModel('cms/page')->getCollection()->toOptionArray();
    }
}