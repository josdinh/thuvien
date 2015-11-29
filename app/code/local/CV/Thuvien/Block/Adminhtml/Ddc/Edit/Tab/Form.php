<?php

class CV_Thuvien_Block_Adminhtml_Ddc_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
  protected function _prepareForm()
  {
      $form = new Varien_Data_Form();
      $this->setForm($form);
      $fieldset = $form->addFieldset('ddc_form', array('legend'=>Mage::helper('thuvien')->__('DDC tác phẩm')));

      $fieldset->addField('DDC','text',array(
          'label' => Mage::helper('thuvien')->__('DDC'),
          'class' => 'required-entry',
          'required' => true,
          'name' => 'DDC'
      ));


      $fieldset->addField('TenDDC','text',array(
      	'label' => Mage::helper('thuvien')->__('Tên DDC'),
      	'class' => 'required-entry',
      	'required' => true,
      	'name' => 'TenDDC'
      ));

      if ( Mage::getSingleton('adminhtml/session')->getDdcData() )
      {
          $form->setValues(Mage::getSingleton('adminhtml/session')->getDdcData());
          Mage::getSingleton('adminhtml/session')->setDdcData(null);
      } elseif ( Mage::registry('ddc_data') ) {
          $form->setValues(Mage::registry('ddc_data')->getData());
      }
      return parent::_prepareForm();
  }
}