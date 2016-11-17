<?php
class Polcode_Log {

    public static function log($message, $level = null)
    {
        $enabled = Mage::getStoreConfig('dev/db_logs/enabled');
        $levels = explode(",", Mage::getStoreConfig('dev/db_logs/levels'));
        if ($enabled && in_array($level, $levels)) {
            $model = Mage::getModel('polcode_log/log');
            $model  ->setLogText($message)
                    ->setLogLevel($level)
                    ->save();
            self::_sendMail($message, $level);
        }
    }  

    public static function logException(Exception $e)
    {
        self::log($e->__toString(), Zend_Log::ERR);
    }
    
    private static function _sendMail($message, $level = null) {
        
        $levels = Mage::getSingleton('polcode_log/system_config_source_level')->toArray();
        
        
        $body = "<h3>A message has been logged in the store</h3>";
        $body.= "<code>" . $message . "</code>";
        $body.= $level ? "<p>Level: " . $levels[$level] . " (" . $level . ")</p>" : "<p>Level not specified.</p>";
        $mail = Mage::getModel('core/email');
        $mail->setToEmail('pawel.gancarczyk@polcode.net');
        $mail->setBody($body);
        $mail->setSubject('Magento store developer message');
        $mail->setFromEmail(Mage::getStoreConfig('trans_email/ident_general/email'));
        $mail->setFromName('Database logs notifier');
        $mail->setType('html');

        try {
            $mail->send();
        }
        catch (Exception $e) {
            Mage::logException($e);
        }  
    }

}