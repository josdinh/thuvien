<?php

class CV_Thuvien_Block_Catalog_Category_View extends Mage_Core_Block_Template
{

    protected $_defaultToolbarBlock = 'thuvien/page_pager';

    public function __construct()
    {
        parent::__construct();
        $collection =  Mage::getModel('thuvien/tpcom')->getCollection()
                       ->addFieldToFilter('MaDDC',$this->getCurrentCategory()->getData('MaDDC'));
        $this->setCollection($collection);
    }

    protected function _prepareLayout()
    {
        parent::_prepareLayout();

      //  $this->getLayout()->createBlock('catalog/breadcrumbs');

        if ($headBlock = $this->getLayout()->getBlock('head')) {
            $category = $this->getCurrentCategory();
            if ($title = $category->getData('TenDDC')) {
                $headBlock->setTitle($title);
            }
        }

        $toolbar = $this->getToolbarBlock();
        $collection = $this->getCollection();
        $toolbar->setCollection($collection);
        $this->setChild('toolbar', $toolbar);
        $this->getCollection()->load();
        return $this;
    }

    /**
     * Retrieve current category model object
     *
     * @return Mage_Catalog_Model_Category
     */
    public function getCurrentCategory()
    {
        if (!$this->hasData('current_category')) {
            $this->setData('current_category', Mage::registry('current_category'));
        }
        return $this->getData('current_category');
    }

    public function getToolbarBlock()
    {
        $block = $this->getLayout()->createBlock('thuvien/page_pager', microtime());
        return $block;
    }
    public function getMode()
    {
        return $this->getChild('toolbar')->getCurrentMode();
    }

    public function getToolbarHtml()
    {
        return $this->getChildHtml('toolbar');
    }

    public function getImages($url)
    {
        return $this->getSkinUrl('images/demobooks/10022.jpg');
    }

}
