<?php 
class Polcode_Essential_Block_Adminhtml_Catalog_Product_Edit_Tab_Renderer extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Checkbox
{  
    protected function _getCheckboxHtml($value, $checked)
    {
        $html = '<input type="checkbox" ';
        $html .= 'onclick="this.value = this.checked ? 1 : 0;" ';
        $html .= 'name="essential" ';
        $html .= 'value="' . $this->escapeHtml($value) . '" ';
        $html .= 'class="'. ($this->getColumn()->getInlineCss() ? $this->getColumn()->getInlineCss() : 'checkbox') .'"';
        $html .= $checked . '/>';
        return $html;
    }   
}