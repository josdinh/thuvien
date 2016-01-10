<?php

class CV_Thuvien_Model_Tpcom extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('thuvien/tpcom');
    }

    public function getListTacGia()
    {
        $tpId = $this->getData('MaTpCom');
        $listTg = Mage::getModel('thuvien/tacgia')->getCollection();
        $listTg->getSelect()
                  ->join(array('tgTemp'=>'tptacgia'),'tgTemp.MaListTG = main_table.MaListTG',array('tgTemp.MaListTG','main_table.TenTacGia'))
                  ->where('MaTpCom = '.$tpId);

        return $listTg->getData();
    }

    public function getTacGiaByKyHieu()
    {
        $kyHieuTg = $this->getData('MaKyHieuTg');
        if($kyHieuTg) {
            $listTg = Mage::getModel('thuvien/tacgia')->getCollection()->addFieldToFilter('MaListTG',$kyHieuTg);
            return $listTg->getData();
        }
        return null;
    }

    public function _afterLoad()
    {
        if($this->getData('MaTpCom'))
        {
            if ($this->getData('MucLuc') == '' || is_null($this->getData('MucLuc'))) {
                $this->setData('MucLuc', $this->getMucLuc());
            }
        }

    }

    public function  getMucLuc()
    {
        $mucluc = $this->getData('MucLuc');
        if ($this->getData('MaTpCom')) {
            $mucluc = '<table>';
            if ($this->getData('MucLuc')=='') {
                $maTpCom = $this->getData('MaTpCom');
                $muclucCols = Mage::getModel('thuvien/mucluc')->getCollection()->setOrder('MaMucLuc','ASC')
                              ->addFieldToFilter('MaTpCom', $maTpCom);

                if ($muclucCols->getSize()) {
                    $i = 0;
                    foreach ($muclucCols as $row) {

                        if ($row->getData('MucLuc') != '' && $row->getData('Trang') != '') {
                             $i++;
                            if($i>100){
                                break;
                            }
                             $mucluc .= '<tr><td align="left">' . $row->getData('MucLuc') . '</td><td align="right">' . $row->getData('Trang') . '</td></tr>';
                        }
                    }
                }
            }
            $mucluc .= '</table>';
        }
        return $mucluc;
    }

    // for showing in frontend
    public function getTacGia()
    {
        $tacgiaChinh = $this->getData('MaKyHieuTg');
        $arrTacGiaKhac = array();
        $maTpCom = $this->getData('MaTpCom');
        $tacgia = Mage::getModel('thuvien/tacgia')->getCollection();
        $tacgia->getSelect()
            ->joinLeft(array('tacgia'=>'tptacgia'),'tacgia.MaListTG = main_table.MaListTG',array())
            ->where('tacgia.MaTpCom ='.$maTpCom.' or main_table.MaListTG='.$tacgiaChinh)
            ->order('TenTacGia');

        if ($tacgia->getSize()) {
            foreach($tacgia as $key=>$value) {
                $arrTacGiaKhac[] = $value['TenTacGia'];
            }
        }
        return implode(", ",$arrTacGiaKhac);
    }

    public function getDichGia()
    {
        $arrDichGia = array();
        $maTpCom = $this->getData('MaTpCom');
        $dichgia = Mage::getModel('thuvien/dichgia')->getCollection();
        $dichgia->getSelect()
            ->joinLeft(array('dg'=>'tpdichgia'),'dg.MaListDG = main_table.MaListDG',array())
            ->where('dg.MaTpCom ='.$maTpCom)
            ->order('TenDichGia');

        if ($dichgia->getSize()) {
            foreach($dichgia as $key=>$value) {
                $arrDichGia[] = $value['TenDichGia'];
            }
        }
        return implode(", ",$arrDichGia);
    }

    public function listTpPopStatus()
    {
        $tpList = Mage::getModel('thuvien/tppop')->getCollection()
            ->addFieldToSelect('*')
            ->addFieldToFilter('MaTpCom',$this->getData('MaTpCom'));

        $resultArr = array();
        if ($tpList->getSize()) {
            foreach ($tpList as $row) {
                $resultArr[$row->getData('MaHienTrang')] = $row->getData('MaTpPop');
            }
        }
        return $resultArr;
    }

    public function getTpComStatus()
    {
        $statusArr = $this->listTpPopStatus();
        if (count($statusArr)) {
            if (isset($statusArr[1])) {
                return array(1=>$statusArr[1]);
            }
            else if (isset($statusArr[2])) {
                return array(2=>$statusArr[2]);
            }
        }
        return array();
    }

    public function getTpPopData()
    {
        $tpFirstItem = Mage::getModel('thuvien/tppop')->getCollection()
            ->addFieldToFilter('MaTpCom',$this->getData('MaTpCom'))
            ->getFirstItem();

        return $tpFirstItem;
    }
    public function getNhaXB()
    {
        $tpFirstItem = Mage::getModel('thuvien/tppop')->getCollection()
                    ->addFieldToFilter('MaTpCom',$this->getData('MaTpCom'))
                    ->getFirstItem();

        if ($tpFirstItem->getData('MaNhaXB')) {
           $nhaXb = Mage::getModel('thuvien/nhaxb')->load($tpFirstItem->getData('MaNhaXB'));
            if($nhaXb->getData('NhaXB')) {
                return $nhaXb->getData('NhaXB');
            }
        }
        return "";
    }

    public function getNgonNgu()
    {
        if($this->getData('MaNgonNgu')) {
            $ngonngu = Mage::getModel('thuvien/ngonngu')->load($this->getData('MaNgonNgu'));
            if ($ngonngu->getData('NgonNgu')) {
                return $ngonngu->getData('NgonNgu');
            }
        }
        return "";
    }
}