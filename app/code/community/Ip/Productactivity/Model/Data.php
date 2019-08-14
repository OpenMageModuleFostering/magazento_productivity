<?php
/*
 *  Created on May 3, 2011
 *  Author Ivan Proskuryakov - volgodark@gmail.com - Magazento.com
 *  Copyright Proskuryakov Ivan. Magazento.com © 2011. All Rights Reserved.
 *  Single Use, Limited Licence and Single Use No Resale Licence ["Single Use"]
 */
?>
<?php
Class Ip_Productactivity_Model_Data {


    public function getSellDate($days) {
        $product = Mage::getModel('catalog/product');
        $product=array();
        $outputFormat='Y-m-d H:i:s';
//        $outputFormat = Mage::app()->getLocale()->getDateTimeFormat(Mage_Core_Model_Locale::FORMAT_TYPE_SHORT);
//        var_dump($outputFormat);
//        $dateFormatIso = Mage::app()->getLocale()->getDateTimeFormat(Mage_Core_Model_Locale::FORMAT_TYPE_MEDIUM);
//        $dateformat=Mage::app()->getLocale()->getDateTimeFormat(Mage_Core_Model_Locale::FORMAT_TYPE_SHORT);
        $product['todaydate'] = date($outputFormat, time());
        $product['startdate'] = date($outputFormat, time() - 60 * 60 * 24 * $days);
        return $product;

    }

    public function getCategory ($id){
            $categoryId = $id;
            if (!$categoryId || !is_numeric($categoryId))
                    $category = Mage::registry("current_category");
            else {
                    $category = Mage::getModel("catalog/category")->load($categoryId);
                    if (!$category->getId())
                            $category = Mage::registry("current_category");
            }
            return $category;
    }


    public function getReviewsCount() {
        $count = (int) Mage::getStoreConfig('productactivity/review/count');
        if ($count <=0) $count=5;
        return $count;
    }
    public function getTopsellCount() {
        $count = (int) Mage::getStoreConfig('productactivity/topsell/count');
        if ($count <=0) $count=5;
        return $count;
    }
    
    public function getNewCount() {
        $count = (int) Mage::getStoreConfig('productactivity/new/count');
        if ($count <=0) $count=5;
        return $count;
    }
    
    public function getPopularCount() {
        $count = (int) Mage::getStoreConfig('productactivity/popular/count');
        if ($count <=0) $count=5;
        return $count;
    }
    public function getTopratedCount() {
        $count = (int) Mage::getStoreConfig('productactivity/toprated/count');
        if ($count <=0) $count=5;
        return $count;
    }
    
    public function getProductactivityDaysLimit() {
        $count = (int) Mage::getStoreConfig('productactivity/topsell/days');
        if ($count <=0) $count=5;
        return $count;
    }

    


}