<?php 
class Polcode_Essential_Block_Grid extends Mage_Adminhtml_Block_Catalog_Product_Edit_Tab_Related
{
    protected function _prepareColumns()
    {
        $this->addColumnAfter('essential', array(
            'header'            => 'Essential',
            'name'              => 'essential',
            'type'              => 'number',
            'index'             => 'essential',
            'width'             => 60,
            'editable'          => !$this->_getProduct()->getRelatedReadonly(),
            'edit_only'         => !$this->_getProduct()->getId()
        ), 'position');
        return parent::_prepareColumns();
    }
}