<?php
class CV_Thuvien_Block_Adminhtml_Quydinh extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_controller = 'adminhtml_quydinh';
        $this->_blockGroup = 'thuvien';
        $this->_headerText = Mage::helper('thuvien')->__('Quy định Thư Viện');
        $this->_addButtonLabel = Mage::helper('thuvien')->__('Thêm Quy định Thư Viện');
        parent::__construct();
    }
}