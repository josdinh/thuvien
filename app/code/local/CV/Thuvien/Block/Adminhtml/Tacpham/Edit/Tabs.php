<?php

class CV_Thuvien_Block_Adminhtml_Tacpham_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

  public function __construct()
  {
      parent::__construct();
      $this->setId('tacphamcom_tabs');
      $this->setDestElementId('edit_form');
      $this->setTitle(Mage::helper('thuvien')->__('Sửa thông tin Tác Phẩm'));
  }

  protected function _beforeToHtml()
  {
      $this->addTab('form_section', array(
          'label'     => Mage::helper('thuvien')->__('Thông tin Tác Phẩm'),
          'title'     => Mage::helper('thuvien')->__('Thông tin Tác Phẩm'),
          'content'   => $this->getLayout()->createBlock('thuvien/adminhtml_tacpham_edit_tab_form')->toHtml(),
      ));
	
	  
	  $this->addTab('cungtacpham_section', array(
              'label' => Mage::helper('thuvien')->__('Cùng một tác phẩm'),
              'title' => Mage::helper('thuvien')->__('Cùng một tác phẩm'),
              'content' =>  $this->getLayout()->createBlock('thuvien/adminhtml_tacpham_edit_tab_cungtacpham_grid')->toHtml(),
              'ajax' =>true
          ));
	  
      return parent::_beforeToHtml();
  }
}