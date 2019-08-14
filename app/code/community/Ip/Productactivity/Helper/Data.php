<?php

/*
 *  Created on May 3, 2011
 *  Author Ivan Proskuryakov - volgodark@gmail.com - Magazento.com
 *  Copyright Proskuryakov Ivan. Magazento.com © 2011. All Rights Reserved.
 *  Single Use, Limited Licence and Single Use No Resale Licence ["Single Use"]
 */
?>
<?php

class Ip_Productactivity_Helper_Data extends Mage_Core_Helper_Abstract {

    public function getTitleNew() {
        return Mage::getStoreConfig('productactivity/new/title');
    }

    public function getTitlePopular() {
        return Mage::getStoreConfig('productactivity/popular/title');
    }

    public function getTitleReview() {
        return Mage::getStoreConfig('productactivity/review/title');
    }

    public function getTitleToprated() {
        return Mage::getStoreConfig('productactivity/toprated/title');
    }

    public function getTitleTopSell() {
        return Mage::getStoreConfig('productactivity/topsell/title');
    }

    public function getCurrentCategory() {

        if (Mage::app()->getFrontController()->getRequest()->getRouteName() == 'cms') {
            return array('route' => 'page', 'category' => 0);
        }

        if (Mage::registry('current_product') != null) {
            $_category = Mage::registry('current_product')->getCategoryIds();
            return array('route' => 'product', 'category' => $_category[0]);
        }
//        
        if (Mage::registry('current_category') != null) {
            return array('route' => 'catalog', 'category' => Mage::registry('current_category')->getId());
        }        
    }

}