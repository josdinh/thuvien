<?php
class MW_Managelicense_Block_Adminhtml_Managelicense_Renderer_Magentourl extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
 public function render(Varien_Object $row) { 	
          
 		$return = '';
 		$magentourl = $row['magento_url'];
 		if($magentourl)
 		{
 			
      		$result="<a target='_blank' href='".$magentourl."'>" . $magentourl . "</a>";
      		$return = Mage::helper('managelicense')->__($result);
 		}
    	return $return;
   }
}
