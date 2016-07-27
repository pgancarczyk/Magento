<?php 
class Polcode_Productcost_Block_Grid extends Mage_Adminhtml_Block_Catalog_Product_Grid
{
    protected function _prepareColumns()
    {
        $this->addColumnAfter('cost', array(
            'type'      => 'currency',
            'header'    => $this->__("Cost"),
            'align'     => 'right',
            'index'     => 'cost',
            'width'     => '40',
            'sortable'  => false,
            'renderer'  => 'Polcode_Productcost_Block_Renderer'
        ), 'price'); 
        return parent::_prepareColumns();
    }
}