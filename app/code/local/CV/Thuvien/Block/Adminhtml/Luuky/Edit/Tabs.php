<?php

class CV_Thuvien_Block_Adminhtml_Luuky_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

  public function __construct()
  {
      parent::__construct();
      $this->setId('luuky_tabs');
      $this->setDestElementId('edit_form');
      $this->setTitle(Mage::helper('thuvien')->__('Sửa thông tin lưu ký'));
  }

  protected function _beforeToHtml()
  {
      $this->addTab('form_section', array(
          'label'     => Mage::helper('thuvien')->__('Lưu ký và đề nghị'),
          'title'     => Mage::helper('thuvien')->__('Lưu ký và đề nghị'),
          'content'   => $this->getLayout()->createBlock('thuvien/adminhtml_luuky_edit_tab_form')->toHtml(),
      ));


      return parent::_beforeToHtml();
  }
}