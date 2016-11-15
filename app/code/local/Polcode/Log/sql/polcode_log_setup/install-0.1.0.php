<?php
$installer = $this;
$installer->startSetup();
$table = $installer->getConnection()->newTable($installer->getTable('db_logs'))
    ->addColumn('log_id', Varien_Db_Ddl_Table::TYPE_INTEGER, 11, array(
        'unsigned' => true,
        'nullable' => false,
        'primary' => true,
        'identity' => true,
        ), 'Log ID')
    ->addColumn('log_text', Varien_Db_Ddl_Table::TYPE_TEXT, null, array(
        ), 'Content of a log entry')
    ->addColumn('log_level', Varien_Db_Ddl_Table::TYPE_INTEGER, 11, array(
        'unsigned' => true,
        'nullable' => false, 
        ), 'Level of a log (see Zend_Log for definitions)')
    ->addColumn('created_at', Varien_Db_Ddl_Table::TYPE_TIMESTAMP, null, array(
        'nullable' => true,
        'default' => Varien_Db_Ddl_Table::TIMESTAMP_INIT,
        ), 'Created at')       
    ->setComment('Polcode_Log main table');
$installer->getConnection()->createTable($table);
$installer->endSetup();