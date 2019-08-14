<?php
/*
 *  Created on May 3, 2011
 *  Author Ivan Proskuryakov - volgodark@gmail.com - Magazento.com
 *  Copyright Proskuryakov Ivan. Magazento.com © 2011. All Rights Reserved.
 *  Single Use, Limited Licence and Single Use No Resale Licence ["Single Use"]
 */
?>
<?php
class Ip_Productactivity_Block_Toprated extends Mage_Catalog_Block_Product_Abstract {

        protected function _construct() {

            $data = Mage::helper('productactivity')->getCurrentCategory();
            
            $this->addData(array(
                'cache_lifetime' => 86400,
                'cache_tags' => array("ip_productactivity_home_toprated" ."_".$data['category'].'_'.Mage::app()->getStore()->getId()),
                'cache_key' => "ip_productactivity_home_toprated".'_'.$data['route'].'_'.$data['category'].'_'.Mage::app()->getStore()->getId(),
            ));               
            
            
        }


        public function getTopRatedProduct() {
            $limit = $this->getModel()->getTopratedCount();
            $collection = Mage::getModel('catalog/product')->getCollection();
            $collection->setVisibility(Mage::getSingleton('catalog/product_visibility')->getVisibleInCatalogIds());
            $collection->addAttributeToSelect('*')->addStoreFilter();
            
            
            $data = Mage::helper('productactivity')->getCurrentCategory();
            if ($data['category'] > 0) {
                $category = $this->getModel()->getCategory($data['category']);
                $collection->addCategoryFilter($category); 
            }                   
            
            
            $_rating = array();
            foreach($collection as $_product) {
                $storeId = Mage::app()->getStore()->getId();
                $_productRating = Mage::getModel('review/review_summary')
                                    ->setStoreId($storeId)
                                    ->load($_product->getId());
                $_rating[] = array(
                             'rating' => $_productRating['rating_summary'],
                             'product' => $_product
                            );
            }
            arsort($_rating);
            return array_slice($_rating, 0, $limit);
        }

    public function getModel() {
        return Mage::getModel('productactivity/Data');
    }

}
