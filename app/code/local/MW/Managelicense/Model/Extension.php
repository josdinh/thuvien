<?php

class MW_Managelicense_Model_Extension extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('managelicense/extension');
    }
}