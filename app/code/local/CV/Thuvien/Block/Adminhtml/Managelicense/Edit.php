<?php

class MW_Managelicense_Block_Adminhtml_Managelicense_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
                 
        $this->_objectId = 'id';
        $this->_blockGroup = 'managelicense';
        $this->_controller = 'adminhtml_managelicense';
        
        $this->_updateButton('save', 'label', Mage::helper('managelicense')->__('Save License'));
        $this->_updateButton('delete', 'label', Mage::helper('managelicense')->__('Delete License'));
		
        $this->_addButton('saveandcontinue', array(
            'label'     => Mage::helper('adminhtml')->__('Save And Continue Edit'),
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
                if (tinyMCE.getInstanceById('managelicense_content') == null) {
                    tinyMCE.execCommand('mceAddControl', false, 'managelicense_content');
                } else {
                    tinyMCE.execCommand('mceRemoveControl', false, 'managelicense_content');
                }
            }

            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
            
           /*function rendkey()            
            {
            	if($('status').value==2)
            	{
            	var base_url_js = '".Mage::getBaseUrl('link',Mage::getStoreConfig('web/secure/use_in_frontend') || Mage::getStoreConfig('web/secure/use_in_adminhtml'))."';
            	 var mage =    $('magento_url').value;  
            	 var module =   $('extension').value;   
            	$('loading-mask').show();
				new Ajax.Request(base_url_js+'managelicense/index/rendkey', {
				method: 'post',
				parameters: {'domain':mage, 'module':module}, 
				onSuccess: function(data){
					if(data.responseText)
						{																		
							$('key_active').value = data.responseText;				
						}				 
					$('loading-mask').hide();
				},
				onFailure: function(data){					
							alert('Error occured when trying to rend key.');	
							$('loading-mask').hide();					
					}
				});
				}
				else
				{
				 $('key_active').value = '';	
    			}

    		}*/
        ";
    }

    public function getHeaderText()
    {    	
        if( Mage::registry('managelicense_data') && Mage::registry('managelicense_data')->getId() ) {
        	$arrDetail = Mage::registry('managelicense_data')->getData();
            return Mage::helper('managelicense')->__("Edit License '%s'", $this->htmlEscape($arrDetail['extension']));//Mage::registry('managelicense_data')->getTitle()
        } else {
            return Mage::helper('managelicense')->__('Add License');
        }
    }
}