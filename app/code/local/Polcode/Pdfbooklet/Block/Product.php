<?php
class Polcode_Pdfbooklet_Block_Product extends Mage_Core_Block_Template
{
    public function getPdf()
    {
        $product = Mage::registry('current_product');
        $pdf = $product->getPdfbooklet();
        if($pdf)
        {
            return Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA, array('is_secure' => $this->_isSecure())).'booklets/'.$pdf;
        }
        else {
            return "";
        }
    }    
}
