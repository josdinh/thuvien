<?php
class CV_Thuvien_Block_Danhmucsach extends Mage_Core_Block_Template
{
    public function getListDDC()
    {
        $ddcArr = array(100,200,300,400,500,600,700,800,900);
        $listDDC = Mage::getModel('thuvien/ddc')->getCollection()->setOrder('DDC','ASC');
        $listDDC->addFieldToFilter('DDC',array('in'=>$ddcArr));
       return $listDDC;
    }
}