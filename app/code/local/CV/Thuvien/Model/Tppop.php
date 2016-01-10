<?php

class CV_Thuvien_Model_Tppop extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('thuvien/tppop');
    }


    public function _afterLoad()
    {
        if($this->getData('MaTpPop'))
        {
            if ($this->getData('MaTpCom')) {
                $maTpCom = $this->getData('MaTpCom');
                $tpCom = Mage::getModel('thuvien/tpcom')->load($maTpCom);
                $this->setData('TenTacPham', $tpCom->getData('TenTacPham'));
                $this->setData('NguyenTac', $tpCom->getData('NguyenTac'));
                $this->setData('PhuThem', $tpCom->getData('PhuThem'));
                $this->setData('MaLoaiTacPham', $tpCom->getData('MaLoaiTacPham'));
                $this->setData('MaNgonNgu', $tpCom->getData('MaNgonNgu'));
                $this->setData('MaDDC', $tpCom->getData('MaDDC'));
                $this->setData('ISBN', $tpCom->getData('ISBN'));
                $this->setData('TapSo', $tpCom->getData('TapSo'));
                $this->setData('MaSachBo', $tpCom->getData('MaSachBo'));
                $this->setData('TomLuoc', $tpCom->getData('TomLuoc'));
                $this->setData('MaKyHieuTg', $tpCom->getData('MaKyHieuTg'));
            }
           // $this->setData('DichGia',$this->getDichGia());
            $this->setData('MucLuc',$this->getMucLuc());
            $this->setData('TpMoi','0');
        }
        else {
            $newMaTpPopShow = Mage::helper('thuvien')->getNewMaTpPopShow();
            $newMaTp = Mage::helper('thuvien')->getMaTpPopShow($newMaTpPopShow);
            $this->setData('MaTpPop',$newMaTp);
            $this->setData('TpMoi','1');
        }

    }

    public function getDichGia()
    {
        $arrDichGia = array();
        if ($this->getData('MaTpPop')) {
           $maTpCom = $this->getData('MaTpCom');
            $dichGia = Mage::getModel('thuvien/dichgia')->getCollection();
            $dichGia->getSelect()
                    ->join(array('dichgia'=>'tpdichgia'),'dichgia.MaListDG = main_table.MaListDG',array())
                    ->where('dichgia.MaTpCom ='.$maTpCom);
            if ($dichGia->getSize()) {
                foreach($dichGia as $key=>$value) {
                    $arrDichGia[] = $value['MaListDG'];
                }
            }
        }
        return $arrDichGia;
    }

    public function getTacGiaKhac()
    {
        $arrTacGiaKhac = array();
        if ($this->getData('MaTpPop')) {
            $maTpCom = $this->getData('MaTpCom');
            $tacgia = Mage::getModel('thuvien/tacgia')->getCollection();
            $tacgia->getSelect()
                ->join(array('tacgia'=>'tptacgia'),'tacgia.MaListTG = main_table.MaListTG',array())
                ->where('tacgia.MaTpCom ='.$maTpCom)
                ->order('TenTacGia');
            if ($tacgia->getSize()) {
                foreach($tacgia as $key=>$value) {
                    $arrTacGiaKhac[] = $value['MaListTG'];
                }
            }
        }
        return $arrTacGiaKhac;
    }

    public function  getMucLuc()
    {
        $mucluc = $this->getData('MucLuc');
        if ($this->getData('MaTpPop')) {
            $mucluc = '<table>';
            if ($this->getData('MucLuc')=='') {
                $maTpCom = $this->getData('MaTpCom');
                $muclucCols = Mage::getModel('thuvien/mucluc')->getCollection()
                            ->addFieldToFilter('MaTpCom', $maTpCom);

                foreach($muclucCols as $row) {
                    $mucluc .= '<tr><td align="left">'.$row['MucLuc'].'</td><td align="right">'.$row['Trang'].'</td></tr>';
                }
            }
            $mucluc .= '</table>';

        }
        return $mucluc;
    }



}