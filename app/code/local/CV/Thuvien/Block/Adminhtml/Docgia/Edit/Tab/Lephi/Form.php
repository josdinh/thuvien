<?php

class CV_Thuvien_Block_Adminhtml_Docgia_Edit_Tab_Lephi_Form extends Mage_Adminhtml_Block_Widget_Form
{
  protected function _prepareForm()
  {
      $form = new Varien_Data_Form();
      $this->setForm($form);
      $fieldset = $form->addFieldset('lephi_form', array('legend'=>Mage::helper('thuvien')->__('Thông tin Lệ phí')));
     
      $fieldset->addField('NgayNhap', 'date', array(
          'label'     => Mage::helper('thuvien')->__('Ngày Nhập'),
          'name'      => 'NgayNhap',
          'format'    => Mage::app()->getLocale()->getDateFormat(Mage_Core_Model_Locale::FORMAT_TYPE_SHORT) ,
      ));
            
      $fieldset->addField('MaLyDo','select',array(
      	'label' => Mage::helper('thuvien')->__('Lý Do'),
      	'name' => 'MaLyDo'
      ));


    /*  $fieldset->addField('HetHan', 'date', array(
          'label'     => Mage::helper('thuvien')->__('Hết Hạn'),
          'name'      => 'HetHan',
      ));*/

      $fieldset->addField('GhiChu', 'select', array(
          'label'     => Mage::helper('thuvien')->__('Ghi Chú'),
          'name'      => 'GhiChu',
      ));

      $fieldset->addField('themlephi', 'button', array(
          'value' => 'Thêm lệ phí',
          'name' => 'themlephi',
          'onclick' => 'test()'
      ));

      if ( Mage::getSingleton('adminhtml/session')->getDocgiaData() )
      {
          $form->addValues(Mage::getSingleton('adminhtml/session')->getDocgiaData());
          Mage::getSingleton('adminhtml/session')->setDocgiaData(null);
      } elseif ( Mage::registry('docgia_data') ) {
          $form->addValues(Mage::registry('docgia_data')->getData());
      }
      return parent::_prepareForm();
  }
}