<?php
class CV_Thuvien_Block_Adminhtml_Docgia_Edit_Tab_Lephi_Renderer_Delete extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
 public function render(Varien_Object $row) { 	
          
 		$return = '';
 		$order = Mage::getModel('thuvien/lephi')->load($row['MaTaichanh']);
 		if($order)
 		{
 			$order_id = $order->getEntityId();
      		$result= "<button id='xoa_le_phi' value='Xóa' style='width:50px' onclick='deleteLephi(".$row['MaTaichanh'].")'>Xóa</button>";
      		$return = Mage::helper('thuvien')->__($result);
 		}
    	return $return;
   }
}
