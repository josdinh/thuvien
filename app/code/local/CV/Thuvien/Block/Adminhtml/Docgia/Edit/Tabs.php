<?php

class CV_Thuvien_Block_Adminhtml_Docgia_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

  public function __construct()
  {
      parent::__construct();
      $this->setId('docgia_tabs');
      $this->setDestElementId('edit_form');
      $this->setTitle(Mage::helper('thuvien')->__('Thông tin Độc giả'));
  }

  protected function _beforeToHtml()
  {
      $this->addTab('form_section', array(
          'label'     => Mage::helper('thuvien')->__('Thông tin Độc giả'),
          'title'     => Mage::helper('thuvien')->__('Thông tin Độc giả'),
          'content'   => $this->getLayout()->createBlock('thuvien/adminhtml_docgia_edit_tab_form')->toHtml(),
      ));

      if($this->getRequest()->getParam('id')) {

          $this->addTab('lephi_section', array(
              'label' => Mage::helper('thuvien')->__('Lệ phí'),
              'title' => Mage::helper('thuvien')->__('Lệ phí'),
              'content' => $this->getLayout()->createBlock('thuvien/adminhtml_docgia_edit_tab_lephi_form')->toHtml() .
                                            $this->getLayout()->createBlock('thuvien/adminhtml_docgia_edit_tab_lephi_grid')->toHtml(),
          ));

          $this->addTab('muon_section', array(
              'label' => Mage::helper('thuvien')->__('Mượn'),
              'title' => Mage::helper('thuvien')->__('Mượn'),
              'content' =>  $this->getLayout()->createBlock('thuvien/adminhtml_docgia_edit_tab_muon_form')->toHtml().
                            $this->getLayout()->createBlock('thuvien/adminhtml_docgia_edit_tab_muon_grid')->toHtml(),
          ));

          $this->addTab('tra_section', array(
              'label' => Mage::helper('thuvien')->__('Trả'),
              'title' => Mage::helper('thuvien')->__('Trả'),
              'content' =>  $this->getLayout()->createBlock('thuvien/adminhtml_docgia_edit_tab_tra_grid')->toHtml(),
              'ajax' =>true
          ));

      }

      return parent::_beforeToHtml();
  }
}