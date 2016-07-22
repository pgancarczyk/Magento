<?php
class Polcode_Pdfbooklet_Block_Product extends Mage_Core_Block_Template
{
    public function getPdf()
    {
        $product_id = Mage::registry('current_product')->getId();
        $product = Mage::getModel('catalog/product')->load($product_id);
        $pdf = $product->getPdfbooklet();
        if($pdf) {
            if ($pdf !== "")
            {
                return '<a target=_blank href="'.Mage::getUrl('media/catalog/product/', array('is_secure' => Mage::app()->getStore()->isCurrentlySecure())).$pdf.'">'.$pdf.'</a>';
            }
        }
        else
        {
            return $this->__("no pdf booklet available for this product");
        }
    }    
}
