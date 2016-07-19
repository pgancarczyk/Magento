<?php
class Polcode_ProductLogger_Model_Resource_Productlogger extends Mage_Core_Model_Resource_Db_Abstract
{
    public function _construct()
    {
        $this->_init('productlogger/productlogger', 'productlogger_id');
    }
}
