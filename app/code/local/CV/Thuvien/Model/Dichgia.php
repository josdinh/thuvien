<?php

class CV_Thuvien_Model_Dichgia extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('thuvien/dichgia');
    }

    public  function getListDichGiaOptions()
    {
        $collection = Mage::getModel('thuvien/dichgia')->getCollection()->setOrder('TenDichGia','ASC');
        $dichgia = array();
        if($collection->getSize()) {
            foreach($collection as $key=>$value) {
                $tmp = array('value'=>$value['MaListDG'],'label'=>$value['TenDichGia']);
                $dichgia[] = $tmp;
            }
        }
        return $dichgia;
    }

}