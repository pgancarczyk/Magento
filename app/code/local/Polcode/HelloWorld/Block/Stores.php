<?php
class Polcode_HelloWorld_Block_Stores extends Mage_Core_Block_Template
{
    public function getWebsites()
    {
        return Mage::app()->getWebsites();
    }
}