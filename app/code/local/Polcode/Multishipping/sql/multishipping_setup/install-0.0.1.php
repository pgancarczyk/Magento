<?php
$installer = $this;
$installer->startSetup();
$table = $installer->getConnection()->newTable($installer->getTable('multishipping'))
    ->addColumn('multishipping_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'unsigned' => true,
        'nullable' => false,
        'primary' => true,
        'identity' => true,
        ), 'Multishipping ID')
    ->addColumn('day', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'unsigned' => true,
        'nullable' => false, 
        ), 'Day of week code')
    ->addColumn('hour', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'unsigned' => true,
        'nullable' => false, 
        ), 'Hour')
    ->addColumn('is_enabled', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'unsigned' => true,
        'nullable' => true,
        ), 'Is the hour enabled')
    ->addColumn('price', Varien_Db_Ddl_Table::TYPE_DECIMAL, '12,4', array(
        'nullable' => true, 
        ), 'Price')
    ->addColumn('limit', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'unsigned' => true,
        'nullable' => true, 
        ), 'Limit') 
    ->setComment('Multishipping configuration table');
$installer->getConnection()->createTable($table);
$installer->endSetup();