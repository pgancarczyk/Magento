<?php
class Polcode_Multishipping_Block_Adminhtml_Form_Edit_Form extends Mage_Adminhtml_Block_Widget_Form {
    
    public function getFormHtml()
    {
        return $this->getLayout()->createBlock("multishipping/adminhtml_config")->setTemplate("multishipping/config.phtml")->toHtml();
    }
    
}