<?php

class CV_Thuvien_Block_Adminhtml_Nhaxb_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
  protected function _prepareForm()
  {
      $form = new Varien_Data_Form();
      $this->setForm($form);
      $fieldset = $form->addFieldset('nhaxb_form', array('legend'=>Mage::helper('thuvien')->__('Nhà XB')));


      $fieldset->addField('NhaXB','text',array(
      	'label' => Mage::helper('thuvien')->__('Tên Nhà Xuất Bản'),
      	'class' => 'required-entry',
      	'required' => true,
      	'name' => 'NhaXB'
      ));

      if ( Mage::getSingleton('adminhtml/session')->getNhaxbData() )
      {
          $form->setValues(Mage::getSingleton('adminhtml/session')->getNhaxbData());
          Mage::getSingleton('adminhtml/session')->setNhaxbData(null);
      } elseif ( Mage::registry('nhaxb_data') ) {
          $form->setValues(Mage::registry('nhaxb_data')->getData());
      }
      return parent::_prepareForm();
  }
}