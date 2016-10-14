<?php
class Polcode_Log_Model_System_Config_Source_Frequency
{
    public function toOptionArray()
    {
        return array(
            array('value' => 10, 'label' => "10 minutes"),
            array('value' => 60, 'label' => "1 hour"),
            array('value' => 60*2, 'label' => "2 hours"),
            array('value' => 60*5, 'label' => "5 hours"),
            array('value' => 60*12, 'label' => "12 hours"),
            array('value' => 60*24, 'label' => "1 day"),
            array('value' => 60*24*3, 'label' => "3 days"),
            array('value' => 60*24*7, 'label' => "1 week"),
            array('value' => 60*24*30, 'label' => "1 month")
        );
    }
}