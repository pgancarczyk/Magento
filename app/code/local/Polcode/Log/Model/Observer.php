<?php

class Polcode_Log_Model_Observer {
    
    public function tick() {
        
        $enabled = Mage::getStoreConfig('dev/db_logs/enabled');
        
        if ($enabled) {
            $minutes_since_last_job = $this->_getMinutesSinceLastJob();
            $archivize_every = Mage::getStoreConfig('dev/db_logs/archivize_every');

            if($archivize_every < $minutes_since_last_job) {
                return $this->_archivize();
            }
            else {
                return "archivization frequency too low, not archivizing";
            }
        }
        else {
            return "module disabled in the configuration";
        }
        
    }
    
    protected function _getMinutesSinceLastJob() {
        
        $collection = Mage::getModel('cron/schedule')->getCollection()->addFieldToFilter('status', array('eq' => 'success'))->addFieldToFilter('job_code', array('eq' => 'polcode_log'));
        $collection->getSelect()->order('executed_at DESC');
        $last_job = $collection->getFirstItem();
        
        return (time()-strtotime($last_job->getExecutedAt()))/60;     
        
    }
    
    private function _archivize() {
        
        $archivize_after = Mage::getStoreConfig('dev/db_logs/archivize_after');
        $collection = Mage::getModel('polcode_log/log')->getCollection()->addFieldToFilter('created_at', array('lt' => Mage::getModel('core/date')->date('Y-m-d H:i:s')));
        
        $io = new Varien_Io_File();
        $path = Mage::getBaseDir('var') . DS . 'log' . DS;
        $file = $path . 'db_logs_archivized.csv';
        $write_headers = !file_exists($file);
        $io->setAllowCreateFolders(true);
        $io->open(array('path' => $path));
        $io->streamOpen($file, 'a');
        $io->streamLock(true);
        
        if ($write_headers) {
            $io->streamWriteCsv(array('Entry ID', 'Value', 'Level', 'Date logged'));
        }
        
        $counter = 0;
        
        foreach ($collection as $log) {
            $io->streamWriteCsv($log->getData());
            $log->delete();
            $counter++;
        }
        
        $io->streamClose();    
        
        if ($counter) {
            return "archivized " . $counter . " logs";
        }
        else {
            return "no logs older than the value set in the configuration";
        }
        
    }
    
}