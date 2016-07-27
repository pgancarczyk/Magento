<?php
class Polcode_ProductLogger_Block_Adminhtml_Main extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {       
        $this->_addButtonLabel = $this->__('New log entry');
        parent::__construct();
        
        $this->_blockGroup = 'productlogger';
        $this->_controller = 'adminhtml_main';
        $this->_headerText = $this->__('Edit logs');
    }
}

