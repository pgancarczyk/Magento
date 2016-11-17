<?php
class Polcode_Log_Model_System_Config_Source_Level
{
    public function toOptionArray()
    {
        $reflection = $this->_getReflectionClass();
        $options = array();
        foreach ($reflection->getConstants() as $label => $code)
        {
            $options[] = array('value' => $code, 'label' => $label);
        }
        return $options;
    }
    
    public function toArray()
    {
        $reflection = $this->_getReflectionClass();
        $options = array();
        foreach ($reflection->getConstants() as $label => $code)
        {
            $options[$code] = $label;
        }
        return $options;        
    }
    
    private function _getReflectionClass()
    {
        return new ReflectionClass('Zend_Log');
    }
    
}