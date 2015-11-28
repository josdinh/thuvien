<?php

class CV_Thuvien_Block_Adminhtml_Tacpham_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
                 
        $this->_objectId = 'id';
        $this->_blockGroup = 'thuvien';
        $this->_controller = 'adminhtml_tacpham';
        
        $this->_updateButton('save', 'label', Mage::helper('thuvien')->__('Lưu'));
        $this->_updateButton('delete', 'label', Mage::helper('thuvien')->__('Xóa'));
		
        $this->_addButton('saveandcontinue', array(
            'label'     => Mage::helper('adminhtml')->__('Lưu và ở lại trang này'),
            'onclick'   => 'saveAndContinueEdit()',
            'class'     => 'save',
        ), -100); 
        $this->_formScripts[] = "
            function toggleEditor() {
                if (tinyMCE.getInstanceById('thuvien_content') == null) {
                    tinyMCE.execCommand('mceAddControl', false, 'thuvien_content');
                } else {
                    tinyMCE.execCommand('mceRemoveControl', false, 'thuvien_content');
                }
            }

            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }


        ";
    }

    public function getHeaderText()
    {    	
        if( Mage::registry('tacphamcom_data') && Mage::registry('tacphamcom_data')->getId() ) {
        	$arrDetail = Mage::registry('tacphamcom_data')->getData();
            return Mage::helper('thuvien')->__("Sửa thông tin Tác Phẩm '%s'", $this->htmlEscape($arrDetail['TenTacPham']));
        } else {
            return Mage::helper('thuvien')->__('Thêm Tác Phẩm');
        }
    }
}