<?php

class MW_Managelicense_Helper_Data extends Mage_Core_Helper_Abstract
{
	public function getExtensionInfo()
	{
		return Mage::getModel('managelicense/extension')->getCollection()->getData();
	}

	public function rendKey($modid,$domain)
	{
		echo md5(md5($modid.'-')).'_'.md5($domain);
	}


	public function getKey($modid,$domain)
	{
		return  md5(md5($modid.'-')).'_'.md5($domain);
	}
}