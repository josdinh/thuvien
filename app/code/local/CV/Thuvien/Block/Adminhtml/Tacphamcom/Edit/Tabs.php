<?php

class CV_Thuvien_Block_Adminhtml_Tacphamcom_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

  public function __construct()
  {
      parent::__construct();
      $this->setId('tppopcom_tabs');
      $this->setDestElementId('edit_form');
      $this->setTitle(Mage::helper('thuvien')->__('Thông tin Tác Phẩm'));
  }

  protected function _beforeToHtml()
  {
     $this->addTab('form_chung_section', array(
          'label'     => Mage::helper('thuvien')->__('Thông tin tác phẩm'),
          'title'     => Mage::helper('thuvien')->__('Thông tin tác phẩm'),
          'content'   => $this->getLayout()->createBlock('thuvien/adminhtml_tacphamcom_edit_tab_form')->toHtml(),
      ));

	  $this->addTab('tacgiakhac_section', array(
          'label'     => Mage::helper('thuvien')->__('Tác giả khác'),
          'title'     => Mage::helper('thuvien')->__('Tác giả khác'),
          'url'       => $this->getUrl('*/*/tacgiakhac', array('_current' => true)),
          'class'     => 'ajax',
      ));

      $this->addTab('dichgia_section', array(
          'label'     => Mage::helper('thuvien')->__('Dich giả'),
          'title'     => Mage::helper('thuvien')->__('Dich giả'),
          'url'       => $this->getUrl('*/*/dichgia', array('_current' => true)),
          'class'     => 'ajax',
      ));

	 $this->addTab('cungtacpham_section', array(
          'label' => Mage::helper('thuvien')->__('Cùng một tác phẩm'),
          'title' => Mage::helper('thuvien')->__('Cùng một tác phẩm'),
          'url'       => $this->getUrl('*/*/cungtp', array('_current' => true)),
         'class'     => 'ajax',
     ));
      return parent::_beforeToHtml();
  }
}