<?php 
class Polcode_Productcost_Block_Renderer extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    public function render(Varien_Object $row)
    {
        $value = $row->getPrice()+20;
        return Mage::helper('core')->currency($value, true, false);
    } 
}
