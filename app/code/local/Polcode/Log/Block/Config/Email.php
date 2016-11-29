<?php
class Polcode_Log_Block_Config_Email extends Mage_Adminhtml_Block_System_Config_Form_Field_Array_Abstract
{
    public function _prepareToRender()
    {
        $this->addColumn('email_address', array(
            'label'     => 'E-mail address',
            'class'     => 'input-text required-entry validate-email',
            'style'     => 'width: 200px',
        ));     

        $this->_addAfter = false;
        $this->_addButtonLabel = 'Add';
    }

}