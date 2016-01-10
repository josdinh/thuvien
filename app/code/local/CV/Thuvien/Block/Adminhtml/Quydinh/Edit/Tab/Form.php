<?php

class CV_Thuvien_Block_Adminhtml_Quydinh_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
  protected function _prepareForm()
  {
      $form = new Varien_Data_Form();
      $this->setForm($form);
      $fieldset = $form->addFieldset('quydinh_form', array('legend'=>Mage::helper('thuvien')->__('Quy định Thư Viện')));

      $fieldset->addField('VietTat','hidden',array(
          'label' => Mage::helper('thuvien')->__('Viết Tắt'),
          'class' => 'required-entry',
          'required' => true,
          'name' => 'VietTat',
          'readonly'=>'true',
          'input' => 'hidden'
      ));

      $fieldset->addField('TvVietTat','text',array(
          'label' => Mage::helper('thuvien')->__('Viết Tắt'),
          'class' => 'required-entry',
          'required' => true,
          'name' => 'TvVietTat',
          'readonly'=>'true'
      ));

      $fieldset->addField('MaToChuc','text',array(
          'label' => Mage::helper('thuvien')->__('Mã hệ thông thư viện'),
          'class' => 'required-entry',
          'required' => true,
          'name' => 'MaToChuc',
          'readonly'=>'true'
      ));

      $fieldset->addField('TenThuVien','text',array(
      	'label' => Mage::helper('thuvien')->__('Tên Thư Viện'),
      	'class' => 'required-entry',
      	'required' => true,
      	'name' => 'TenThuVien'
      ));

      $fieldset->addField('DiaChi1','text',array(
      	'label' => Mage::helper('thuvien')->__('Địa chỉ'),
      	'name' => 'DiaChi1'
      ));
		
	  $fieldset->addField('DiaChi2','text',array(
      	'label' => Mage::helper('thuvien')->__('Phường-Quận'),
      	'name' => 'DiaChi2'
      ));
	  $fieldset->addField('ThanhPho','text',array(
      	'label' => Mage::helper('thuvien')->__('Thành Phố'),
      	'name' => 'ThanhPho'
      ));

      $fieldset->addField('DienThoai', 'text', array(
          'label'     => Mage::helper('thuvien')->__('Điện Thoại'),
          'name'      => 'DienThoai',

      ));
	 $fieldset->addField('Email', 'text', array(
          'label'     => Mage::helper('thuvien')->__('Email'),
          'name'      => 'Email',
      ));

      $fieldset->addField('MoCua1', 'text', array(
          'label'     => Mage::helper('thuvien')->__('Giờ mở cửa'),
          'name'      => 'MoCua1',
      ));

      $fieldset->addField('MoCua2', 'text', array(
          'label'     => Mage::helper('thuvien')->__('Ngày mở cửa'),
          'name'      => 'MoCua2',
      ));

      $fieldset->addField('HanDinhMuon', 'text', array(
          'label'     => Mage::helper('thuvien')->__('Hạn định muợn (ngày)'),
          'name'      => 'HanDinhMuon',
      ));

      $fieldset->addField('LePhiTraTre', 'text', array(
          'label'     => Mage::helper('thuvien')->__('Lệ phí trễ hạn (/ngày/tác phẩm)'),
          'name'      => 'LePhiTraTre',
      ));

      $fieldset->addField('TienBaoDam', 'text', array(
          'label'     => Mage::helper('thuvien')->__('Lệ phí ký quỹ'),
          'name'      => 'TienBaoDam',
      ));

      $fieldset->addField('TienNienLiem', 'text', array(
          'label'     => Mage::helper('thuvien')->__('Lệ phí niên liễm'),
          'name'      => 'TienNienLiem',
      ));

      $fieldset->addField('TienLamThe', 'text', array(
          'label'     => Mage::helper('thuvien')->__('Tiền làm lại thẻ'),
          'name'      => 'TienLamThe',
      ));


      if ( Mage::getSingleton('adminhtml/session')->getQuydinhData() )
      {
          $form->setValues(Mage::getSingleton('adminhtml/session')->getQuydinhData());
          Mage::getSingleton('adminhtml/session')->setQuydinhData(null);
      } elseif ( Mage::registry('quydinh_data') ) {
          $form->setValues(Mage::registry('quydinh_data')->getData());
      }
      return parent::_prepareForm();
  }
}