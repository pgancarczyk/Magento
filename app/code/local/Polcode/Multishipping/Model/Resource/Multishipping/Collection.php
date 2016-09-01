<?php
class Polcode_Multishipping_Model_Resource_Multishipping_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    public function _construct()
    {
        $this->_init('multishipping/multishipping');
    }
}