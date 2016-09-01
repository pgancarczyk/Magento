<?php
class Polcode_Multishipping_Model_Resource_Multishipping extends Mage_Core_Model_Resource_Db_Abstract
{
    public function _construct()
    {
        $this->_init('multishipping/multishipping', 'multishipping_id');
    }
}
