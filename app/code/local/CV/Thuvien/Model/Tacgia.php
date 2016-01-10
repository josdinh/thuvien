<?php

class CV_Thuvien_Model_Tacgia extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('thuvien/tacgia');
    }

    public  function getListTacGiaOptions()
    {
        $collection = Mage::getModel('thuvien/tacgia')->getCollection()->setOrder('TenTacGia','ASC');
        $tacgia = array();
        if($collection->getSize()) {
            foreach($collection as $key=>$value) {
               $tmp = array('value'=>$value['MaListTG'],'label'=>$value['TenTacGia']);
               $tacgia[] = $tmp;
            }
        }
        return $tacgia;
    }
}