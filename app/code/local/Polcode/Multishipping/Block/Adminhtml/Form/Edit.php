<?php
class Polcode_Multishipping_Block_Adminhtml_Form_Edit extends Mage_Adminhtml_Block_Widget_Form_Container {
    
    protected $_headerText = 'Multishipping configuration';
    
    public function __construct()
    {
        parent::__construct(); 
        $this->_objectId = 'dupa8';
        $this->_blockGroup = 'multishipping';
        $this->_controller = 'adminhtml_form';
         
        $this->_updateButton('save', 'label', 'Save');
        $this->_updateButton('delete', 'label', 'Delete');
         
        $this->_addButton('saveandcontinue', array(
            'label'     => 'Save And Continue Edit',
            'onclick'   => 'saveAndContinueEdit()',
            'class'     => 'save',
        ), -100);
    }
}