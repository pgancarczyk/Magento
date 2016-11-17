<?php
class Polcode_Log_Adminhtml_LogController extends Mage_Adminhtml_Controller_Action
{
    protected function _initAction()
    {
        $this->loadLayout()
            ->_setActiveMenu('system/log');
        return $this;
    }
    public function indexAction()
    {
        $this->loadLayout();
        $this->_initAction();
        $this->_addContent($this->getLayout()->createBlock('polcode_log/adminhtml_main'));
        $this->renderLayout();
    }
    
    public function exportCsvAction()
    {
        $fileName = 'db_logs.csv';
        $content = $this->getLayout()->createBlock('polcode_log/adminhtml_main_grid')->getCsvFile();
        $this->_prepareDownloadResponse($fileName, $content);
    }

    protected function _sendUploadResponse($fileName, $content, $contentType = 'application/octet-stream')
    {
        $this->_prepareDownloadResponse($fileName, $content, $contentType);
    }

}