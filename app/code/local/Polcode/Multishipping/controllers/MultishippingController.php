<?php
class Polcode_Multishipping_MultishippingController extends Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {
        $this->_redirect('adminhtml');
    }
    
    public function configAction()
    {
        $this->loadLayout();
        $this->_addContent($this->getLayout()->createBlock('multishipping/adminhtml_form_edit'));
        $this->renderLayout();
    }
    
    public function calendarAction()
    {
        $this->loadLayout();
        $this->renderLayout();
    }    
    
}

