<?php
class Polcode_Productcost_Model_Observer
{
    public function beforeBlockToHtml(Varien_Event_Observer $observer)
    {
        $grid = $observer->getBlock();
        if ($grid instanceof Mage_Adminhtml_Block_Catalog_Product_Grid)
        {
            $grid->addColumnAfter(
                'cost',
                array(
                    'header' => 'Cost',
                    'index'  => 'cost',
                    'type'   => 'currency'
                ),
                'entity_id'
            );
        }
    }

    public function beforeCollectionLoad(Varien_Event_Observer $observer)
    {
        $collection = $observer->getCollection();
        if (!isset($collection))
        {
            return;
        }
        if ($collection instanceof Mage_Catalog_Model_Resource_Product_Collection)
        {
            $collection->addAttributeToSelect('cost');
        }
    }
}