<?php
$installer = $this;
$installer->startSetup();
$data = array(
    array(
        'link_type_id'                  => 1,
        'product_link_attribute_code'   => 'essential',
        'data_type'                     => 'int'
    )
);
$installer->getConnection()->insertMultiple($installer->getTable('catalog/product_link_attribute'), $data);
$installer->endSetup();