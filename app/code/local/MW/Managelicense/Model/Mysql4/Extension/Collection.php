<?php

class MW_Managelicense_Model_Mysql4_Extension_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('managelicense/extension');
    }
}