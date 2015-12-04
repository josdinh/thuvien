<?php
class CV_Thuvien_Block_Adminhtml_Sachbo extends Mage_Adminhtml_Block_Widget_Grid_Container
{
  public function __construct()
  {
    $this->_controller = 'adminhtml_sachbo';
    $this->_blockGroup = 'thuvien';
    $this->_headerText = Mage::helper('thuvien')->__('Sách bộ');
    $this->_addButtonLabel = Mage::helper('thuvien')->__('Thêm sách bộ');
    parent::__construct();
  }
}