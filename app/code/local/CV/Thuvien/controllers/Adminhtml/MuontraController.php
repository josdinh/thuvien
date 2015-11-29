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
                $message = Mage::helper('thuvien')->__('Bạn đã trả tác phẩm %s thành công. Xin cảm ơn! ',$tenTp);
            }
            echo $message;
        }
        else {
            echo $message;
        }
        return;
    }

    public function muonTpDocGiaAction()
    {
        $data = $this->getRequest()->getParams();
        $resultArr = array();
        if ( isset($data['madocgia']) &&  intval($data['madocgia']) >0 && isset($data['matp']) && isset($data['hantra']) && strlen($data['hantra'])>=8)
        {
            $tppopDetail = Mage::getModel('thuvien/tppop')->load($data['matp']);
            if ($tppopDetail->getData('MaTpPop') && $tppopDetail->getData('MaHienTrang') == 1) {
                // them du lieu vao bang muon
                $muontra = Mage::getModel('thuvien/dgmuontra');
                $ngaymuon = date('Y-m-d 00:00:00',time());
                $hantra = date('Y-m-d 00:00:00',strtotime($data['hantra']));
                $muontra->setData('MaTpPop',$tppopDetail->getData('MaTpPop'))->setData('NgayMuon',$ngaymuon)->setData('HanTra',$hantra)
                        ->setData('MaDocGia',$data['madocgia'])
                        ->save();

                if($muontra->getData('MaMuonTra')) {
                    //update thong tin sach
                    $tppopDetail->setData('MaHienTrang',2)->save();
                    if(!Mage::registry('MaDocGia_Muon')){
                        Mage::register('MaDocGia_Muon', $data['madocgia']);
                    }
                    $resultArr['success'] = 1;
                    $resultArr['message'] = Mage::helper('thuvien')->__('Tác phẩm có mã số %s đã được mượn thành công!',$data['matp']);
                    $resultArr['content'] = $this->getLayout()->createBlock('thuvien/adminhtml_docgia_edit_tab_muon_grid')->toHtml();
                    $this->getResponse()->setBody(Mage::helper('core')->jsonEncode($resultArr));
                    return;

                }
                else {
                    $resultArr['success'] = 0;
                    $resultArr['message'] = Mage::helper('thuvien')->__("Có lỗi khi lưu thông tin tác phẩm cần mượn. Vui lòng kiểm tra lại.");

                }
            }
            else {
                $resultArr['success'] = 0;
                $resultArr['message'] = Mage::helper('thuvien')->__("Bạn không thể mượn tác phẩm có mã %s vào lúc này!",$data['matp']);
            }
        }
        else {
            $resultArr['success'] = 0;
            $resultArr['message'] = "Mượn tác phẩm không thành công. Vui lòng nhập đầy đủ thông tin tác phẩm cần mượn!";
        }
        $this->getResponse()->setBody(Mage::helper('core')->jsonEncode($resultArr));
        return;
    }

    public function traTpDocgiaAction()
    {
        $data = $this->getRequest()->getParams();
        $resultArr = array();
        $resultArr['success'] = 0;
        if ($data['matp']) {
            $mtModel = Mage::getModel('thuvien/dgmuontra')->getCollection()
                ->addFieldToFilter("MaTpPop",$data['matp']);
            $mtModel->getSelect()->where("NgayTra IS NULL");
            $mtDetail = $mtModel->getLastItem();
            if ($mtDetail->getData('MaMuonTra')) {
                $tpCollection = Mage::getModel('thuvien/tppop')->getCollection()
                    ->addFieldTofilter('MaTpPop',$data['matp']);
                $tpCollection->getSelect()->join(array('tpcom'=> 'tptacphamcom'), 'tpcom.MaTpCom = main_table.MaTpCom',array('TenTacPham'));
                $tpDetail = $tpCollection->getLastItem();

                $tenTp = "";
                if ($tpDetail->getData('MaTpPop')) {
                    $tpDetail->setData('MaHienTrang',1)->save();
                    $tenTp = $tpDetail->getData('TenTacPham');
                }

                if(!Mage::registry('MaDocGia_Tra')){
                    Mage::register('MaDocGia_Tra', $data['madocgia']);
                }

                $mtDetail->setData('NgayTra',date('Y-m-d',time()))->setData('MaMuonTra',$mtDetail->getData('MaMuonTra'))->save();
                $resultArr['success'] = 1;
                $resultArr['message'] = Mage::helper('thuvien')->__('Bạn đã trả tác phẩm %s thành công. Xin cảm ơn! ',$tenTp);
                $resultArr['content'] = $this->getLayout()->createBlock('thuvien/adminhtml_docgia_edit_tab_tra_grid')->toHtml();
                $this->getResponse()->setBody(Mage::helper('core')->jsonEncode($resultArr));
                return;
            }
            $resultArr['success'] = 0;
            $resultArr['message'] = Mage::helper('thuvien')->__('Thông tin tác phẩm trả không hợp lệ. Vui lòng kiểm tra lại.');
            $this->getResponse()->setBody(Mage::helper('core')->jsonEncode($resultArr));
            return;
        }
        else {
            $resultArr['success'] = 0;
            $resultArr['message'] = Mage::helper('thuvien')->__('Thông tin tác phẩm trả không hợp lệ. Vui lòng kiểm tra lại.');
            $this->getResponse()->setBody(Mage::helper('core')->jsonEncode($resultArr));
            return;
        }
        return;
    }

}



