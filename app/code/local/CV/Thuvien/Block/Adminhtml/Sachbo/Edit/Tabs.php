<?php

class CV_Thuvien_Block_Adminhtml_Sachbo_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

  public function __construct()
  {
      parent::__construct();
      $this->setId('sachbo_tabs');
      $this->setDestElementId('edit_form');
      $this->setTitle(Mage::helper('thuvien')->__('Thông tin sách bộ'));
  }

  protected function _beforeToHtml()
  {
      $this->addTab('form_section', array(
          'label'     => Mage::helper('thuvien')->__('Thông tin sách bộ'),
          'title'     => Mage::helper('thuvien')->__('Thông tin sách bộ'),
          'content'   => $this->getLayout()->createBlock('thuvien/adminhtml_sachbo_edit_tab_form')->toHtml(),
      ));

      return parent::_beforeToHtml();
  }
}