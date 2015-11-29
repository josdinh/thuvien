<?php

class CV_Thuvien_Block_Adminhtml_Docgia_Edit_Tab_Tra_Form extends Mage_Adminhtml_Block_Widget_Form
{
  protected function _prepareForm()
  {
      $form = new Varien_Data_Form();
      $this->setForm($form);
      $fieldset = $form->addFieldset('docgia_tra_form', array('legend'=>Mage::helper('thuvien')->__('Trả Tác phẩm')));
      $maDocGia = $this->getRequest()->getParam('id');
      $fieldset->addField('MaSachTra','text',array(
          'label' => Mage::helper('thuvien')->__('Mã Tác phẩm'),
          'name' => 'SoTien',
          'style' => 'width:150px'
      ));

      $traUrl = Mage::helper("adminhtml")->getUrl("thuvien/adminhtml_muontra/tratpdocgia");
      $fieldset->addField('docgia_muon', 'button', array(
          'value' => 'Trả',
          'name' => 'docgia_tra',
          'onclick' => 'tratpdocgia(\''.$traUrl.'\','.$maDocGia.')',
          'style' => '123',
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