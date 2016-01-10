<?php
class CV_Thuvien_Block_Adminhtml_Annhan extends Mage_Adminhtml_Block_Widget_Grid_Container
{
  public function __construct()
  {
    $this->_controller = 'adminhtml_annhan';
    $this->_blockGroup = 'thuvien';
    $this->_headerText = Mage::helper('thuvien')->__('Ân nhân thư viện');
    $this->_addButtonLabel = Mage::helper('thuvien')->__('Ân nhân thư viện');
    parent::__construct();
  }
}