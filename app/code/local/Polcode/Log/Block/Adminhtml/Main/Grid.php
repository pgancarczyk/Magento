<?php
class Polcode_Log_Block_Adminhtml_Main_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
    }
    
    protected function _prepareCollection()
    {
        $collection = Mage::getModel('polcode_log/log')->getCollection();
        $this->setCollection($collection);
        parent::_prepareCollection();
        return $this;
    }

    protected function _prepareColumns()
    {
        $this
        ->addColumn('log_id', array(
           'header'     => $this->__("Entry ID"),
           'index'      => 'log_id',
           'type'       => 'number'
        ))
        ->addColumn('log_text', array(
           'header'     => $this->__("Value"),
           'index'      => 'log_text',
           'type'       => 'text',
           'renderer'   => 'Polcode_Log_Block_Adminhtml_Main_Renderer'
        ))
        ->addColumn('log_level', array(
           'header'     => $this->__("Level"),
           'index'      => 'log_level',
           'type'       => 'options',
           'options'    => Mage::getSingleton('polcode_log/system_config_source_level')->toArray()
        ))                
        ->addColumn('created_at', array(
           'header'     => $this->__("Date logged"),
           'index'      => 'created_at',
           'type'       => 'datetime'
        ))
        ->addExportType('*/*/exportCsv', 'CSV');
        
        return parent::_prepareColumns();
    }
    
}
