<?php
class Polcode_Log_Block_Adminhtml_Main extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {       
        parent::__construct();
        $this->_removeButton('add');
        $this->_blockGroup = 'log';
        $this->_controller = 'adminhtml_main';
        $this->_headerText = $this->__('Database logs');
        
        // test log:
        $helper = Mage::helper('log')->log('cokolwiek', 5);
        
        // test exception:
        $helper = Mage::helper('log')->logException(new Exception("treść", 123));
        
    }
}

