<?php
class Polcode_Log_Block_Adminhtml_Main_Renderer extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    public function render(Varien_Object $row)
    {
        $value = $row->getData($this->getColumn()->getIndex());
        return '<code>' . $value . '</code>';
    }
    public function renderExport(Varien_Object $row)
    {
        $value = $row->getData($this->getColumn()->getIndex());
        return $value;
    }
}