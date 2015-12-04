<?php

class CV_Thuvien_Block_Adminhtml_Nhaxb_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

  public function __construct()
  {
      parent::__construct();
      $this->setId('nhaxb_tabs');
      $this->setDestElementId('edit_form');
      $this->setTitle(Mage::helper('thuvien')->__('Cập nhật Nhà Xuất Bản'));
  }

  protected function _beforeToHtml()
  {
      $this->addTab('form_section', array(
          'label'     => Mage::helper('thuvien')->__('Nhà Xuất Bản'),
          'title'     => Mage::helper('thuvien')->__('Nhà Xuất Bản'),
          'content'   => $this->getLayout()->createBlock('thuvien/adminhtml_nhaxb_edit_tab_form')->toHtml(),
      ));


      return parent::_beforeToHtml();
  }
}