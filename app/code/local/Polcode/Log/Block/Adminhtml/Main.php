<?php
class Polcode_Log_Block_Adminhtml_Main extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {       
        Mage::log('test');
        $this->_addButtonLabel = $this->__('New log entry');
        parent::__construct();
        
        $this->_blockGroup = 'log';
        $this->_controller = 'adminhtml_main';
        $this->_headerText = $this->__('Edit logs');
    }
}

