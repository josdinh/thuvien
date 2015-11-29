<?php
class CV_Thuvien_Block_Adminhtml_Ddc extends Mage_Adminhtml_Block_Widget_Grid_Container
{
  public function __construct()
  {
    $this->_controller = 'adminhtml_ddc';
    $this->_blockGroup = 'thuvien';
    $this->_headerText = Mage::helper('thuvien')->__('DDC tác phẩm');
    $this->_addButtonLabel = Mage::helper('thuvien')->__('DDC tác phẩm');
    parent::__construct();
  }
}