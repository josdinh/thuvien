<?php

class CV_Thuvien_Block_Adminhtml_Sachbo_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
  protected function _prepareForm()
  {
      $form = new Varien_Data_Form();
      $this->setForm($form);
      $fieldset = $form->addFieldset('sachbo_form', array('legend'=>Mage::helper('thuvien')->__('Thông tin sách bộ')));


      $fieldset->addField('SachBo','text',array(
      	'label' => Mage::helper('thuvien')->__('Tên sách bộ'),
      	'class' => 'required-entry',
      	'required' => true,
      	'name' => 'SachBo'
      ));



      if ( Mage::getSingleton('adminhtml/session')->getSachboData() )
      {
          $form->setValues(Mage::getSingleton('adminhtml/session')->getSachboData());
          Mage::getSingleton('adminhtml/session')->setSachboData(null);
      } elseif ( Mage::registry('sachbo_data') ) {
          $form->setValues(Mage::registry('sachbo_data')->getData());
      }
      return parent::_prepareForm();
  }
}