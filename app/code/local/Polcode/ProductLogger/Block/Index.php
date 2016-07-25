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
    public function getInputValue($parameter)
    {
        return ( $this->getRequest()->getParam($parameter) ? $this->getRequest()->getParam($parameter) : "");
    }
    public function getPagerHtml()
    {
        return $this->getChildHtml('pager');
    }
    public function getProducts()
    {
        $params = $this->getRequest()->getParams();
        $collection = Mage::getModel('productlogger/productlogger')->getCollection()->setPageSize(10)->setCurPage(1);
        if( isset($params['date_from']) )
        {
            $collection->addFieldToFilter('order_date', array("from" => date("Y-m-d H:i:s", strtotime($params['date_from']))));
        }
        if( isset($params['date_to']) )
        {
            $collection->addFieldToFilter('order_date', array("to" => date("Y-m-d H:i:s", strtotime($params['date_to']))));
        }
        if( isset($params['limit']) )
        {
            $collection->setPageSize(intval($params['limit']));
        }
        if( isset($params['p']) )
        {
            $collection->setCurPage(intval($params['p']));                                 
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
