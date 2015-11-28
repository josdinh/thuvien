<?php

class CV_Thuvien_Block_Adminhtml_Tacpham_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
  protected function _prepareForm()
  {
      $form = new Varien_Data_Form();
      $this->setForm($form);
      $fieldset = $form->addFieldset('tacphamcom_form', array('legend'=>Mage::helper('thuvien')->__('Thông tin Tác Phẩm')));

      $fieldset->addField('TenTacPham','text',array(
      	'label' => Mage::helper('thuvien')->__('Tên Tác Phẩm'),
      	'class' => 'required-entry',
      	'required' => true,
      	//'onchange'=>'rendkey()',
      	'name' => 'TenTacPham'
      ));
      
      $fieldset->addField('NguyenTac','text',array(
      	'label' => Mage::helper('thuvien')->__('Nguyên tác'),
      	'name' => 'NguyenTac'
      ));
		
	  $fieldset->addField('PhuThem','text',array(
      	'label' => Mage::helper('thuvien')->__('Phụ đề'),
      	'name' => 'ThuThem'
      ));
	  $fieldset->addField('TomLuoc','textarea',array(
      	'label' => Mage::helper('thuvien')->__('Tóm lược'),
      	'name' => 'TomLuoc'
      ));
	  $theloai=Mage::helper('thuvien')->getDSTheLoai();
      $fieldset->addField('MaLoaiTacPham', 'select', array(
          'label'     => Mage::helper('thuvien')->__('Thể loại'),
          'name'      => 'MaLoaiTacPham',
		  'values'=>$theloai,          
      ));
	 $fieldset->addField('MaDDC', 'select', array(
          'label'     => Mage::helper('thuvien')->__('Mã DCC'),
          'name'      => 'MaDDC',          
      ));
      $fieldset->addField('TapSo','text',array(
          'label' => Mage::helper('thuvien')->__('Tập số'),                   
          'name' => 'TapSo'
      ));

      $fieldset->addField('MaSachBo','text',array(
          'label' => Mage::helper('thuvien')->__('Sách bộ'),
          'name' => 'MaSachBo'
      ));
	  $ngonngu=Mage::helper('thuvien')->getDSNgonngu();
	  //Zend_debug::dump($ngonngu);
      $fieldset->addField('MaNgonNgu','select',array(
          'label' => Mage::helper('thuvien')->__('Ngôn ngữ'),          
          'required' => true,
          'name' => 'MaNgonNgu',
		  'values'=>$ngonngu,  
      ));

      $fieldset->addField('ISBN','text',array(
          'label' => Mage::helper('thuvien')->__('ISBN-ISSN'),
          'name' => 'ISBN'
      ));
      if ( Mage::getSingleton('adminhtml/session')->getDocgiaData() )
      {
          $form->setValues(Mage::getSingleton('adminhtml/session')->getDocgiaData());
          Mage::getSingleton('adminhtml/session')->setDocgiaData(null);
      } elseif ( Mage::registry('tacphamcom_data') ) {
          $form->setValues(Mage::registry('tacphamcom_data')->getData());
      }
      return parent::_prepareForm();
  }
}