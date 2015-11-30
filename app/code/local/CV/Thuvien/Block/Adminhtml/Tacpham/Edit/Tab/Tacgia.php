<?php

class CV_Thuvien_Block_Adminhtml_Tacpham_Edit_Tab_Tacgia extends Mage_Adminhtml_Block_Widget_Form
{
  protected function _prepareForm()
  {
      $form = new Varien_Data_Form();
      $this->setForm($form);
      $fieldset = $form->addFieldset('tacphamcom_form', array('legend'=>Mage::helper('thuvien')->__('Thông tin Tác Giả')));

      $fieldset->addField('TenTacPham','text',array(
      	'label' => Mage::helper('thuvien')->__('Nguyên tác'),      	
      	'required' => true,
		'width'	=>	'150px',
      	//'onchange'=>'rendkey()',
      	'name' => 'TenTacPham'
      ));
      
      $fieldset->addField('NguyenTac','text',array(
      	'label' => Mage::helper('thuvien')->__('Tác giả'),
      	'name' => 'NguyenTac'
      ));
		
	  $fieldset->addField('PhuThem','text',array(
      	'label' => Mage::helper('thuvien')->__('Ký hiệu tác giả'),
      	'name' => 'ThuThem'
      ));
	  $fieldset->addField('TomLuoc','textarea',array(
      	'label' => Mage::helper('thuvien')->__('Dịch giả'),
      	'name' => 'TomLuoc'
      ));	  
      if ( Mage::getSingleton('adminhtml/session')->getDocgiaData() )
      {
          $form->setValues(Mage::getSingleton('adminhtml/session')->getDocgiaData());
          Mage::getSingleton('adminhtml/session')->setDocgiaData(null);
      } elseif ( Mage::registry('tacphamcom_data') ) {
          $form->setValues(Mage::registry('tacphamcom_data')->getData());
      }
      return parent::_prepareForm();
  }
}