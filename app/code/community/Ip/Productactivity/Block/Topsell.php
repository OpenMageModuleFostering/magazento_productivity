<?php
/*
 *  Created on May 3, 2011
 *  Author Ivan Proskuryakov - volgodark@gmail.com - Magazento.com
 *  Copyright Proskuryakov Ivan. Magazento.com © 2011. All Rights Reserved.
 *  Single Use, Limited Licence and Single Use No Resale Licence ["Single Use"]
 */
?>
<?php

class Ip_Productactivity_Block_Topsell extends Mage_Catalog_Block_Product_Abstract {

    protected function _construct() {
        
        $data = Mage::helper('productactivity')->getCurrentCategory();
        $this->addData(array(
            'cache_lifetime' => 86400,
            'cache_tags' => array("ip_productactivity_home_topsell" ."_".$data['category'].'_'.Mage::app()->getStore()->getId()),
            'cache_key' => "ip_productactivity_home_topsell".'_'.$data['route'].'_'.$data['category'].'_'.Mage::app()->getStore()->getId(),
        ));                 
        
    }

        
        protected function _beforeToHtml() {

            $storeId = Mage::app()->getStore()->getId();
            $sellDate=$this->getModel()->getSellDate($this->getModel()->getProductactivityDaysLimit());
        $collection = Mage::getResourceModel('reports/product_sold_collection')
                            ->addOrderedQty()
                            ->setStoreId($storeId)
                            ->addStoreFilter($storeId)
                            ->setDateRange($sellDate['startdate'], $sellDate['todaydate']) //
                            ->addUrlRewrite()
//				->addAttributeToFilter('visibility', array('in' => array(Mage_Catalog_Model_Product_Visibility::VISIBILITY_IN_CATALOG, Mage_Catalog_Model_Product_Visibility::VISIBILITY_BOTH)))
                            ->addAttributeToFilter('status', Mage_Catalog_Model_Product_Status::STATUS_ENABLED)
                            ->setOrder('ordered_qty', 'desc')
                            ->setPageSize($this->getModel()->getTopsellCount())
                            ->setCurPage(1)
                            ->setOrder('ordered_qty', 'desc');



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


