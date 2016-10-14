<?php

class Polcode_Log_Model_Observer {
    public function tick() {
        $minutes_since_last_job = $this->_getMinutesSinceLastJob();
        $archivize_after = Mage::getStoreConfig('dev/db_logs/archivize_after');
        $archivize_every = Mage::getStoreConfig('dev/db_logs/archivize_every');
        if($archivize_every < $minutes_since_last_job) {
            $this->_archivize();
        }
    }
    
    protected function _getMinutesSinceLastJob() {
        $collection = Mage::getModel('cron/schedule')->getCollection()->addFieldToFilter('status', array('eq' => 'success'))->addFieldToFilter('job_code', array('eq' => 'polcode_log'));
        $collection->getSelect()->order('executed_at DESC');
        $last_job = $collection->getFirstItem();
        return (time()-strtotime($last_job->getExecutedAt()))/60;          
    }
    
    protected function _archivize() {
        // TODO: actual archivization code
    }
}
