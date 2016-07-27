<?php
class Polcode_ProductLogger_Block_Adminhtml_Main_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{

    public function __construct()
    {
        parent::__construct();
     
        $this->setId('productlogger_main_form');
        $this->setTitle($this->__('General'));
    }  

    protected function _prepareForm()
    {  

        $model = Mage::registry('productlogger');
     
        $form = new Varien_Data_Form(array(
            'id'        => 'edit_form',
            'action'    => $this->getUrl('*/*/save', array('id' => $this->getRequest()->getParam('id'))),
            'method'    => 'post'
        ));
     
        $fieldset = $form->addFieldset('base_fieldset', array(
            'legend'    => $this->__('General'),
            'class'     => 'fieldset-wide',
        ));
     
        $fieldset->addField('sku', 'text', array(
            'name'      => 'sku',
            'label'     => $this->__('SKU')
        ));
        $fieldset->addField('product_name', 'text', array(
            'name'      => 'product_name',
            'label'     => $this->__('Product name')
        ));
        $fieldset->addField('price', 'text', array(
            'name'      => 'price',
            'label'     => $this->__('Price')
        ));           
        $fieldset->addField('qty', 'text', array(
            'name'      => 'qty',
            'label'     => $this->__('Quantity')
        ));             
        $fieldset->addField('order_date', 'date', array(
            'format' => Mage::app()->getLocale()->getDateFormat(Mage_Core_Model_Locale::FORMAT_TYPE_SHORT),
            'image' => $this->getSkinUrl('images/grid-cal.gif'),
            'name'      => 'order_date',
            'label'     => $this->__('Order date')
        ));                

     
        $form->setValues($model->getData());
        $form->setUseContainer(true);
        $this->setForm($form);
     
        return parent::_prepareForm();
    }  
}    