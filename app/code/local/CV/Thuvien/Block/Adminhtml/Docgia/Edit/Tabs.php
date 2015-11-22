<?php

class CV_Thuvien_Block_Adminhtml_Docgia_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

  public function __construct()
  {
      parent::__construct();
      $this->setId('docgia_tabs');
      $this->setDestElementId('edit_form');
      $this->setTitle(Mage::helper('thuvien')->__('Sửa thông tin Đọc giả'));
  }

  protected function _beforeToHtml()
  {
      $this->addTab('form_section', array(
          'label'     => Mage::helper('thuvien')->__('Thông tin Đọc giả'),
          'title'     => Mage::helper('thuvien')->__('Thông tin Đọc giả'),
          'content'   => $this->getLayout()->createBlock('thuvien/adminhtml_docgia_edit_tab_form')->toHtml(),
      ));

      if($this->getRequest()->getParam('id')) {
          $this->addTab('lephi_section', array(
              'label' => Mage::helper('thuvien')->__('Lệ phí'),
              'title' => Mage::helper('thuvien')->__('Lệ phí'),
              'content' => $this->getLayout()->createBlock('thuvien/adminhtml_docgia_edit_tab_lephi_form')->toHtml() .
                                            $this->getLayout()->createBlock('thuvien/adminhtml_docgia_edit_tab_lephi_grid')->toHtml(),
          ));
      }

      return parent::_beforeToHtml();
  }
}