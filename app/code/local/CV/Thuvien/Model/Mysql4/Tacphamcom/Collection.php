<?php

class TV_Thuvien_Model_Mysql4_Tacphamcom_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('thuvien/tacphamcom');
    }
}