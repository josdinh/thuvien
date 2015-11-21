<?php
class MW_Managelicense_Model_Managelicense_Api extends Mage_Api_Model_Resource_Abstract
{
	
// mess 97, 98 active successfully
	const MESS_97 = " extension is activated successfully!";
	
	const MESS_98 = " extension is activated successfully!"; // it is activated before
	
	// error 101, 102, 103 = mess error 101
	const MESS_101 = "The order number is invalid. Please <a href='http://www.mage-world.com/contacts/' target='_blank'>contact us</a> if you need any support.";	
		
	// error 104 order is actived on another domain
	const MESS_104 = "The order number is activated on other magento installation. Please <a href='http://www.mage-world.com/contacts/' target='_blank'>contact us</a> if you need to change the domain.";
	
	// error 105 correct extension, order and have no domain is activated but this domain is saved with status "pending" before
	const MESS_105 = "The order number is activated on other magento installation. Please <a href='http://www.mage-world.com/contacts/' target='_blank'>contact us</a> if you need to change the domain.";
	
	// ERROR when customer active on local host
	const MESS_106 = "The order number is invalid.";
	
    const MESS_FAIL = "Activate failed. Please enter a valid activation key.";
	
	const MESS_SUCCESS= "Activate successfully. Please, login or logout backend to update infomation.";
	
	
	public function verify($infoactive)
	{
		// status license: 0-cancelled, 1-pending, 2-activated, 3-trial
		$result = array();			
		if($infoactive)
		{
			$module = $infoactive['module'];
			$orderid = $infoactive['orderid'];
			$domain = $infoactive['domain'];
			$modsku = $this->getModSKU($module);
				
			$infolog= "Order: ".$orderid." ,extension: ".$module." ,sku extension: ".$modsku." , domain: ".$domain;	
			if($this->checkDomain($domain))
			{
				 if($this->checkExistOrder($orderid))
				 {
			  		if($this->checkOrderIsComplete($orderid))
						{
							if($modsku!="")
								{
									if($this->checkExistProductOrder($orderid,$modsku))
										{
											if($this->existDomainStatus($orderid,$module,$domain,2))
												{
														$infolog .= 'Active successfully because it was actived before';
														$result[0] = md5(md5('true.')).'_'.md5($domain);
														$result[1] = "The ".trim($this->getExtensionName($modsku)).self::MESS_98;//md5(Mage::helper('core')->encrypt('98')); 
														$result[2] = self::MESS_SUCCESS;
												}
											else 
												{
														if($this->checkExistLicense($orderid,$module,$modsku))
															{
																if($this->isStatusLicense($orderid,$module,2))//actived 
																{
																	// update infomation and send back information to active
																	// insert new record with status = pending 
															    	$message = " Already activated \n";
																	$infolog .=" \n Order is actived on another domain";
																	if($this->existDomainStatus($orderid,$module,$domain,0) || $this->existDomainStatus($orderid,$module,$domain,1))
																	{	
																		$infolog .=" \n Insert license with status is pending";
																		$this -> updatePending($orderid,$module,$domain,$message);// status = "pending", sent mail to customer	
																	}
																	else 
																	{
																		$infolog .=" \n Update license with status is pending";
																		$this->insertPending($orderid,$module,$domain,$message); 
																	}						
																	$result[0] = md5(md5('false.')).'_'.md5($domain);
																	$result[1] = self::MESS_104; 
																	$result[2] = self::MESS_FAIL;
																				
																}
																else 
																{
																	$message = " Already pending \n";
																	if(!$this->existDomainStatus($orderid,$module,$domain,0) && !$this->existDomainStatus($orderid,$module,$domain,1))
																	{
																		$infolog .=" \nActived successfully";
																		$this->insertLicense($orderid,$module,$domain);  
																		$result[0] = md5(md5('true.')).'_'.md5($domain);
																		$result[1] = "The ".trim($this->getExtensionName($modsku)).self::MESS_97;//md5(Mage::helper('core')->encrypt('97')); 													
																		$result[2] = self::MESS_SUCCESS;
																	}	
																	else
																	{
																		$infolog .=" \n Error: it was closed or pended before";
																		$this -> updatePending($orderid,$module,$domain,$message);													
																		$result[0] = md5(md5('false.')).'_'.md5($domain);
																		$result[1] = self::MESS_105;
																		$result[2] = self::MESS_FAIL;
																	}
																	
																}
															}
														else 
														{
															$infolog .=" \n Active successfully";
															$this->insertLicense($orderid,$module,$domain); 
															$result[0] = md5(md5('true.')).'_'.md5($domain);
															$result[1] = "The ".trim($this->getExtensionName($modsku)).self::MESS_97;//md5(Mage::helper('core')->encrypt('97')); 
															$result[2] = self::MESS_SUCCESS;
														}
																														
												  }												
										}
										else
										{
											$infolog .=" \nError: correct order number and complete but wrong extension";
											$message = " Wrong extension";
											if($this->existDomainStatus($orderid,$module,$domain,0) || $this->existDomainStatus($orderid,$module,$domain,1))
											{
												$infolog .=" \n Update license with status is pending";
												$this -> updatePending($orderid,$module,$domain,$message);																							
											}	
											else
											{
												$infolog .=" \n Insert license with status is pending";
												$this->insertPending($orderid,$module, $domain, $message);	
											}					
											$result[0] = md5(md5('false.')).'_'.md5($domain);
											$result[1] = self::MESS_101;//md5(Mage::helper('core')->encrypt('102')); 
											$result[2] = self::MESS_FAIL;
										} 
							}
							else 
							{
								$infolog .=" \nError: order complete but sku extension is null";
								$message = " Wrong extension";
								if(!$this->existDomainStatus($orderid,$module,$domain,0) && !$this->existDomainStatus($orderid,$module,$domain,1))
								{
									$this->insertPending($orderid,  $module, $domain, $message);																							
								}	
								else
								{
									$this -> updatePending($orderid,$module,$domain,$message);	
								}														
								$result[0] = md5(md5('false.')).'_'.md5($domain);
								$result[1] = self::MESS_101; 
								$result[2] = self::MESS_FAIL;
							}	
						}
						else 
						{
							$infolog .=" \nError: exist order number but not complete";
							$result[0] = md5(md5('false.')).'_'.md5($domain);
							$result[1] = self::MESS_101;
							$result[2] = self::MESS_FAIL;
						}	
				}	
				else 
				{
					//the order number is not exist
					$infolog .=" \n Error: the order number is not exist";
					$result[0] = md5(md5('false.')).'_'.md5($domain);
					$result[1] = self::MESS_101;
					$result[2] = self::MESS_FAIL;
				}	
			}	
			else 
			{
				// extension not exist
				$infolog .=" \n Error: active on localhost";
				$result[0] = md5(md5('false.')).'_'.md5($domain);
				$result[1] = self::MESS_106;
				$result[2] = self::MESS_FAIL;
			}
		
			Mage::log($infolog."\n\n ");
		}	
		return $result;
	}
	
	//Note : $orderid is increment_idmag
	
	public function checkExistProductOrder($orderid,$modsku)
	{		
		$order = Mage::getModel('sales/order')
  				->getCollection()  			
  				->addAttributeToFilter('increment_id', $orderid)
  				->getFirstItem();
  		
		$items = $order->getAllItems();
		$mod_skus = explode(',',$modsku);

		foreach ($items as $itemId => $item)
		{
			$item_sku = $item->getSku();		    
			if(in_array($item_sku, $mod_skus)) return true;
		}
	
		return false;	
	}
	
	// check existorder
	public function checkExistOrder($orderid)
	{		
		// load order
		//	->addAttributeToFilter('state', array('neq' => Mage_Sales_Model_Order::STATE_CANCELED))
		
		$order = Mage::getModel('sales/order')
  				->getCollection()  			
  				->addAttributeToFilter('increment_id', $orderid)
  				->getData();
		
		if($order)
		return true;
		else 
		return false;
	}
	
	public function getModSKU($module)
	{
		$al_modules = Mage::helper('managelicense')->getExtensionInfo(); //Mage::helper('managelicense')->co_modules;
		foreach ($al_modules as $key=>$value)
		{
			if($value['key'] == $module)
			return $value['sku'];
		}
		return "";		
	}
	
	
	public function checkOrderIsComplete($orderid)
	{		
		$order = Mage::getModel('sales/order')
  				->getCollection()  
  				->addAttributeToFilter('state', array('eq' => Mage_Sales_Model_Order::STATE_COMPLETE))			
  				->addAttributeToFilter('increment_id', $orderid)
  				->getFirstItem();
  		$items = $order->getAllItems();
  		
		if(count($items)> 0)
		return true;
		else
		return false;	
	}
	
	public function checkExistLicense($orderid,$module,$modsku)
	{
		$manage = Mage::getModel('managelicense/managelicense');
		// you have to check similar with extension and order_id
		// $filter_a = array('eq'=>1);
   		// $filter_b = array('eq'=>2);
		
		$row = $manage->getCollection()
				-> addFieldToFilter('extension',$module)
				-> addFieldToFilter('order_id',$orderid)
				-> addFieldToFilter('status',2)
				//-> addFieldToFilter('status',array($filter_a,$filter_b))
				->getData();		
		if( $this->getQtyProduct($orderid,$modsku)<=count($row) && $row)
				return true;
		else
			    return false;	
	}
	
	public function insertLicense($orderid,$module,$domain)
	{		
				
		$email = $this->getEmailOrder($orderid);		
		$rendkey = Mage::helper('managelicense')->rendKey($module,$domain); 	
		if($this->checkExistTrial($module,$domain))
		{
			//update trial to license
		$manage = Mage::getModel('managelicense/managelicense');
		$row = $manage->getCollection()
  					->addFieldToFilter('extension', $module)
  					->addFieldToFilter('magento_url', $domain) 
  					->addFieldToFilter('status', 3)  					
  					->getFirstItem();   					
			$row->setOrderId($orderid);	
		    $row->setEmail($email);
		    $row->setStatus(2);		   
		    $row->setActiveDate(date('Y-m-d H:i:s'));
		    $row->setKeyActive($rendkey);		  
		    $row->save();
		
		}
		else 
		{	
			$manage = Mage::getModel('managelicense/managelicense');
			// new license	
			$manage->setOrderId($orderid);									
		    $manage->setExtension($module);		    
		    $manage->setEmail($email);
		    $manage->setMagentoUrl($domain);
		    $manage->setStatus(2);
		    $manage->setActiveDate(date('Y-m-d H:i:s'));
		    $manage->setPurchasedDate(date('Y-m-d H:i:s'));
		    $manage->setKeyActive($rendkey);
		    $manage->save();
		}
	}
	
	public function insertPending($orderid,$module,$domain,$message)
	{
		$email = $this->getEmailOrder($orderid);
		$manage = Mage::getModel('managelicense/managelicense');
			$manage->setStatus(1);
			$manage->setOrderId($orderid);	
			// $manage->setSku($modsku);							
		    $manage->setExtension($module);		   
		    $manage->setEmail($email);
		    $manage->setMagentoUrl($domain);	
		    $manage->setComment($message);		  	    
		    $manage->setPurchasedDate(date('Y-m-d H:i:s'));
		    $manage->setActiveDate(date('Y-m-d H:i:s'));
		    $manage->save();
	}
	
	public function updatePending($orderid,$module,$domain,$message)
	{
		$email = $this->getEmailOrder($orderid);
		$manage = Mage::getModel('managelicense/managelicense')			
  					->getCollection()  					
  					->addFieldToFilter('order_id', $orderid)
  					->addFieldToFilter('extension', $module)
  					->addFieldToFilter('magento_url', $domain)  					
  					->getFirstItem();  				
  		
  		$manage->setActiveDate(date('Y-m-d H:i:s'));
  		$manage->setComment($message);	
		$manage->save();
	}
	
	public function getEmailOrder($orderId)
	{
		$order = Mage::getModel('sales/order')
  				->getCollection()
  				->addAttributeToFilter('increment_id',$orderId)
  				->getFirstItem()->getData();  				
  		
  		if($order)
  		{
  	 		 return 	$order['customer_email'];
  		}
  		else 
  			return "";
			
	}
	
	public function checkStatusLicense($orderid,$module,$domain)
	{
		$manage = Mage::getModel('managelicense/managelicense');
		// you have to check similar with extension and order_id
		// $filter_a = array('eq'=>1);
   		// $filter_b = array('eq'=>2);
		
		$row = $manage->getCollection()
				-> addFieldToFilter('extension',$module)
				-> addFieldToFilter('order_id',$orderid)
				//-> addFieldToFilter('status',array($filter_a,$filter_b))
				->getData();		
		if($row)
				return true;
		else
			    return false;
	}
	
	public function existDomainStatus($orderid,$module,$domain,$status)
	{
		$manage = Mage::getModel('managelicense/managelicense');
				
		$row = $manage->getCollection()
				-> addFieldToFilter('extension',$module)
				-> addFieldToFilter('order_id',$orderid)
				-> addFieldToFilter('magento_url',$domain)
				-> addFieldToFilter('status',$status)				
				->getData();		
		
		if($row)
				return true;
		else
			    return false;	
	}
	
	public function isStatusLicense($orderid,$module,$status)
	{
		$manage = Mage::getModel('managelicense/managelicense');
				
		$row = $manage->getCollection()
				-> addFieldToFilter('extension',$module)
				-> addFieldToFilter('order_id',$orderid)				
				-> addFieldToFilter('status',$status)				
				->getData();		
		
		if($row)
				return true;
		else
			    return false;	
	}

	public function getExtensionInfo()
	{
		return Mage::getModel('managelicense/extension')->getCollection()->getData();		
	}
	
	public function checkDomain($domain)
	{
		$valid = preg_match('/\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}/', $domain);
		if(strpos(strtolower($domain),'localhost') !== false || $valid)
		return false;
		return true;
	}
	
	public function insertTrial($infoactive)
	{		
		$module = $infoactive['module'];		
		$domain = $infoactive['domain'];
		$type = $infoactive['type'];		
		if($this->checkDomain($domain))
			{
				if(!$this->checkExistTrial($module, $domain))
				{						
					    $manage = Mage::getModel('managelicense/managelicense');
					    $manage->setExtension($module);		  
					    $manage->setMagentoUrl($domain);
					    $manage->setComment($type);		  
					    $manage->setStatus(3);
					    $manage->setPurchasedDate(date('Y-m-d H:i:s'));
					    $manage->setActiveDate(date('Y-m-d H:i:s'));		    
					    $manage->save();
				}
			}
	}
	
	public function checkExistTrial($module,$domain)
	{
		$manage = Mage::getModel('managelicense/managelicense');
		
		$row = $manage->getCollection()
				-> addFieldToFilter('extension',$module)
				-> addFieldToFilter('magento_url',$domain)
				-> addFieldToFilter('status',3)				
				->getData();
						
		if($row)
				return true;
		else
			    return false;	
	}
	
	public function getExtensionName($sku)
	{
		try {
					$resource = Mage::getSingleton('core/resource');
	    			$readConnection = $resource->getConnection('core_read');
	    			$tableName = $resource->getTableName('managelicense/extension');
	    			$query = "SELECT name FROM `".$tableName."` t WHERE '".$sku."' IN (  SELECT sku FROM `".$tableName."` c WHERE t.extension_id = c.extension_id )"; 
   					$value=$readConnection->fetchOne($query);	
   					if($value)   					   						  	  
	    			return $value;
	    			else return ""; 
		}
		catch (Exception $e)
		{
			return "";
		}
	}
	
	public function getQtyProduct($ordernumber,$sku)
	{
		$order = Mage::getModel('sales/order')
	  				->getCollection()  			
	  				->addAttributeToFilter('increment_id', $ordernumber)
	  				->getFirstItem();
	  		
			$items = $order->getAllItems();
			$mod_skus = explode(',',$sku);
	
			foreach ($items as $itemId => $item)
			{			
				$item_sku = $item->getSku();
				if(in_array($item_sku, $mod_skus)) 
				return $item->getQtyOrdered();			 
			}	
			return 0;
	}
	
	public function countActiveByOrder($ordernumber,$module)
	{
		$license = Mage::getModel('managelicense/managelicense')->getCollection()	
					->addFieldToFilter('order_id',$ordernumber)
					->addFieldToFilter('extension',$module);
		return count($license);
	}
	
	
}