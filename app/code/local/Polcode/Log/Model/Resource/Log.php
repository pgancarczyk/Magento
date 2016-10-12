<?php
class Polcode_Log_Model_Resource_Log extends Mage_Core_Model_Resource_Db_Abstract
{
    public function _construct()
    {
        $this->_init('polcode_log/log', 'log_id');
    }
}
