<?php

class CV_Thuvien_Helper_Data extends Mage_Core_Helper_Abstract
{
	public function getDSTheLoai(){		
      $collection = Mage::getModel('thuvien/theloai')->getCollection();	  
      $theloai = array();
      if($collection->getSize()) {
          foreach($collection as $key=>$value) {
              $theloai[$value['MaTheLoai']] = $value['TheLoai'];
          }
      }
	  return $theloai;
	}
}