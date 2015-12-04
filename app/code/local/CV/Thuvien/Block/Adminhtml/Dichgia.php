<?php
class CV_Thuvien_Block_Adminhtml_Dichgia extends Mage_Adminhtml_Block_Widget_Grid_Container
{
  public function __construct()
  {
    $this->_controller = 'adminhtml_dichgia';
    $this->_blockGroup = 'thuvien';
    $this->_headerText = Mage::helper('thuvien')->__('Dịch giả');
    $this->_addButtonLabel = Mage::helper('thuvien')->__('Thêm Dịch giả');
    parent::__construct();
  }
}