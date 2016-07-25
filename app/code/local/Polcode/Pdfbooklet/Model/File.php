<?php
class Polcode_Pdfbooklet_Model_File extends Mage_Eav_Model_Entity_Attribute_Backend_Abstract
{
    public function afterSave($object)
    {   
        $value = $object->getData($this->getAttribute()->getName());

        if (is_array($value) && !empty($value['delete'])) {
            $object->setData($this->getAttribute()->getName(), '');
            $this->getAttribute()->getEntity()
                ->saveAttribute($object, $this->getAttribute()->getName());
            return;
        }
        $io = new Varien_Io_File();
        $io->checkAndCreateFolder(Mage::getBaseDir('media') . DS . 'booklets'); 
        $path = Mage::getBaseDir('media') . DS . 'booklets';

        try
        {
            $uploader = new Mage_Core_Model_File_Uploader($this->getAttribute()->getName());
            $uploader->setAllowedExtensions(array('pdf'));
            $uploader->setAllowRenameFiles(true);
            $result = $uploader->save($path);

            $object->setData($this->getAttribute()->getName(), $result['file']);
            $this->getAttribute()->getEntity()->saveAttribute($object, $this->getAttribute()->getName());
        } 
        catch (Exception $e)
        {
            Mage::logException($e);
        }        
    }    
}