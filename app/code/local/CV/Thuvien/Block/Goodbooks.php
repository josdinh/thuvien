<?php
class CV_Thuvien_Block_Goodbooks extends Mage_Core_Block_Template
{
    public function getListGoodBooks()
    {
        $tpcomCollection = Mage::getModel('thuvien/tpcom')->getCollection()
                        ->addFieldToFilter('NoiBat',1)
                        ->setPageSize(20)
                        ->setCurPage(20)
                        ->setOrder('MaTPCom','DESC');
        return $tpcomCollection;
    }

    public function getImages($url)
    {
            return $this->getSkinUrl('images/demobooks/10022.jpg');
    }
}