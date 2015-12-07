<?php
class CV_Thuvien_Block_Danhmucsach extends Mage_Core_Block_Template
{
    public function getListSachBo()
    {
        return Mage::getModel('thuvien/sachbo')->getCollection();
    }
}