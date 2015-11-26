<?php
class CV_Thuvien_IndexController extends Mage_Core_Controller_Front_Action
{
  public function testAction()
  {
      $maDocGia = "0000000451"; //$this->getRequest()->getParam('madocgia');
      $urlDetail = "0";
      if ($maDocGia) {
          $maDocGia = str_replace("617BC","00000",$maDocGia);
          $docgiaDetail = Mage::getModel('thuvien/docgia')->load($maDocGia,"MaDgTV");
         zend_debug::dump($docgiaDetail,null,"gdtv.log");

          if ($docgiaDetail->getData('MaDocGia')) {
              $urlDetail = Mage::helper("adminhtml")->getUrl("thuvien/adminhtml_docgia/edit",array('id'=>$docgiaDetail->getData('MaDocGia')));
          }
      }
      echo $urlDetail;
  }

  public function traTpAjaxAction()
  {

  }

  public function tacphamInfoAction()
  {
      $tp = Mage::getModel('thuvien/tppop')->load('617BC0005601');
      zend_debug::dump($tp->getData());
  }
}