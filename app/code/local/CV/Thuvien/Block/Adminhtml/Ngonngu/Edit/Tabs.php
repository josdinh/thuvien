<?php

class CV_Thuvien_Block_Adminhtml_Ngonngu_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

  public function __construct()
  {
      parent::__construct();
      $this->setId('ngonngu_tabs');
      $this->setDestElementId('edit_form');
      $this->setTitle(Mage::helper('thuvien')->__('Cập nhật ngôn ngữ'));
  }

  protected function _beforeToHtml()
  {
      $this->addTab('form_section', array(
          'label'     => Mage::helper('thuvien')->__('Ngôn ngữ'),
          'title'     => Mage::helper('thuvien')->__('Ngôn ngữ'),
          'content'   => $this->getLayout()->createBlock('thuvien/adminhtml_ngonngu_edit_tab_form')->toHtml(),
      ));


      return parent::_beforeToHtml();
  }
}