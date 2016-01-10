<?php

class CV_Thuvien_Block_Adminhtml_Ngonngu_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
  protected function _prepareForm()
  {
      $form = new Varien_Data_Form();
      $this->setForm($form);
      $fieldset = $form->addFieldset('ngonngu_form', array('legend'=>Mage::helper('thuvien')->__('Ngôn ngữ')));


      $fieldset->addField('NgonNgu','text',array(
      	'label' => Mage::helper('thuvien')->__('Ngôn ngữ'),
      	'class' => 'required-entry',
      	'required' => true,
      	'name' => 'NgonNgu'
      ));

      if ( Mage::getSingleton('adminhtml/session')->getNgonnguData() )
      {
          $form->setValues(Mage::getSingleton('adminhtml/session')->getNgonnguData());
          Mage::getSingleton('adminhtml/session')->setNgonnguData(null);
      } elseif ( Mage::registry('ngonngu_data') ) {
          $form->setValues(Mage::registry('ngonngu_data')->getData());
      }
      return parent::_prepareForm();
  }
}