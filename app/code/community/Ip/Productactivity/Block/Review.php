<?php
/*
 *  Created on May 3, 2011
 *  Author Ivan Proskuryakov - volgodark@gmail.com - Magazento.com
 *  Copyright Proskuryakov Ivan. Magazento.com © 2011. All Rights Reserved.
 *  Single Use, Limited Licence and Single Use No Resale Licence ["Single Use"]
 */
?>
<?php

class Ip_Productactivity_Block_Review extends Mage_Catalog_Block_Product_Abstract {
    
    protected function _construct() {
        
        $data = Mage::helper('productactivity')->getCurrentCategory();
        
        $this->addData(array(
            'cache_lifetime' => 86400,
            'cache_tags' => array("ip_productactivity_home_review" ."_".$data['category'].'_'.Mage::app()->getStore()->getId()),
            'cache_key' => "ip_productactivity_home_review".'_'.$data['route'].'_'.$data['category'].'_'.Mage::app()->getStore()->getId(),
        ));        
    }



    function getReviewsData(){
        $pending  = 2;  
        $declined = 3;  
        $reviews = $this->getReviews();
        $count = 0;  
        foreach ($reviews as $review){  
          if($review['status_id'] != $pending || $review['status_id'] != $declined){
              
            $_product = Mage::getModel('catalog/product')->load($review->getData('entity_pk_value'));
            
            $vals = $this->getRatingValues($review);
            $allReviews[$count]['review_url'] = $review->getReviewUrl($review->getId());
            $allReviews[$count]['product_id'] =  $review->getData('entity_pk_value');
            $allReviews[$count]['product'] =  $_product;
            
            $num = $count +1;
            $allReviews[$count]['title'] = $num.'. '.$review['title'];
            $allReviews[$count]['detail'] = $review['detail'];  
            $allReviews[$count]['nickname'] = $review['nickname'];  
            $allReviews[$count]['ratings'] = $vals;  
            $count++;      
          }  
        }  

        return $allReviews;
    }
    function getRatingValues(Mage_Review_Model_Review $review){
      $avg = 0;
      if( count($review->getRatingVotes()) ) {
        $ratings = array();
        $c = 0;
        foreach( $review->getRatingVotes() as $rating ) {
          $type = $rating->getRatingCode();
          $pcnt = $rating->getPercent();
        if($type){
          $val[$c][$type] = $pcnt;

        }
        $ratings[] = $rating->getPercent();
        }
        $c++;
        $avg = array_sum($ratings)/count($ratings);
      }
      return $val;
    }
    
    function getReviews() {
        $reviews = Mage::getModel('review/review')->getResourceCollection();
        $reviews->addStoreFilter( Mage::app()->getStore()->getId() )
                ->addStatusFilter( Mage_Review_Model_Review::STATUS_APPROVED )
                ->setDateOrder()
                ->addRateVotes()
                ->load();
      
      
      
      
      
      
        // -------------------------------
        // 
        //products
        
        $data = Mage::helper('productactivity')->getCurrentCategory();
        $catId = $data['category'];
        
        if ($catId > 0) {
            $category = $this -> getModel() -> getCategory($catId);
            $collection = Mage::getModel('catalog/product') 
                                -> getCollection() 
                                -> addStoreFilter() 
                                -> setOrder($order, 'ASC') 
                                -> addAttributeToSelect('entity_id') 
                                -> addCategoryFilter($category)
                                -> addAttributeToFilter('status', array('eq' => '1'));        
        
            //category filter

            
            $product_array = array();
            foreach ($collection as $_product) {
                $product_array[] = $_product -> getId();
            }
            $return = array();
            $i = 0;
            foreach ($reviews as $review) {
                    if (in_array($review->getData('entity_pk_value'), $product_array)) {
                        $return[] = $review;
                        $i++; 
                    } 
                    if ($i == $this -> getModel() -> getReviewsCount()) break;
            }  
            
            
        } else {
            
            // -------------------------------      
            $return = array();
            $i=0;
            foreach ( $reviews as $review) {
                $return[] = $review;
                $i++; if ($i == $this->getModel()->getReviewsCount()) break;
                
            }
        }

      
      
      
      
      
      
      
      
      
      
        return $return;
    }


    
    public function getModel() {
        return Mage::getModel('productactivity/Data');
    }

}

