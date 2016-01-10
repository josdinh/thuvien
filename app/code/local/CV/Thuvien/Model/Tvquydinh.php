<?php

class CV_Thuvien_Model_Tvquydinh extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('thuvien/tvquydinh');
    }

    public function _afterLoad()
    {
        if ($this->getData('VietTat')) {
            $tvList = Mage::getModel('thuvien/tvlist')->load($this->getData('VietTat'));
            if ($tvList->getData('TvVietTat')) {
                $this->setData('TvVietTat',$tvList->getData('TvVietTat'));
                Mage::log($this->getData(),null,'ktest.log');
            }
        }
    }

}