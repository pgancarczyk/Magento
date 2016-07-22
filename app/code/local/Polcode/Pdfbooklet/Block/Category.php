<?php
class Polcode_Pdfbooklet_Block_Category extends Mage_Core_Block_Template
{
    public function getPdf()
    {
        $category_id = Mage::registry('current_category')->getId();
        $category = Mage::getModel('catalog/category')->load($category_id);
        $pdf = $category->getPdfbooklet();
        if($pdf) {
            if ($pdf !== "")
            {
                return '<a target=_blank href="'.Mage::getUrl('media/catalog/category/', array('is_secure' => Mage::app()->getStore()->isCurrentlySecure())).$pdf.'">'.$pdf.'</a>';
            }
        }
        else
        {
            return $this->__("no pdf booklet available for this category");
        }
    }    
}
