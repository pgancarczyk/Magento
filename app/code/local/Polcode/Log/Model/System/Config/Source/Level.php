<?php
class Polcode_Log_Model_System_Config_Source_Level
{
    public function toOptionArray()
    {
        $reflection = new ReflectionClass('Zend_Log');
        $options = array();
        foreach ($reflection->getConstants() as $label => $code)
        {
            $options[] = array('value' => $code, 'label' => $label);
        }
        return $options;
    }
    
    public function toArray()
    {
        $reflection = new ReflectionClass('Zend_Log');
        $options = array();
        foreach ($reflection->getConstants() as $label => $code)
        {
            $options[$code] = $label;
        }
        return $options;        
    }
}