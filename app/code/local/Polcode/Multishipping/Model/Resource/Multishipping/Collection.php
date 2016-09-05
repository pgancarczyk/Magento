<?php
class Polcode_Multishipping_Model_Resource_Multishipping_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract {
    
    public function _construct()
    {
        $this->_init('multishipping/multishipping');
    }
    
    public function massUpdate(array $data)
    {
        $this->getConnection()->update($this->getResource()->getMainTable(), $data, $this->getResource()->getIdFieldName() . ' IN(' . implode(',', $this->getAllIds()) . ')');
        return $this;
    }
    
    public function updateEntity($day, $hour, $field_name, $value) {
        die('wywolane'); 
   }
    
}