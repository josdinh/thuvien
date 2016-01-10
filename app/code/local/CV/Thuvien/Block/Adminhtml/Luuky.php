<?php
class CV_Thuvien_Block_Adminhtml_Luuky extends Mage_Adminhtml_Block_Widget_Grid_Container
{
  public function __construct()
  {
    $this->_controller = 'adminhtml_luuky';
    $this->_blockGroup = 'thuvien';
    $this->_headerText = Mage::helper('thuvien')->__('Lưu ký và đề nghị');
    $this->_addButtonLabel = Mage::helper('thuvien')->__('Lưu ký và đề nghị');
    parent::__construct();
  }
}