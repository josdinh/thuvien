<?php
class MW_Managelicense_Block_Adminhtml_Extension extends Mage_Adminhtml_Block_Widget_Grid_Container
{
  public function __construct()
  {
    $this->_controller = 'adminhtml_extension';
    $this->_blockGroup = 'managelicense';
    $this->_headerText = Mage::helper('managelicense')->__('Extension Manager');
    $this->_addButtonLabel = Mage::helper('managelicense')->__('Add Extension');
    parent::__construct();
  }
}