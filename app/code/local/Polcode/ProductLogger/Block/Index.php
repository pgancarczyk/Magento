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
    
    private function validateDate($date)
    {
        if($date)
        {
           list($y, $m, $d) = explode('-', $date);
           if(checkdate($m, $d, $y))
           {
               return $date;
           }           
        }
        return false;
    }   
    
    public function getDateFrom()
    {
        if( $dateFrom = $this->validateDate($this->getRequest()->getParam('date_from')) )
        {
            return date("Y-m-d H:i:s", strtotime($dateFrom));       
        }
        return "";
    }
    
    public function getDateTo()
    {
        if( $dateTo = $this->validateDate($this->getRequest()->getParam('date_to')) )
        {
            return date("Y-m-d H:i:s", strtotime($dateTo)); 
        }
        return "";
    }
    
    public function getCurPage()
    {
        if( $curPage = intval($this->getRequest()->getParam('p')) )
        {
           return $curPage;
        }
        return 1;
    }
    
    public function getPageSize()
    {
        if( $pageSize = intval($this->getRequest()->getParam('limit')) )
        {
           return $pageSize;
        }
        return 10;
    }
    
    public function getPagerHtml()
    {
        return $this->getChildHtml('pager');
    }
    
    public function getProducts()
    {
        $params = $this->getRequest()->getParams();
        $collection = Mage::getModel('productlogger/productlogger')->getCollection();
        if( $this->getDateFrom() )
        {
            $collection->addFieldToFilter('order_date', array("from" => $this->getDateFrom()));
        }
        if( $this->getDateTo() )
        {
            $collection->addFieldToFilter('order_date', array("to" => $this->getDateTo()));
        }
        $collection->setPageSize($this->getPageSize());
        $collection->setCurPage($this->getCurPage());                                 
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
