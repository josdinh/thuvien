<?php

class CV_Thuvien_Block_Adminhtml_Ddc_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

  public function __construct()
  {
      parent::__construct();
      $this->setId('ddc_tabs');
      $this->setDestElementId('edit_form');
      $this->setTitle(Mage::helper('thuvien')->__('Cập nhật DDC tác phẩm'));
  }

  protected function _beforeToHtml()
  {
      $this->addTab('form_section', array(
          'label'     => Mage::helper('thuvien')->__('DDC tác phẩm'),
          'title'     => Mage::helper('thuvien')->__('DDC tác phẩm'),
          'content'   => $this->getLayout()->createBlock('thuvien/adminhtml_ddc_edit_tab_form')->toHtml(),
      ));


      return parent::_beforeToHtml();
  }
}