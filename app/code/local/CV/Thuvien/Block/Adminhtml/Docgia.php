<?php
class CV_Thuvien_Block_Adminhtml_Docgia extends Mage_Adminhtml_Block_Widget_Grid_Container
{
  public function __construct()
  {
    $this->_controller = 'adminhtml_docgia';
    $this->_blockGroup = 'thuvien';
    $this->_headerText = Mage::helper('thuvien')->__('Quản lý Độc giả');
    $this->_addButtonLabel = Mage::helper('thuvien')->__('Thêm Độc giả');
    parent::__construct();
  }
}