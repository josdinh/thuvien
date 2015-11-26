<?php

class CV_Thuvien_Block_Adminhtml_Docgia_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
  protected function _prepareForm()
  {
      $form = new Varien_Data_Form();
      $this->setForm($form);
      $fieldset = $form->addFieldset('docgia_form', array('legend'=>Mage::helper('thuvien')->__('Thông tin cá nhân')));

      $listThanhPho = Mage::getModel('thuvien/thanhpho')->getCollection();
      $arrThanhPho = array();
      if($listThanhPho->getSize()) {
          foreach($listThanhPho as $key=>$value) {
              $arrThanhPho[$value['ThanhPho']] = $value['TenTp'];
          }
      }

      $fieldset->addField('HoVaTen','text',array(
      	'label' => Mage::helper('thuvien')->__('Họ và Tên'),
      	'class' => 'required-entry',
      	'required' => true,
      	//'onchange'=>'rendkey()',
      	'name' => 'HoVaTen'
      ));
      
      $fieldset->addField('NamSinh','text',array(
      	'label' => Mage::helper('thuvien')->__('Năm sinh'),
      	'class' => 'required-entry',
      	'required' => true,
      	'name' => 'NamSinh'
      ));

      $fieldset->addField('Phai', 'select', array(
          'label'     => Mage::helper('thuvien')->__('Phái'),
          'name'      => 'Phai',

          'values'    => array(
              array(
                  'value'     => 0,
                  'label'     => Mage::helper('thuvien')->__('Nữ'),
              ),
              array(
                  'value'     => 1,
                  'label'     => Mage::helper('thuvien')->__('Nam'),
              ),
          ),
      ));

      $fieldset->addField('DienThoai','text',array(
          'label' => Mage::helper('thuvien')->__('Điện thoại'),
          'class' => 'required-entry',
          'required' => true,
          'name' => 'DienThoai'
      ));

      $fieldset->addField('Email','text',array(
          'label' => Mage::helper('thuvien')->__('Email'),
          'class' => 'required-entry',
          'required' => true,
          'name' => 'Email'
      ));

      $fieldset->addField('DiaChi1','text',array(
          'label' => Mage::helper('thuvien')->__('Địa chỉ'),
          'class' => 'required-entry',
          'required' => true,
          'name' => 'DiaChi1'
      ));

      $fieldset->addField('DiaChi2','text',array(
          'label' => Mage::helper('thuvien')->__('Ph.-Quận'),
          'class' => 'required-entry',
          'required' => true,
          'name' => 'DiaChi2'
      ));


      $fieldset->addField('ThanhPho','select',array(
          'label' => Mage::helper('thuvien')->__('Thành Phố'),
          'class' => 'required-entry',
          'values'=>$arrThanhPho,
          'required' => true,
          'name' => 'ThanhPho'
      ));

      $fieldset->addField('Hinh', 'image', array(
          'label' => Mage::helper('thuvien')->__('Hình ảnh'),
          'required'  => false,
          'name'      => 'Hinh',
      ));

      $fieldset->addField('GhiChu','text',array(
          'label' => Mage::helper('thuvien')->__('Ghi chú'),
          'class' => 'required-entry',
          'required' => false,
          'name' => 'GhiChu'
      ));

      if ( Mage::getSingleton('adminhtml/session')->getDocgiaData() )
      {
          $form->setValues(Mage::getSingleton('adminhtml/session')->getDocgiaData());
          Mage::getSingleton('adminhtml/session')->setDocgiaData(null);
      } elseif ( Mage::registry('docgia_data') ) {
          $form->setValues(Mage::registry('docgia_data')->getData());
      }
      return parent::_prepareForm();
  }
}