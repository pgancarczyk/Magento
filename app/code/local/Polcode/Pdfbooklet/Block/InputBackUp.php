<?php
class Polcode_Pdfbooklet_Block_Input extends Varien_Data_Form_Element_Abstract
{
    public function getElementHtml()
    {
        $pdf = $this->getValue();
        $html = "";
        if($pdf)
        {
            $html .= '<p><img src="'. Mage::getDesign()->getSkinUrl('images/pdfbooklet.png') . '" alt="pdfbooklet" class="v-middle">';
            $html .= ' ' . $pdf . '</p>';
            $html .= '<input name="pdfbooklet" class="input-file" type="file" accept=".pdf">';
            $html .= '<span class="delete-file">';
            $html .= '<input id="pdfbooklet-delete" type="checkbox" name="general[pdfbooklet][delete]" value="1" class="checkbox">';
            $html .= '<label for="pdfbooklet-delete">Delete file</label></span>';
            return $html;
        }
        $html .= '<input name="pdfbooklet" class="input-file" type="file" accept=".pdf">';
        return $html;
    }
}