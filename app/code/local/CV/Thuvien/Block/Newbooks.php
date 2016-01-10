<?php
class CV_Thuvien_Block_Newbooks extends Mage_Core_Block_Template
{
    public function getListNewBooks()
    {
        $tpcomIds = Mage::getModel('thuvien/tppop')->getCollection()
                        ->addFieldToSelect('MaTPCom')
                        ->setPageSize(36)
                        ->setCurPage(36)
                        ->setOrder('NgayNhap','DESC');
        $tpcomIds->getSelect()->group('MaTPCom');

        $tpcomIdsArr = $tpcomIds->getData();

        $tpcomIdsValArr = array_values($tpcomIdsArr);

        $tpcomCollection = Mage::getModel('thuvien/tpcom')->getCollection()
                            ->addFieldToFilter('MaTPCom',array('in'=>$tpcomIdsValArr));
        return $tpcomCollection;


    }

    public function getImages($url)
    {
       /* if(!isset($url) || $url=="")
        {*/
            return $this->getSkinUrl('images/demobooks/10022.jpg');
       /* }*/
    }
}