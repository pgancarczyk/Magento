<?php
class Polcode_ProductLogger_Model_Resource_Productlogger_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    public function _construct()
    {
        $this->_init('productlogger/productlogger');
    }
}