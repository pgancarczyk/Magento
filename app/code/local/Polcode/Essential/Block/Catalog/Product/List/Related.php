<?php
class Polcode_Essential_Block_Catalog_Product_List_Related extends Mage_Catalog_Block_Product_List_Related
{
    public function getEssentialClass($product)
    {
        if($product->getEssential())
        {
            return " essential";
        }
        else
        {
            return "";
        }
    }    
}
