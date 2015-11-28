<?php

class CV_Thuvien_Model_Theloai extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('thuvien/theloai');
    }

}