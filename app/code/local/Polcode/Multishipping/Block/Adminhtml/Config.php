<?php
class Polcode_Multishipping_Block_Adminhtml_Config extends Mage_Adminhtml_Block_Template {
   
    protected $_configTable;
    
    public function __construct()
    {
        $collection = Mage::getModel('multishipping/multishipping')->getCollection();
        foreach ($collection as $row)
        {
             $day = $row->getDay();
             $hour = $row->getHour();
             $price = $row->getPrice();
             $limit = $row->getLimit();
             $this->_configTable[$day][$hour]['price'] = $price;
             $this->_configTable[$day][$hour]['limit'] = $limit;
        }
        parent::__construct();
    }
    
    public function getPriceHtml($day, $hour)
    {
        $value = '';
        if (isset($this->_configTable[$day][$hour]['price']))
        {
            $value = $this->_configTable[$day][$hour]['price'];
        }
        return "<input class=price data-multishipping-day=". $day ." data-multishipping-hour=". $hour ." type=text value=". $value .">";
    }
    
    public function getLimitHtml($day, $hour)
    {
        $value = '';
        if (isset($this->_configTable[$day][$hour]['limit']))
        {
            $value = $this->_configTable[$day][$hour]['limit'];
        }
        return "<input class=limit data-multishipping-day=". $day ." data-multishipping-hour=". $hour ." type=text value=". $value .">";
    }
    
    public function getEnabledHtml($day, $hour)
    {
        $selected = $this->getSelected($day, $hour);
        return "<select data-multishipping-day=". $day ." data-multishipping-hour=". $hour ."><option value=enabled". $selected['enabled'] .">". $this->__("Enabled") ."</option><option value=disabled". $selected['disabled'] .">". $this->__("Disabled") ."</option><option ". $selected['default'] .">". $this->__("Default") ."</option></select>";
    }
    
    protected function getSelected($day, $hour) 
    {
        $selected['enabled'] = '';
        $selected['disabled'] = '';
        $selected['default'] = '';        
        if (isset($this->_configTable[$day][$hour]['enabled']))
        {
            switch ($this->_configTable[$day][$hour]['enabled'])
            {
                case 0:
                    $selected['default'] = ' selected';
                case 1:
                    $selected['enabled'] = ' selected';
                case 2:
                    $selected['disabled'] = ' selected';
            }
        }
        else
        {
            $selected['default'] = ' selected';
        }
        return $selected;
    }
    
}                                                