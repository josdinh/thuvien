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

            function test()
            {
                var addLephiUrl = '".Mage::helper("adminhtml")->getUrl("thuvien/adminhtml_docgia/addLePhi")."';
                alert(addLephiUrl);
            	$('loading-mask').show();
				new Ajax.Request(addLephiUrl, {
				method: 'post',
				parameters: $('edit_form').serialize(),
				onSuccess: function(data){
					alert('ok');
					$('loading-mask').hide();
				},
				onFailure: function(data){
							alert('Error occured when trying to rend key.');
							$('loading-mask').hide();
					}
				});
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
        if( Mage::registry('docgia_data') && Mage::registry('docgia_data')->getId() ) {
        	$arrDetail = Mage::registry('docgia_data')->getData();
            return Mage::helper('thuvien')->__("Sửa thông tin Đọc giả'%s'", $this->htmlEscape($arrDetail['HoVaTen']));
        } else {
            return Mage::helper('thuvien')->__('Thêm Độc giả');
        }
    }
}