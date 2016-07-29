<?php 
class Polcode_Essential_Block_Adminhtml_Catalog_Product_Edit_Tab_Related extends Mage_Adminhtml_Block_Catalog_Product_Edit_Tab_Related
{
    protected function _prepareColumns()
    {
        $this->addColumnAfter('essential', array(
            'header'            => $this->__("Essential"),
            'name'              => 'essential',
            'type'              => 'checkbox',
            'index'             => 'essential',
            'values'            => array(1,2),
            'width'             => 60,
            'sortable'          => false,
            'filter'            => false,
            'renderer'          => 'Polcode_Essential_Block_Adminhtml_Catalog_Product_Edit_Tab_Renderer',            
            'editable'          => !$this->_getProduct()->getRelatedReadonly(),
            'edit_only'         => !$this->_getProduct()->getId()
        ), 'position');

        return parent::_prepareColumns();
    }

    public function getSelectedRelatedProducts()
    {
        $products = array();
        foreach (Mage::registry('current_product')->getRelatedProducts() as $product) {
            $products[$product->getId()] = array('position' => $product->getPosition(), 'essential' => $product->getEssential());
        }
        return $products;
    }
}
