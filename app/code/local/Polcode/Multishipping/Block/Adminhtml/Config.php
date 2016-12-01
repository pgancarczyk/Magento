<?php
class Polcode_Multishipping_Block_Adminhtml_Config extends Mage_Adminhtml_Block_Template {
   
    protected $_configTable;
    const SELECT_DISABLED = 2;
    const SELECT_ENABLED = 1;
    const SELECT_DEFAULT = 0;
    
    public function __construct()
    {
        $collection = Mage::getModel('multishipping/multishipping')->getCollection();
        foreach ($collection as $row)
        {
            $day = $row->getDay();
            $hour = $row->getHour();
            $price = $row->getPrice();
            $limit = $row->getLimit();
            $is_enabled = $row->getIsEnabled();
            $this->_configTable[$day][$hour]['price'] = $price;
            $this->_configTable[$day][$hour]['limit'] = $limit;
            $this->_configTable[$day][$hour]['is_enabled'] = $is_enabled;
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
        return "<input name='table[". $day ."][". $hour . "][price]' class=price data-multishipping-day=". $day ." data-multishipping-hour=". $hour ." data-multishipping-value='". $value ."' type=text value=". $value .">";
    }
    
    public function getLimitHtml($day, $hour)
    {
        $value = '';
        if (isset($this->_configTable[$day][$hour]['limit']))
        {
            $value = $this->_configTable[$day][$hour]['limit'];
        }
        return "<input name='table[". $day ."][". $hour . "][limit]' class=limit data-multishipping-day=". $day ." data-multishipping-hour=". $hour ." data-multishipping-value='". $value ."' type=text value=". $value .">";
    }
    
    public function getEnabledHtml($day, $hour)
    {
        $selected = $this->getSelected($day, $hour);
        if ($day !== 7) {  // TODO: set default value for 0, 7 is_enabled select in config.xml
            return "<select name='table[". $day ."][". $hour . "][is_enabled]' class=is_enabled data-multishipping-day=". $day ." data-multishipping-hour=". $hour ." data-multishipping-value=". ($selected['enabled'] ? 1 : 0) ."><option value=1". $selected['enabled'] .">". $this->__("Enabled") ."</option><option value=2". $selected['disabled'] .">". $this->__("Disabled") ."</option><option value=0 ". $selected['default'] .">". $this->__("Default") ."</option></select>";
        }
        else {
            return "<select name='table[". $day ."][". $hour . "][is_enabled]' class=is_enabled data-multishipping-day=". $day ." data-multishipping-hour=". $hour ." data-multishipping-value=". ($selected['enabled'] ? 1 : 0) ."><option value=1". $selected['enabled'] .">". $this->__("Enabled") ."</option><option value=2". $selected['disabled'] .">". $this->__("Disabled") ."</option></select>";
        }
    }
    
    protected function getSelected($day, $hour) 
    {
        $selected['enabled'] = '';
        $selected['disabled'] = '';
        $selected['default'] = '';
        if (isset($this->_configTable[$day][$hour]['is_enabled']))
        {
            switch ($this->_configTable[$day][$hour]['is_enabled'])
            {
                case self::SELECT_DEFAULT:
                    $selected['default'] = ' selected';
                    break;
                case self::SELECT_ENABLED:
                    $selected['enabled'] = ' selected';
                    break;
                case self::SELECT_DISABLED:
                    $selected['disabled'] = ' selected';
            }
        }
        else
        {
            $selected['default'] = ' selected';
        }
        return $selected;
    }
    
    public function getDays() {
        $timestamp = strtotime('monday this week');
        $days = array();
        for ($i = 0; $i < 7; $i++) {
            $days[] = array('name' => $this->__(date('l', $timestamp)), 'number' => intval(date('N', $timestamp))-1, 'sufix' => $timestamp !== strtotime('today') ? date('jS', $timestamp): $this->__("today"));
            $timestamp = strtotime('+1 day', $timestamp);
        }
        return $days;
    }    
    
}                                                