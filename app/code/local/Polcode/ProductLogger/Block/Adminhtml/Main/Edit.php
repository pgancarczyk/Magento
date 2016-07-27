<?php
class Polcode_ProductLogger_Block_Adminhtml_Main_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
   public function __construct()
    {
        $this->_objectId = 'id';
        $this->_blockGroup = 'productlogger';
        $this->_controller = 'adminhtml_main';
     
        parent::__construct();
     
        $this->_updateButton('save', 'label', $this->__('Save'));
        $this->_updateButton('delete', 'label', $this->__('Delete'));
    }  

    public function getHeaderText()
    {
        if (Mage::registry('productlogger')->getId()) {
            return $this->__('Edit');
        }  
        else {
            return $this->__('New');
        }  
    }         
}
