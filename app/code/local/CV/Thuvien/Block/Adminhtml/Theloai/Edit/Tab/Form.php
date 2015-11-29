<?php

class CV_Thuvien_Block_Adminhtml_Theloai_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
  protected function _prepareForm()
  {
      $form = new Varien_Data_Form();
      $this->setForm($form);
      $fieldset = $form->addFieldset('theloai_form', array('legend'=>Mage::helper('thuvien')->__('Thể loại tác phẩm')));


      $fieldset->addField('TheLoai','text',array(
      	'label' => Mage::helper('thuvien')->__('Tên Thể Loại'),
      	'class' => 'required-entry',
      	'required' => true,
      	'name' => 'TheLoai'
      ));

      if ( Mage::getSingleton('adminhtml/session')->getTheloaiData() )
      {
          $form->setValues(Mage::getSingleton('adminhtml/session')->getTheloaiData());
          Mage::getSingleton('adminhtml/session')->setTheloaiData(null);
      } elseif ( Mage::registry('theloai_data') ) {
          $form->setValues(Mage::registry('theloai_data')->getData());
      }
      return parent::_prepareForm();
  }
}