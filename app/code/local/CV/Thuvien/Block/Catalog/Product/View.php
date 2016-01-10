<?php

class CV_Thuvien_Block_Catalog_Product_View extends Mage_Core_Block_Template
{

    /**
     * Retrieve current category model object
     *
     * @return Mage_Catalog_Model_Category
     */
    public function getCurrentProductCom()
    {
        if (!$this->hasData('current_product_com')) {
            $this->setData('current_product_com', Mage::registry('current_product_com'));
        }
        return $this->getData('current_product_com');
    }

    public function getCurrentProductPop()
    {
        if (!$this->hasData('current_product_pop')) {
            $this->setData('current_product_pop', Mage::registry('current_product_pop'));
        }
        return $this->getData('current_product_pop');
    }

}
