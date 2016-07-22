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
                return '<a target=_blank href="'.Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA, array('is_secure' => Mage::app()->getStore()->isCurrentlySecure())).'/booklets/'.$pdf.'">'.$pdf.'</a>';
            }
        }
        else
        {
            return $this->__("no pdf booklet available for this category");
        }
    }    
}
