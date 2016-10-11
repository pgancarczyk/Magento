<?php
class Polcode_Log_Adminhtml_LogController extends Mage_Adminhtml_Controller_Action
{
    protected function _initAction()
    {
        $this->loadLayout()
            ->_setActiveMenu('system/log');
        return $this;
    }
    public function indexAction()
    {
        $this->loadLayout();
        $this->_initAction();
        $this->_addContent($this->getLayout()->createBlock('log/adminhtml_main'));
        echo 'dupa';
        $this->renderLayout();
    }
}