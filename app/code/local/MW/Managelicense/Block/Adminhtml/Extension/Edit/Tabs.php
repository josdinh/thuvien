<?php

class MW_Managelicense_Block_Adminhtml_Extension_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

  public function __construct()
  {
      parent::__construct();
      $this->setId('extension_tabs');
      $this->setDestElementId('edit_form');
      $this->setTitle(Mage::helper('managelicense')->__('Extension'));
  }

  protected function _beforeToHtml()
  {
      $this->addTab('form_section', array(
          'label'     => Mage::helper('managelicense')->__('Extension Infomation'),
          'title'     => Mage::helper('managelicense')->__('Extension Infomation'),
          'content'   => $this->getLayout()->createBlock('managelicense/adminhtml_extension_edit_tab_form')->toHtml(),
      ));
     
      return parent::_beforeToHtml();
  }
}