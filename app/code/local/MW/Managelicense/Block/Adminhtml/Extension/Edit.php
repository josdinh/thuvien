<?php

class MW_Managelicense_Block_Adminhtml_Extension_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
                 
        $this->_objectId = 'id';
        $this->_blockGroup = 'managelicense';
        $this->_controller = 'adminhtml_extension';
        
        $this->_updateButton('save', 'label', Mage::helper('managelicense')->__('Save Infomation'));
        $this->_updateButton('delete', 'label', Mage::helper('managelicense')->__('Delete '));
		
        $this->_addButton('saveandcontinue', array(
            'label'     => Mage::helper('adminhtml')->__('Save And Continue Edit'),
            'onclick'   => 'saveAndContinueEdit()',
            'class'     => 'save',
        ), -100);

        $this->_formScripts[] = "
            function toggleEditor() {
                if (tinyMCE.getInstanceById('managelicense_content') == null) {
                    tinyMCE.execCommand('mceAddControl', false, 'managelicense_content');
                } else {
                    tinyMCE.execCommand('mceRemoveControl', false, 'managelicense_content');
                }
            }

            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";
    }

    public function getHeaderText()
    {      	
        if( Mage::registry('managelicense_data') && Mage::registry('managelicense_data')->getId() ) {
        	$arrDetail = Mage::registry('managelicense_data')->getData();
        //	Zend_Debug::dump($arrDetail);
            return Mage::helper('managelicense')->__("Edit Extension '%s'", $this->htmlEscape($arrDetail['name']));//Mage::registry('managelicense_data')->getTitle()
        } else {
            return Mage::helper('managelicense')->__('Add Extension');
        }
    }
}