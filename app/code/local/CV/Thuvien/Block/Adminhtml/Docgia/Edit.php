<?php

class CV_Thuvien_Block_Adminhtml_Docgia_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
                 
        $this->_objectId = 'id';
        $this->_blockGroup = 'thuvien';
        $this->_controller = 'adminhtml_docgia';
        
        $this->_updateButton('save', 'label', Mage::helper('thuvien')->__('Lưu'));
        $this->_updateButton('delete', 'label', Mage::helper('thuvien')->__('Xóa'));
		
        $this->_addButton('saveandcontinue', array(
            'label'     => Mage::helper('adminhtml')->__('Lưu và ở lại trang này'),
            'onclick'   => 'saveAndContinueEdit()',
            'class'     => 'save',
        ), -100);
        
        /* $this->_addButton('rendkey', array(
            'label'     => Mage::helper('adminhtml')->__('Rend key'),
            'onclick'   => 'rendkey()',            
        ), -100);
        */

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
        if( Mage::registry('docgia_data') && Mage::registry('docgia_data')->getId() ) {
        	$arrDetail = Mage::registry('docgia_data')->getData();
            return Mage::helper('thuvien')->__("Sửa thông tin Đọc giả'%s'", $this->htmlEscape($arrDetail['HoVaTen']));
        } else {
            return Mage::helper('thuvien')->__('Thêm Độc giả');
        }
    }
}