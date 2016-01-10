<?php

class CV_Thuvien_Block_Adminhtml_Annhan_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

  public function __construct()
  {
      parent::__construct();
      $this->setId('annhan_tabs');
      $this->setDestElementId('edit_form');
      $this->setTitle(Mage::helper('thuvien')->__('Sửa thông tin Ân nhân'));
  }

  protected function _beforeToHtml()
  {
      $this->addTab('form_section', array(
          'label'     => Mage::helper('thuvien')->__('Ân nhân thư viện'),
          'title'     => Mage::helper('thuvien')->__('Ân nhân thư viện'),
          'content'   => $this->getLayout()->createBlock('thuvien/adminhtml_annhan_edit_tab_form')->toHtml(),
      ));


      return parent::_beforeToHtml();
  }
}