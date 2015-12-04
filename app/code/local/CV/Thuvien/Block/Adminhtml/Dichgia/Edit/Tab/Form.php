<?php

class CV_Thuvien_Block_Adminhtml_Dichgia_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
  protected function _prepareForm()
  {
      $form = new Varien_Data_Form();
      $this->setForm($form);
      $fieldset = $form->addFieldset('dichgia_form', array('legend'=>Mage::helper('thuvien')->__('Thông tin dịch giả')));


      $fieldset->addField('TenDichGia','text',array(
      	'label' => Mage::helper('thuvien')->__('Tên dịch giả'),
      	'class' => 'required-entry',
      	'required' => true,
      	'name' => 'TenDichGia'
      ));



      if ( Mage::getSingleton('adminhtml/session')->getDichgiaData() )
      {
          $form->setValues(Mage::getSingleton('adminhtml/session')->getDichgiaData());
          Mage::getSingleton('adminhtml/session')->setDichgiaData(null);
      } elseif ( Mage::registry('dichgia_data') ) {
          $form->setValues(Mage::registry('dichgia_data')->getData());
      }
      return parent::_prepareForm();
  }
}