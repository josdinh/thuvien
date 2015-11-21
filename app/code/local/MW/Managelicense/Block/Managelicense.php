<?php
class MW_Managelicense_Block_Managelicense extends Mage_Core_Block_Template
{
	public function _prepareLayout()
    {
		return parent::_prepareLayout();
    }
    
     public function getManagelicense()     
     { 
        if (!$this->hasData('managelicense')) {
            $this->setData('managelicense', Mage::registry('managelicense'));
        }
        return $this->getData('managelicense');
        
    }
}