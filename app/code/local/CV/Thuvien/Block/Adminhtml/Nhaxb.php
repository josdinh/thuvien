<?php
class CV_Thuvien_Block_Adminhtml_Nhaxb extends Mage_Adminhtml_Block_Widget_Grid_Container
{
  public function __construct()
  {
    $this->_controller = 'adminhtml_nhaxb';
    $this->_blockGroup = 'thuvien';
    $this->_headerText = Mage::helper('thuvien')->__('Nhà XB');
    $this->_addButtonLabel = Mage::helper('thuvien')->__('Thêm Nhà XB');
    parent::__construct();
  }
}