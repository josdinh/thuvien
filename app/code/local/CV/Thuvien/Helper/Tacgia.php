<?php

class CV_Thuvien_Helper_Tacgia extends Mage_Core_Helper_Abstract
{
	
	public function getListTgKhac($matpcom)
    {
        $arrTgKhac = array();
        $tg = Mage::getModel('thuvien/tacgia')->getCollection();
        $tg->getSelect()
            ->join(array("tg"=>"tptacgia"),"tg.MaListTG = main_table.MaListTG",array())
            ->where('tg.MaTpCom = '.$matpcom);
        if ($tg->getSize()) {
            foreach ($tg as $row) {
                $arrTgKhac[] = $row->getData('MaListTG');
            }
        }
        Mage::log($arrTgKhac);
        return  $arrTgKhac;
    }



}