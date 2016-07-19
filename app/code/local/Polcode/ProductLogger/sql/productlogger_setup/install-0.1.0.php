<?php
$installer = $this;
$installer->startSetup();
$table = $installer->getConnection()->newTable($installer->getTable('productlogger'))
    ->addColumn('productlogger_id', Varien_Db_Ddl_Table::TYPE_INTEGER, 11, array(
        'unsigned' => true,
        'nullable' => false,
        'primary' => true,
        'identity' => true,
        ), 'Logger ID')
    ->addColumn('sku', Varien_Db_Ddl_Table::TYPE_VARCHAR, 255, array(
        'nullable' => false,
        'nullable' => false, 
        ), 'SKU')
    ->addColumn('product_id', Varien_Db_Ddl_Table::TYPE_INTEGER, 11, array(
        'unsigned' => true,
        'nullable' => false, 
        ), 'Product ID')
    ->addColumn('product_name', Varien_Db_Ddl_Table::TYPE_VARCHAR, 255, array(
        'nullable' => false,
        'nullable' => false, 
        ), 'Product name')
    ->addColumn('price', Varien_Db_Ddl_Table::TYPE_INTEGER, 11, array(
        'unsigned' => true,
        'nullable' => false, 
        ), 'Price')
    ->addColumn('qty', Varien_Db_Ddl_Table::TYPE_INTEGER, 11, array(
        'unsigned' => true,
        'nullable' => false, 
        ), 'Quantity')    
    ->addColumn('order_date', Varien_Db_Ddl_Table::TYPE_DATE, null, array(
        'nullable' => true,
        'default' => null,
        ), 'Order date')    
    ->setComment('ProductLogger table');
	$installer->getConnection()->createTable($table);
	$installer->endSetup();
