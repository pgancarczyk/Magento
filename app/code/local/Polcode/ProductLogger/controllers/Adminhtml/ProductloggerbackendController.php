<?php
class Polcode_ProductLogger_Adminhtml_ProductloggerbackendController extends Mage_Adminhtml_Controller_Action
{
    protected function _initAction()
    {
        $this->loadLayout()->_setActiveMenu('sales/productlogger');
        return $this;
    }
    
    public function indexAction()
    {
        $this->loadLayout();
        $this->_addContent($this->getLayout()->createBlock('productlogger/adminhtml_main'));
        $this->renderLayout();
    }
    
    protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')->isAllowed('sales/productlogger');
    }
    
    public function newAction()
    {  
        $this->_forward('edit');
    }
    
    public function saveAction()
    {
        if ($postData = $this->getRequest()->getPost()) {
            $postData['productlogger_id'] = $this->getRequest()->getParam('id');
            $model = Mage::getModel('productlogger/productlogger');
            $model->setData($postData);
            
            try {
                $model->save();
                Mage::getSingleton('adminhtml/session')->addSuccess($this->__('The row has been saved.'));
                $this->_redirect('*/*/');
                return;
            }  
            catch (Mage_Core_Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
            catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($this->__('An error occurred while saving the entry.'));
            }
            $this->_redirectReferer();
        }
    }
    
public function deleteAction()
    {
        $model = Mage::getModel('productlogger/productlogger')->load($this->getRequest()->getParam('id'));
        try {
            $model->delete();

            $this->_getSession()->addSuccess(
                $this->__('The row has been deleted.')
            );
        } catch (Exception $e) {
            Mage::logException($e);
            $this->_getSession()->addError($e->getMessage());
        }

        return $this->_redirect('*/*/');
    }
     
    public function editAction()
    {
        $this->_title('ProductLogger')
             ->_title($this->__('Edit entry'));
        $id = $this->getRequest()->getParam('id');
        $model = Mage::getModel('productlogger/productlogger');

        if ($id) {
            $model->load($id);
            if (! $model->getId()) {
                Mage::getSingleton('adminhtml/session')->addError(
                    $this->__('This entry does not exist.'));
                $this->_redirect('*/*/');
                return;
            }
        }

        $this->_title($model->getId() ? $model->getTitle() : $this->__('New log entry'));

        $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
        if (! empty($data)) {
            $model->setData($data);
        }
        
        Mage::register('productlogger', $model);

        $this->_initAction()
            ->_addBreadcrumb(
                $id ? Mage::helper('productlogger')->__('Edit entry')
                    : Mage::helper('productlogger')->__('New log entry'),
                $id ? Mage::helper('productlogger')->__('Edit entry')
                    : Mage::helper('productlogger')->__('New log entry'));
        $this->_addContent($this->getLayout()->createBlock('productlogger/adminhtml_main_edit'));
        $this->renderLayout();

    }
}