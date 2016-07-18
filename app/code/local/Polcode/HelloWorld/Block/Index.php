<?php
class Polcode_HelloWorld_Block_Index extends Mage_Core_Block_Template
{
    public function getLinkStoresName()
    {
        return "List stores";
    }
    public function getLinkPagesName()
    {
        return "List static pages";
    }
    public function getUrl($action)
    {
        return Mage::getUrl('helloworld/index/'.$action, array('is_secure' => Mage::app()->getStore()->isCurrentlySecure()));
    }
}
