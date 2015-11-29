<?php

class CV_Thuvien_Block_Adminhtml_Theloai_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

  public function __construct()
  {
      parent::__construct();
      $this->setId('theloai_tabs');
      $this->setDestElementId('edit_form');
      $this->setTitle(Mage::helper('thuvien')->__('Cập nhật thể loại tác phẩm'));
  }

  protected function _beforeToHtml()
  {
      $this->addTab('form_section', array(
          'label'     => Mage::helper('thuvien')->__('Thể loại tác phẩm'),
          'title'     => Mage::helper('thuvien')->__('Thể loại tác phẩm'),
          'content'   => $this->getLayout()->createBlock('thuvien/adminhtml_theloai_edit_tab_form')->toHtml(),
      ));


      return parent::_beforeToHtml();
  }
}