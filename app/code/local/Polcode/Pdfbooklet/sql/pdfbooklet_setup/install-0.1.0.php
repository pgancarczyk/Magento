<?php
Mage::log('dupa');
$installer = $this;
$installer->startSetup();
$installer->addAttribute('catalog_category', 'pdfbooklet', array(
    'type'          =>  'varchar',
    'label'         =>  'Pdf booklet',
    'input'         =>  'file',
    'backend'       =>  'pdfbooklet/file',
    'input_renderer' => 'pdfbooklet/input',
    'global'        =>  Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL,
    'visible'       =>  true,
    'required'      =>  false,
    'user_defined'  =>  false,
    'position'      =>  100,
    'visible'       =>  true,
    'group'         =>  "General Information"
));
$installer->addAttribute('catalog_product', 'pdfbooklet', array(
    'type'          =>  'varchar',
    'label'         =>  'Pdf booklet',
    'input'         =>  'file',
    'backend'       =>  'pdfbooklet/file',
    'input_renderer' => 'pdfbooklet/input',
    'global'        =>  Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL,
    'visible'       =>  true,
    'required'      =>  false,
    'user_defined'  =>  false,
    'position'      =>  100,
    'visible'       =>  true,
    'group'         =>  "General"
));
$installer->endSetup();
