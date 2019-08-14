<?php

/*
 *  Created on May 3, 2011
 *  Author Ivan Proskuryakov - volgodark@gmail.com - Magazento.com
 *  Copyright Proskuryakov Ivan. Magazento.com © 2011. All Rights Reserved.
 *  Single Use, Limited Licence and Single Use No Resale Licence ["Single Use"]
 */
?>
<?php

class Ip_Productactivity_Block_New extends Mage_Catalog_Block_Product_Abstract {

    
    
    
    protected function _construct() {
        
        $data = Mage::helper('productactivity')->getCurrentCategory();
        $this->addData(array(
            'cache_lifetime' => 86400,
            'cache_tags' => array("ip_productactivity_home_new" ."_".$data['category'].'_'.Mage::app()->getStore()->getId()),
            'cache_key' => "ip_productactivity_home_new".'_'.$data['route'].'_'.$data['category'].'_'.Mage::app()->getStore()->getId(),
        ));
    }
    
    
    


    protected function _beforeToHtml() {

        $collection = Mage::getResourceModel('catalog/product_collection');
        $from = Mage::getStoreConfig('productactivity/new/from');
        Mage::getSingleton('catalog/product_status')->addVisibleFilterToCollection($collection);
        Mage::getSingleton('catalog/product_visibility')->addVisibleInCatalogFilterToCollection($collection);
        $newDate = $this->getModel()->getSellDate($this->getModel()->getProductactivityDaysLimit());
        $collection = $this->_addProductAttributesAndPrices($collection)
                ->addStoreFilter()
                ->addAttributeToFilter(array(
                    array('attribute' => 'created_at', 'from' => $from, 'to' => $newDate['todaydate'])
                ))
                ->setPageSize($this->getModel()->getNewCount())
                ->setCurPage(1)
        ;
        
        $data = Mage::helper('productactivity')->getCurrentCategory();

        if ($data['category'] > 0) {
            $category = $this->getModel()->getCategory($data['category']);
            $collection->addCategoryFilter($category); 
        }        

        $this->setProductCollection($collection);
    }

    public function getModel() {
        return Mage::getModel('productactivity/Data');
    }

}