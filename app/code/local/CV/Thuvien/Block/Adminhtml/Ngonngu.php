<?php
class CV_Thuvien_Block_Adminhtml_Ngonngu extends Mage_Adminhtml_Block_Widget_Grid_Container
{
  public function __construct()
  {
    $this->_controller = 'adminhtml_ngonngu';
    $this->_blockGroup = 'thuvien';
    $this->_headerText = Mage::helper('thuvien')->__('Ngôn ngữ');
    $this->_addButtonLabel = Mage::helper('thuvien')->__('Ngôn ngữ');
    parent::__construct();
  }
}