<?php
class Polcode_Log
{
    public static function log($message, $level = null)
    {
        $enabled = Mage::getStoreConfig('dev/db_logs/enabled');
        $levels = explode(",", Mage::getStoreConfig('dev/db_logs/levels'));
        if ($enabled && in_array($level, $levels)) {
            Mage::log('uiefhuweiwe2');
            $model = Mage::getModel('polcode_log/log');
            $model->setLogText($message)
            ->setLogLevel($level)
            ->setLogDate(date("Y-m-d"))
            ->save();     
        }
    }
    
    public static function logException(Exception $e) {
        self::log($e->__toString(), Zend_Log::ERR);
    }
}