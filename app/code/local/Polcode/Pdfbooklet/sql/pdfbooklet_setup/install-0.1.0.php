<?php
$installer = $this;
$installer->startSetup();
$attributeCategory = array(
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
);
$attributeProduct = array(
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
);
$installer->addAttribute('catalog_category', 'pdfbooklet', $attributeCategory);
$installer->addAttribute('catalog_product', 'pdfbooklet', $attributeProduct);
$attributeCategoryId = $installer->getAttributeId('catalog_category', 'pdfbooklet');
$installer->run("update `catalog_eav_attribute` set `frontend_input_renderer` = 'pdfbooklet/input' where `attribute_id` = ".$attributeCategoryId);
$attributeProductId = $installer->getAttributeId('catalog_product', 'pdfbooklet');
$installer->run("update `catalog_eav_attribute` set `frontend_input_renderer` = 'pdfbooklet/input' where `attribute_id` = ".$attributeProductId);
$installer->endSetup();
