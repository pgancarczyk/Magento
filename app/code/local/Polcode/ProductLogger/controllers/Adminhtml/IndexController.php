<?php
class Polcode_ProductLogger_Adminhtml_IndexController extends Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {
        Mage::log('dupa');
        $this->loadLayout();
        $this->renderLayout();
    }
}
