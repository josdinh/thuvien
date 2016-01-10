<?php
class CV_Thuvien_Catalog_ProductController extends Mage_Core_Controller_Front_Action
{
    public function viewAction()
    {
        $productId = $this->getRequest()->getParam('id');
        if($productId>0){
            $product = Mage::getModel('thuvien/tpcom')->load($productId,'MaTpCom');
            Mage::register('current_product_com', $product);
            $productPop = $product->getTpComStatus();
            if(count($productPop)){
                $tpPopId = 0;
                foreach ($productPop as $key=>$value) {
                    $tpPopId = $value;
                    break;
                }
                $productDetail = Mage::getModel('thuvien/tppop')->load($tpPopId);
                Mage::register('current_product_pop', $productDetail);
                $this->loadLayout()->renderLayout();
            }
            else {
                Mage::getModel('core/session')->addNotice('Hiện tại tác phẩm này đang được mượn. Quý khách vui lòng chọn tác phẩm khác.');
                $this->_redirect('*/*/');
            }
        }
        else {
            $this->_redirect($this->getBaseUrl());
        }
        return;
    }

    public function muonsachAction()
    {
        $isLoggedIn = Mage::getSingleton('customer/session')->isLoggedIn();
        if (!$isLoggedIn){
            Mage::getSingleton('core/session')->addNotice('Bạn phải đăng nhập vào tài khoản của bạn trước khi mượn sách.');
            $this->_redirect('customer/account/login');
        }
        else {

        }
        return;

    }
}