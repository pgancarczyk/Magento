<?php
class Polcode_Pdfbooklet_Block_Category extends Mage_Core_Block_Template
{
    public function getPdf()
    {
        $category = Mage::registry('current_category');
        $pdf = $category->getPdfbooklet();
        if($pdf)
        {
            return Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA, array('is_secure' => $this->_isSecure())).'booklets/'.$pdf;
        }
        else
        {
            return "";
        }
    }    
}
