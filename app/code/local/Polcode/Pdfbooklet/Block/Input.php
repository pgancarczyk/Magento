<?php
class Polcode_Pdfbooklet_Block_Input extends Mage_Adminhtml_Block_Customer_Form_Element_File
{
    public function getElementHtml()
    {
        $this->addClass('input-file');
        if ($this->getRequired()) {
            $this->removeClass('required-entry');
            $this->addClass('required-file');
        }

        $element = sprintf('<input id="%s" name="%s" %s accept="%s" />%s%s',
            $this->getHtmlId(),
            'pdfbooklet',
            $this->serialize($this->getHtmlAttributes()),
            '.pdf',
            $this->getAfterElementHtml(),
            $this->_getHiddenInput()
        );

        return $this->_getPreviewHtml() . $element . $this->_getDeleteCheckboxHtml();
    }
    
    protected function _getPreviewHtml()
    {
        $html = '';
        if ($this->getValue() && !is_array($this->getValue())) {
            $image = array(
                'alt'   => Mage::helper('adminhtml')->__('Download'),
                'title' => Mage::helper('adminhtml')->__('Download'),
                'src'   => Mage::getDesign()->getSkinUrl('images/pdfbooklet.png'),
                'class' => 'v-middle'
            );
            $url = $this->_getPdfUrl();
            $html .= '<span>';
            $html .= '<a target="_blank" href="' . $url . '">' . $this->_drawElementHtml('img', $image) . '</a> ';
            $html .= '<a target="_blank" href="' . $url . '">' . $this->getValue() . '</a>';
            $html .= '</span>';
        }
        return $html;
    }

    protected function _getPdfUrl()
    {
        return Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA, array('is_secure' => Mage::app()->getStore()->isCurrentlySecure())).'booklets/'.$this->getValue();
    }
}