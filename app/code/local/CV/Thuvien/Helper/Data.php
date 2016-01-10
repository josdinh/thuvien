<?php
include "Barcode39.php";
class CV_Thuvien_Helper_Data extends Mage_Core_Helper_Abstract
{
	const TP_HIENCO_LABEL = 'Hiện có';
    const TP_DANGMUON_LABEL = 'Đang mượn';
    const TP_THAMKHAO_LABEL = 'Tham khảo';
    const TP_GIUTRUOC_LABEL = 'Giữ trước';
    const TP_TVDATRA_LABEL = 'Tv. đã trả';
    const TP_TVCHONHAT_LABEL = 'rv. chờ nhận';

    const TP_HIENCO = 1;
    const TP_DANGMUON = 2;
    const TP_THAMKHAO = 3;
    const TP_GIUTRUOC = 4;
    const TP_TVDATRA = 5;
    const TP_TVCHONHAT = 6;

    /*Get the data value for select box */
	public function getDSTheLoai(){		
      $collection = Mage::getModel('thuvien/theloai')->getCollection();	  
      $theloai = array();
      if($collection->getSize()) {
          foreach($collection as $key=>$value) {
              $theloai[$value['MaTheLoai']] = $value['TheLoai'];
          }
      }
	  return $theloai;
	}

	public function getDSNgonngu(){		
      $collection = Mage::getModel('thuvien/ngonngu')->getCollection();	  
      $ngonngu = array();
      if($collection->getSize()) {
          foreach($collection as $key=>$value) {
              $ngonngu[$value['MaNgonNgu']] = $value['NgonNgu'];
          }
      }
	  return $ngonngu;
	}

	public function getDSSachbo(){		
      $collection = Mage::getModel('thuvien/sachbo')->getCollection()->setOrder('SachBo','ASC');
      $sachbo = array('0'=>'Chọn Sách bộ');
      if($collection->getSize()) {
          foreach($collection as $key=>$value) {
              $sachbo[$value['MaSachBo']] = $value['SachBo'];
          }
      }
	  return $sachbo;
	}
    public function getDsDDC(){
        $collection = Mage::getModel('thuvien/ddc')->getCollection()
                     ->setOrder('DDC','ASC');
        $sachbo = array('0'=>'Chọn DDC');
        if($collection->getSize()) {
            foreach($collection as $key=>$value) {
                $sachbo[$value['MaDDC']] = $value['DDC']."  ---  ".$value['TenDDC'];
            }
        }
        return $sachbo;
    }
	
	public function getDSHientrang(){		
      $collection = Mage::getModel('thuvien/hientrang')->getCollection();	  
      $hientrang = array();
      if($collection->getSize()) {
          foreach($collection as $key=>$value) {
              $hientrang[$value['MaHienTrang']] = $value['HienTrang'];
          }
      }
	  return $hientrang;
	}

    public function getDSTacGia(){
        $collection = Mage::getModel('thuvien/tacgia')->getCollection();
        $tacgia = array('0'=>'Chọn tác giả');
        if($collection->getSize()) {
            foreach($collection as $key=>$value) {
                $tacgia[$value['MaListTG']] = $value['TenTacGia'];
            }
        }
        return $tacgia;
    }

    public function getMaDgTvShow($madg)
    {
        $madgtemp = $madg+1000000;
        return "617BC".substr($madgtemp,1,6);
    }

    public function getNewMaDgTv()
    {
        $docgia = Mage::getModel('thuvien/docgia')->getCollection()->setOrder('MaDgTv','DESC');
        $docgia->getSelect()->order('MaDgTv DESC ');
        $maxDg = $docgia->getFirstItem();
        if ($maxDg->getData('MaDgTv')) {
            return  $maxDg->getData('MaDgTv') + 1;
        }
        return 1;
    }

    public function getMaTpPopShow($matp)
    {
        $madgtemp = $matp+10000000;
        return "617BC".substr($madgtemp,1,7);
    }

    public function getNewMaTpPopShow()
    {
        $tpPop = Mage::getModel('thuvien/tppop')->getCollection()->setOrder('MaTpPop','DESC');
        $maxTp = $tpPop->getFirstItem();
        if ($maxTp->getData('MaTpPop')) {
            $maxMa = str_replace("617BC","",$maxTp->getData('MaTpPop'));
            return  intval($maxMa) + 1;
        }
        return 1;
    }

    public function getListHienTrang()
    {
        $arrHienTrang = array(''=>'Chọn hiện trạng');
        $hientrang = Mage::getModel('thuvien/hientrang')->getCollection()->setOrder('HienTrang','ASC');
        if($hientrang->getSize())
        {
            foreach($hientrang as $row)
            {
                $arrHienTrang[$row->getData('MaHienTrang')]=$row->getData('HienTrang');
            }
        }
        return $arrHienTrang;
    }

    public function getListTinhTrang()
    {
        $arrTinhTrang = array(''=>'Chọn tình trạng');
        $tinhtrang = Mage::getModel('thuvien/tinhtrang')->getCollection()->setOrder('TinhTrang','ASC');
        if($tinhtrang->getSize())
        {
            foreach($tinhtrang as $row)
            {
                $arrTinhTrang[$row->getData('MaTinhTrang')]=$row->getData('TinhTrang');
            }
        }
        return $arrTinhTrang;
    }

    public function getListKhoSach()
    {
        $arrKhoSach = array(''=>'Chọn kho sách');
        $khosach = Mage::getModel('thuvien/khosach')->getCollection()->setOrder('KhoSach','ASC');
        if($khosach->getSize())
        {
            foreach($khosach as $row)
            {
                $arrKhoSach[$row->getData('MaKhoSach')]=$row->getData('KhoSach');
            }
        }
        return $arrKhoSach;
    }

    public function getListNhaXB()
    {
        $arrNhaXB = array(''=>'Chọn Nhà XB');
        $nhaXB = Mage::getModel('thuvien/nhaxb')->getCollection()->setOrder('NhaXB','ASC');
        if($nhaXB->getSize())
        {
            foreach($nhaXB as $row)
            {
                $arrNhaXB[$row->getData('MaNhaXB')]=$row->getData('NhaXB');
            }
        }
        return $arrNhaXB;
    }

    public function getListTp()
    {
        $arrThanhPho = array(''=>'Chọn Thành Phố');
        $thanhpho = Mage::getModel('thuvien/thanhpho')->getCollection()->setOrder('TenTp','ASC');
        if($thanhpho->getSize())
        {
            foreach($thanhpho as $row)
            {
                $arrThanhPho[$row->getData('ThanhPho')]=$row->getData('TenTp');
            }
        }
        return $arrThanhPho;
    }

    public function quydinh()
    {
        return Mage::getModel('thuvien/tvquydinh')->getCollection()->getFirstItem();
    }

    public function hanDinhMuon()
    {
        $quyDinh = $this->quydinh();
        if($quyDinh->getData('HanDinhMuon')){
            return $quyDinh->getData('HanDinhMuon');
        }
        return 0;
    }


}