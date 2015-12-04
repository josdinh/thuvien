<?php

class CV_Thuvien_Block_Adminhtml_Tacgia_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
  protected function _prepareForm()
  {
      $form = new Varien_Data_Form();
      $this->setForm($form);
      $fieldset = $form->addFieldset('tacgia_form', array('legend'=>Mage::helper('thuvien')->__('Thông tin tác giả')));


      $fieldset->addField('TenTacGia','text',array(
      	'label' => Mage::helper('thuvien')->__('Tên tác giả'),
      	'class' => 'required-entry',
      	'required' => true,
      	'name' => 'TenTacGia'
      ));

      $fieldset->addField('KyHieuTg','text',array(
          'label' => Mage::helper('thuvien')->__('Ký hiệu tác giả'),
          'name' => 'KyHieuTg'
      ));

      if ( Mage::getSingleton('adminhtml/session')->getTacgiaData() )
      {
          $form->setValues(Mage::getSingleton('adminhtml/session')->getTacgiaData());
          Mage::getSingleton('adminhtml/session')->setTacgiaData(null);
      } elseif ( Mage::registry('tacgia_data') ) {
          $form->setValues(Mage::registry('tacgia_data')->getData());
      }
      return parent::_prepareForm();
  }
}