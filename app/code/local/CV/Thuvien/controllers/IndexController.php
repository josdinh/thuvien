<?php
class TV_Thuvien_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {			

    }
	
	 public function rendkeyAction()
    {
				$domain =  $this->getRequest()->getParam('domain');
		    	$module =  $this->getRequest()->getParam('module');
				echo md5(md5($module.'-')).'_'.md5($domain);
    }
	
}