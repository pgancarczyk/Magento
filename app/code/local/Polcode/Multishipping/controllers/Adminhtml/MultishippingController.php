<?php
class Polcode_Multishipping_Adminhtml_MultishippingController extends Mage_Adminhtml_Controller_Action
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
    
    public function saveAction() {
        $updateTable = array();
        if (!$this->_validateFormKey()) {
            return $this->_redirect('*/*/');
        }
        foreach ($this->getRequest()->getParams() as $key => $value)
        {
            if ($value)
            {
                $parts = explode("x", $key);
                switch($parts[0]) {
                    case "e":
//                        Mage::getModel('multishipping/multishipping')->getCollection()->addFieldToFilter('day', array('eq' => $parts[1]))->addFieldToFilter('hour', array('eq' => $parts[2]))->load()->getFirstItem()->setLimit($value)->save();
                        break;
                    case "l":
                        Mage::getModel('multishipping/multishipping')->getCollection()->addFieldToFilter('day', array('eq' => $parts[1]))->addFieldToFilter('hour', array('eq' => $parts[2]))->load()->getFirstItem()->setLimit($value)->setDay($parts[1])->setHour($parts[2])->save();
                        echo $parts[2]." ";
                        break;
                    case "p":
                        Mage::getModel('multishipping/multishipping')->getCollection()->addFieldToFilter('day', array('eq' => $parts[1]))->addFieldToFilter('hour', array('eq' => $parts[2]))->load()->getFirstItem()->setPrice($value)->setDay($parts[1])->setHour($parts[2])->save();
                }
            }
        }
        return $this->_redirect('adminhtml/multishipping/config');
    }
}

