<?php
class Polcode_ProductLogger_Block_Adminhtml_Main_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
    }
    
    protected function _prepareCollection()
    {
        $collection = Mage::getModel('productlogger/productlogger')->getCollection();
        $this->setCollection($collection);
        parent::_prepareCollection();
        return $this;
    }

    protected function _prepareColumns()
    {
        $this
        ->addColumn('productlogger_id', array(
           'header' => $this->__("Row ID"),
           'index'  => 'productlogger_id',
           'type'   => 'number'
        ))
        ->addColumn('sku', array(
           'header' => $this->__("SKU"),
           'index'  => 'sku',
           'type'   => 'text'
        ))
        ->addColumn('product_id', array(
           'header' => $this->__("Product ID"),
           'index'  => 'product_id',
           'type'   => 'number'
        ))
        ->addColumn('product_name', array(
           'header' => $this->__("Product name"),
           'index'  => 'product_name',
           'type'   => 'text'
        ))
        ->addColumn('price', array(
           'header' => $this->__("Price"),
           'index'  => 'price',
           'type'   => 'currency'
        ))
        ->addColumn('qty', array(
           'header' => $this->__("Quantity"),
           'index'  => 'qty',
           'type'   => 'number'
        ))
        ->addColumn('order_date', array(
           'header' => $this->__("Order date"),
           'index'  => 'order_date',
           'type'   => 'date'
        ));                
        $this->addColumn('action', array(
            'header' => $this->__("Action"),
            'width' => '50px',
            'type' => 'action',
            'actions' => array(
                array(
                    'caption' => $this->__('Edit'),
                    'url' => array( 'base' => 'admin_productlogger/adminhtml_productloggerbackend/edit'),
                    'field' => 'id'
                ),
            ),
            'filter' => false,
            'sortable' => false,
            'index' => 'productlogger_id',
        ));
        
        return parent::_prepareColumns();
    }
    
    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }
}

