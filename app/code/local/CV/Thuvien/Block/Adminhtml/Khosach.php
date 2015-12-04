<?php
class CV_Thuvien_Block_Adminhtml_Khosach extends Mage_Adminhtml_Block_Widget_Grid_Container
{
  public function __construct()
  {
    $this->_controller = 'adminhtml_khosach';
    $this->_blockGroup = 'thuvien';
    $this->_headerText = Mage::helper('thuvien')->__('Kho sách');
    $this->_addButtonLabel = Mage::helper('thuvien')->__('Thêm Kho sách');
    parent::__construct();
  }
}