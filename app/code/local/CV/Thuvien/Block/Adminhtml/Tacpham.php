<?php
class CV_Thuvien_Block_Adminhtml_Tacpham extends Mage_Adminhtml_Block_Widget_Grid_Container
{
  public function __construct()
  {
    $this->_controller = 'adminhtml_tacpham';
    $this->_blockGroup = 'thuvien';
    $this->_headerText = Mage::helper('thuvien')->__('Quản lý Tác Phẩm');
    $this->_addButtonLabel = Mage::helper('thuvien')->__('Thêm Tác Phẩm');
    parent::__construct();
  }
}