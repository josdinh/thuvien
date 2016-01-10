<?php

class CV_Thuvien_Model_Tacphampop extends Mage_Core_Model_Abstract
{
    const TACPHAM_HIENCO = 1;
    const TACPHAM_DANGMUON = 2;
    const TACPHAM_THAMKHAO = 3;
    const TACPHAM_GIUTRUOC = 4;
    const TACPHAM_DATRA = 5;
    const TACPHAM_CHONHAN = 5;

    public function _construct()
    {
        parent::_construct();
        $this->_init('thuvien/tacphampop');
    }

}