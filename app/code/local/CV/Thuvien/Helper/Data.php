<?php

class CV_Thuvien_Helper_Data extends Mage_Core_Helper_Abstract
{
	
	
	
	
	/*Get the data value for select box */
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
	public function getDSNgonngu(){		
      $collection = Mage::getModel('thuvien/ngonngu')->getCollection();	  
      $ngonngu = array();
      if($collection->getSize()) {
          foreach($collection as $key=>$value) {
              $ngonngu[$value['MaNgonNgu']] = $value['NgonNgu'];
          }
      }
	  return $ngonngu;
	}
	public function getDSSachbo(){		
      $collection = Mage::getModel('thuvien/sachbo')->getCollection();	  
      $sachbo = array();
      if($collection->getSize()) {
          foreach($collection as $key=>$value) {
              $sachbo[$value['MaSachBo']] = $value['SachBo'];
          }
      }
	  return $sachbo;
	}
}