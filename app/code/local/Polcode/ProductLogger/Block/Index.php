<?php
class Polcode_ProductLogger_Block_Index extends Mage_Core_Block_Template
{
    protected function _prepareLayout()
    {
        parent::_prepareLayout();
        $pager = $this->getLayout()->createBlock('page/html_pager', 'index.pager')
            ->setCollection($this->getProducts());
        $this->setChild('pager', $pager);
        return $this;
    }
    public function getPagerHtml()
    {
        return $this->getChildHtml('pager');
    }
    public function getProducts() {
        $collection = Mage::getModel('productlogger/productlogger')->getCollection()->setPageSize(10)->setCurPage(1);
        if(null !== ($this->getRequest()->getParam('date_from')))
        {
            $collection->addFieldToFilter('order_date', array("from" => $this->getRequest()->getParam('date_from')));
        }
        if(null !== ($this->getRequest()->getParam('date_to')))
        {
            $collection->addFieldToFilter('order_date', array("to" => $this->getRequest()->getParam('date_to')));
        }
        if(null !== ($this->getRequest()->getParam('limit')))
        {
            $collection->setPageSize(intval($this->getRequest()->getParam('limit')));
        }
        if(null !== ($this->getRequest()->getParam('p')))
        {
            $collection->setCurPage(intval($this->getRequest()->getParam('p')));
        }
        return $collection;
    }
    public function getButtonHtml() {
        $button = Mage::app()->getLayout()->createBlock('adminhtml/widget_button');
        $button->setData(array(
            'label' => $this->__('Filter'),
            'type' => 'submit',
            'class' => 'button'
        ));
        return $button->toHtml();
    }
}
