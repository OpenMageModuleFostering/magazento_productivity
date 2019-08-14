<?php
/*
 *  Created on May 3, 2011
 *  Author Ivan Proskuryakov - volgodark@gmail.com - Magazento.com
 *  Copyright Proskuryakov Ivan. Magazento.com © 2011. All Rights Reserved.
 *  Single Use, Limited Licence and Single Use No Resale Licence ["Single Use"]
 */
?>
<?php

class Ip_Productactivity_Block_Popular extends Mage_Catalog_Block_Product_Abstract {


        protected function _construct() {

            $data = Mage::helper('productactivity')->getCurrentCategory();
            $this->addData(array(
                'cache_lifetime' => 86400,
                'cache_tags' => array("ip_productactivity_home_popular" ."_".$data['category'].'_'.Mage::app()->getStore()->getId()),
                'cache_key' => "ip_productactivity_home_popular".'_'.$data['route'].'_'.$data['category'].'_'.Mage::app()->getStore()->getId(),
            ));            
        }

        
        
        
        protected function _beforeToHtml() {
            $storeId    = Mage::app()->getStore()->getId();
            $collection = Mage::getResourceModel('reports/product_collection')
                        ->addOrderedQty()
                        ->addAttributeToSelect('*')
                        ->addAttributeToSelect(array('name', 'price', 'small_image')) //edit to suit tastes
                        ->setStoreId($storeId)
                        ->addStoreFilter($storeId)
                        ->addViewsCount();
            Mage::getSingleton('catalog/product_status')->addVisibleFilterToCollection($collection);
            Mage::getSingleton('catalog/product_visibility')->addVisibleInCatalogFilterToCollection($collection);
            $collection->setPageSize($this->getModel()->getPopularCount())->setCurPage(1);
            
            
            
            $data = Mage::helper('productactivity')->getCurrentCategory();
            if ($data['category'] > 0) {
                $category = $this->getModel()->getCategory($data['category']);
                $collection->addCategoryFilter($category); 
            }        

        
            $this->setProductCollection($collection);
            return parent::_beforeToHtml();
	}

    public function getModel() {
        return Mage::getModel('productactivity/Data');
    }

}

