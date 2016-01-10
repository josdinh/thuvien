<?php

class CV_Thuvien_Block_Catalog_Category_List extends Mage_Core_Block_Template
{
    public function getListDDC()
    {

        $id = Mage::app()->getRequest()->getParam('id',1);

        $ddcCols = Mage::getModel('thuvien/ddc')->getCollection();
        $ddcArr = array();
        foreach($ddcCols as $ddc) {

            if(floor($ddc->getData('DDC') / $id) == 1){
                $ddcArr[] = $ddc->getData('MaDDC');
            }
        }

        $collection =  Mage::getModel('thuvien/ddc')->getCollection()
                       ->addFieldToFilter('MaDDC',array('in'=>$ddcArr))
                       ->setOrder('TenDDC','ASC');
       return $collection;
    }

    public function getCurrentDDC()
    {
        $id = Mage::app()->getRequest()->getParam('id',-1);
        $ddcDetail = Mage::getModel('thuvien/ddc')->load($id,'DDC');
        return $ddcDetail;
    }




}
