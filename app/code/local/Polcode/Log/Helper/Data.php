<?php
class Polcode_Log_Helper_Data extends Mage_Core_Helper_Abstract
{
    public function log($message, $level = null)
    {
        $enabled = Mage::getStoreConfig('dev/db_logs/enabled');
        if ($enabled) {
            $model = Mage::getModel('polcode_log/log');
            $model->setLogText($message)
            ->setLogLevel($level)
            ->setLogDate(date("Y-m-d"))
            ->save();     
        }
    }
    
    public function logException(Exception $e) {
        self::log($e->__toString(), Zend_Log::ERR);
    }
}