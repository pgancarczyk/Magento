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
    public function getDateFrom()
    {
        return ( $this->getRequest()->getParam('date_from') ? $this->getRequest()->getParam('date_from') : "");  
    }
    public function getDateTo()
    {
        return ( $this->getRequest()->getParam('date_to') ? $this->getRequest()->getParam('date_to') : "");  
    }
    public function getCurPage()
    {
        return $this->getRequest()->getParam('p');
    }
    public function getPageSize()
    {
        return $this->getRequest()->getParam('limit');
    }
    public function getPagerHtml()
    {
        return $this->getChildHtml('pager');
    }
    public function getProducts()
    {
        $params = $this->getRequest()->getParams();
        $collection = Mage::getModel('productlogger/productlogger')->getCollection()->setPageSize(10)->setCurPage(1);
        if( $this->getDateFrom() )
        {
            $collection->addFieldToFilter('order_date', array("from" => date("Y-m-d H:i:s", strtotime($this->getDateFrom()))));
        }
        if( $this->getDateTo() )
        {
            $collection->addFieldToFilter('order_date', array("to" => date("Y-m-d H:i:s", strtotime($this->getDateTo()))));
        }
        if( $this->getPageSize() )
        {
            $collection->setPageSize(intval($this->getPageSize()));
        }
        if( $this->getCurPage() )
        {
            $collection->setCurPage(intval($this->getCurPage()));                                 
        }
        return $collection;
    }
    public function getButtonHtml()
    {
        $button = Mage::app()->getLayout()->createBlock('adminhtml/widget_button');
        $button->setData(array(
            'label' => $this->__('Filter'),
            'type' => 'submit',
            'class' => 'button'
        ));
        return $button->toHtml();
    }
}
