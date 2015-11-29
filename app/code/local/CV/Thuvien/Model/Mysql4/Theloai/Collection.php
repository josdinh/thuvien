<?php

class CV_Thuvien_Model_Mysql4_Theloai_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('thuvien/theloai');
    }
}