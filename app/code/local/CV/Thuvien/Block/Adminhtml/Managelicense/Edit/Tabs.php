<?php

class MW_Managelicense_Block_Adminhtml_Managelicense_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

  public function __construct()
  {
      parent::__construct();
      $this->setId('managelicense_tabs');
      $this->setDestElementId('edit_form');
      $this->setTitle(Mage::helper('managelicense')->__('License'));
  }

  protected function _beforeToHtml()
  {
      $this->addTab('form_section', array(
          'label'     => Mage::helper('managelicense')->__('License Infomation'),
          'title'     => Mage::helper('managelicense')->__('License Infomation'),
          'content'   => $this->getLayout()->createBlock('managelicense/adminhtml_managelicense_edit_tab_form')->toHtml(),
      ));
     
      return parent::_beforeToHtml();
  }
}