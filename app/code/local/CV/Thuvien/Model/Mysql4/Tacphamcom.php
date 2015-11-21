<?php

class TV_Thuvien_Model_Mysql4_Tacphamcom extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {
        // Note that the managelicense_id refers to the key field in your database table.
        $this->_init('managelicense/tacphamcom', 'MaTpCom');
    }
}