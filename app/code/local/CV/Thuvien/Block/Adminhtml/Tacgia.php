<?php
class CV_Thuvien_Block_Adminhtml_Tacgia extends Mage_Adminhtml_Block_Widget_Grid_Container
{
  public function __construct()
  {
    $this->_controller = 'adminhtml_tacgia';
    $this->_blockGroup = 'thuvien';
    $this->_headerText = Mage::helper('thuvien')->__('Tác giả');
    $this->_addButtonLabel = Mage::helper('thuvien')->__('Thêm tác giả');
    parent::__construct();
  }
}