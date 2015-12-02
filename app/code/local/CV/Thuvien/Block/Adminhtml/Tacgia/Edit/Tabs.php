<?php

class CV_Thuvien_Block_Adminhtml_Tacgia_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

  public function __construct()
  {
      parent::__construct();
      $this->setId('tacgia_tabs');
      $this->setDestElementId('edit_form');
      $this->setTitle(Mage::helper('thuvien')->__('Thông tin tác giả'));
  }

  protected function _beforeToHtml()
  {
      $this->addTab('form_section', array(
          'label'     => Mage::helper('thuvien')->__('Thông tin tác giả'),
          'title'     => Mage::helper('thuvien')->__('Thông tin tác giả'),
          'content'   => $this->getLayout()->createBlock('thuvien/adminhtml_tacgia_edit_tab_form')->toHtml(),
      ));


      return parent::_beforeToHtml();
  }
}