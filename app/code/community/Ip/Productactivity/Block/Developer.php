<?php

class Ip_Productactivity_Block_Developer extends Mage_Adminhtml_Block_System_Config_Form_Fieldset {

    
    public function render(Varien_Data_Form_Element_Abstract $element) {
        $content = '<p></p>';
        $content.= '<style>';
        $content.= '.developer {
                        background:#FAFAFA;
                        border: 1px solid #CCCCCC;
                        margin-bottom: 10px;
                        padding: 10px;
                        height:auto;

                    }
                    .developer h3 {
                        color: #EA7601;
                    }
                    .contact-type {
                        color: #EA7601;
                        font-weight:bold;
                    }
                    .developer img {

                        float:left;
                        height:255px;
                        width:220px;
                    }
                    .developer .info {
                        border: 1px solid #CCCCCC;
                        background:#E7EFEF;
                        padding: 5px 10px 0 5px;
                        margin-left:230px;
                        height:250px;
                    }
                    ';
        $content.= '</style>';


        $content.= '<div class="developer">';
            $content.= '<a href="http://www.ecommerceoffice.com/" target="_blank"><img src="'.Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_SKIN).'frontend/base/default/ip_productactivity/promo.jpg" alt="www.ecommerceoffice.com" /></a>';
            $content.= '<div class="info">';
                $content.= '<h3>PROFESSIONAL MAGENTO DEVELOPMENT</h3>';
                $content.= '<p>We provide premium services for Business, Corporate built with the latest innovations in web-development and SEO niche. <br/> You will pay less to go live with our wide range of solutions and services.<br/>';
                $content.= 'If you need Magento development , please contact us.</p>';
                $content.= '<span class="contact-type">Website:</span> <br/><a href="http://www.magazento.com/" target="_blank">www.magazento.com</a>  <br/>';
                $content.= '<span class="contact-type">E-mail:</span> <br/>service@magazento.com <br/>';
                $content.= '<span class="contact-type">LinkedIn:</span> <br/><a href="http://www.linkedin.com/pub/ivan-proskuryakov/31/200/316" target="_blank">http://www.linkedin.com/pub/ivan-proskuryakov/31/200/316</a>  <br/>';

                $content.= '</div>';

        $content.= '</div>';

        return $content;


    }


}
