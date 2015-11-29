<?php

class CV_Thuvien_Block_Adminhtml_Quydinh_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

  public function __construct()
  {
      parent::__construct();
      $this->setId('quydinh_tabs');
      $this->setDestElementId('edit_form');
      $this->setTitle(Mage::helper('thuvien')->__('Cập nhật quy định Thư Viện'));
  }

  protected function _beforeToHtml()
  {
      $this->addTab('form_section', array(
          'label'     => Mage::helper('thuvien')->__('Quy định Thư Viện'),
          'title'     => Mage::helper('thuvien')->__('Quy định Thư Viện'),
          'content'   => $this->getLayout()->createBlock('thuvien/adminhtml_quydinh_edit_tab_form')->toHtml(),
      ));


      return parent::_beforeToHtml();
  }
}