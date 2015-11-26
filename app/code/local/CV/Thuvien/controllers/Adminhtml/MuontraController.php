<?php
class  CV_Thuvien_Adminhtml_MuontraController extends Mage_Adminhtml_Controller_Action
{

	public function IndexAction()
    {
        $this->loadLayout();
        $this->_setActiveMenu('muontrasach');
        $this->renderLayout();
    }

    public function chitietdocgiaAction()
    {
        $maDocGia = $this->getRequest()->getParam('madocgia');
        $urlDetail = "0";
        if ($maDocGia) {
            $maDocGia = str_replace("617BC","00000",$maDocGia);
            $docgiaDetail = Mage::getModel('thuvien/docgia')->load($maDocGia,"MaDgTV");
            if ($docgiaDetail->getData('MaDocGia')) {
                $urlDetail = Mage::helper("adminhtml")->getUrl("thuvien/adminhtml_docgia/edit",array('id'=>$docgiaDetail->getData('MaDocGia')));
            }
        }
        echo $urlDetail;
        return;
    }

    public function traTpAjaxAction()
    {
        $maTp = $this->getRequest()->getParam('matp');
        $message =  "0";
        if ($maTp) {
            $mtModel = Mage::getModel('thuvien/dgmuontra')->getCollection()
                       ->addFieldToFilter("MaTpPop",$maTp);
            $mtModel->getSelect()->where("NgayTra IS NULL");
            $mtDetail =$mtModel->getLastItem();
            if ($mtDetail->getData('MaMuonTra')) {
                $tpCollection = Mage::getModel('thuvien/tppop')->getCollection()
                                ->addFieldTofilter('MaTpPop',$maTp);
                $tpCollection->getSelect()->join(array('tpcom'=> 'tptacphamcom'), 'tpcom.MaTpCom = main_table.MaTpCom',array('TenTacPham'));
                $tpDetail = $tpCollection->getLastItem();

                $tenTp = "";
                if ($tpDetail->getData('MaTpPop')) {
                    $tpDetail->setData('MaHienTrang',1)->save();
                    $tenTp = $tpDetail->getData('TenTacPham');
                }
                $mtDetail->setData('NgayTra',date('Y-m-d',time()))->setData('MaMuonTra',$mtDetail->getData('MaMuonTra'))->save();
                $message = Mage::helper('thuvien')->__('Bạn đã trả tác phẩm <b> %s </b> thành công. Xin cảm ơn! ',$tenTp);
            }
            echo $message;
        }
        else {
            echo $message;
        }
        return;
    }

    public function traTpThuongAction()
    {
        $masach = $this->getRequest()->getParam('matp');
    }

}



