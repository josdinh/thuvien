<?php
class MW_Managelicense_Block_Adminhtml_Managelicense_Renderer_Orderurl extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
 public function render(Varien_Object $row) { 	
          
 		$return = '';
 		$order = Mage::getModel('sales/order')->loadByIncrementId($row['order_id']);
 		if($order)
 		{
 			$order_id = $order->getEntityId();
      		$result="<a href='".Mage::helper("adminhtml")->getUrl("adminhtml/sales_order/view/order_id/".$order_id."/key/")."'>" . $row['order_id'] . "</a>";
      		$return = Mage::helper('managelicense')->__($result);
 		}
    	return $return;
   }
}
