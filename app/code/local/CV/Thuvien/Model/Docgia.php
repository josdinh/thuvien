<?php
class CV_Thuvien_Model_Docgia extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('thuvien/docgia');
    }

    public function _afterLoad()
    {
        if($this->getData('MaDgTv')) {
            $madgtv = $this->getData('MaDgTv');
            $madgtvshow = Mage::helper('thuvien')->getMaDgTvShow($madgtv);
            $this->setData('MaDgTvShow', $madgtvshow);
        }
        else {
            $newMadgtv = Mage::helper('thuvien')->getNewMaDgTv();
            $this->setData('MaDgTv', $newMadgtv);
            $this->setData('MaDgTvShow',Mage::helper('thuvien')->getMaDgTvShow($newMadgtv));
        }
    }
}