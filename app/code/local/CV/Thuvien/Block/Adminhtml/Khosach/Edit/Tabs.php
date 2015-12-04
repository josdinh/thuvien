<?php

class CV_Thuvien_Block_Adminhtml_Khosach_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

  public function __construct()
  {
      parent::__construct();
      $this->setId('khosach_tabs');
      $this->setDestElementId('edit_form');
      $this->setTitle(Mage::helper('thuvien')->__('Thông tin kho sách'));
  }

  protected function _beforeToHtml()
  {
      $this->addTab('form_section', array(
          'label'     => Mage::helper('thuvien')->__('Thông tin kho sách'),
          'title'     => Mage::helper('thuvien')->__('Thông tin kho sách'),
          'content'   => $this->getLayout()->createBlock('thuvien/adminhtml_khosach_edit_tab_form')->toHtml(),
      ));

      return parent::_beforeToHtml();
  }
}