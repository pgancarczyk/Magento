<?php
class Polcode_HelloWorld_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
        $this->loadLayout();
        $this->renderLayout();
    }
    public function storesAction()
    {
        $this->loadLayout();
        $this->renderLayout();
    }
    public function pagesAction()
    {
        $this->loadLayout();
        $this->renderLayout();
    }
}