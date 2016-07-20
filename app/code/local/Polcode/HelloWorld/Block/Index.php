<?php
class Polcode_HelloWorld_Block_Index extends Mage_Core_Block_Template
{
    public function getUrl($action)
    {
        return Mage::getUrl('helloworld/index/'.$action, array('is_secure' => Mage::app()->getStore()->isCurrentlySecure()));
    }
}
