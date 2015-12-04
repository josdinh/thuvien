<?php

class CV_Thuvien_Block_Adminhtml_Khosach_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
  protected function _prepareForm()
  {
      $form = new Varien_Data_Form();
      $this->setForm($form);
      $fieldset = $form->addFieldset('khosach_form', array('legend'=>Mage::helper('thuvien')->__('Thông tin kho sách')));


      $fieldset->addField('KhoSach','text',array(
      	'label' => Mage::helper('thuvien')->__('Tên Kho Sách'),
      	'class' => 'required-entry',
      	'required' => true,
      	'name' => 'KhoSach'
      ));

      $fieldset->addField('VietTat','text',array(
          'label' => Mage::helper('thuvien')->__('Viết Tắt'),
          'class' => 'required-entry',
          'required' => true,
          'name' => 'VietTat'
      ));



      if ( Mage::getSingleton('adminhtml/session')->getKhosachData() )
      {
          $form->setValues(Mage::getSingleton('adminhtml/session')->getKhosachData());
          Mage::getSingleton('adminhtml/session')->setKhosachData(null);
      } elseif ( Mage::registry('khosach_data') ) {
          $form->setValues(Mage::registry('khosach_data')->getData());
      }
      return parent::_prepareForm();
  }
}