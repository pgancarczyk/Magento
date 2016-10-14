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
        // Polcode_Log::log('log test', 5);
        
        // test exception:
        // Polcode_Log::logException(new Exception("exception test", 911));
        
    }
}

