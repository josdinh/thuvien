<?php
class MW_Managelicense_Block_Adminhtml_Managelicense extends Mage_Adminhtml_Block_Widget_Grid_Container
{
  public function __construct()
  {
    $this->_controller = 'adminhtml_managelicense';
    $this->_blockGroup = 'managelicense';
    $this->_headerText = Mage::helper('managelicense')->__('License Manager');
    $this->_addButtonLabel = Mage::helper('managelicense')->__('Add License');
    parent::__construct();
  }
}