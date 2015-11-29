<?php
class CV_Thuvien_Block_Adminhtml_Theloai extends Mage_Adminhtml_Block_Widget_Grid_Container
{
  public function __construct()
  {
    $this->_controller = 'adminhtml_theloai';
    $this->_blockGroup = 'thuvien';
    $this->_headerText = Mage::helper('thuvien')->__('Thể loại tác phẩm');
    $this->_addButtonLabel = Mage::helper('thuvien')->__('Thể loại tác phẩm');
    parent::__construct();
  }
}