<?php
class CV_Thuvien_Catalog_CategoryController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
        echo "done";
    }

    public function viewAction()
    {
        $categoryId = $this->getRequest()->getParam('id');
        if($categoryId>0){
            $category = Mage::getModel('thuvien/sachbo')->load($categoryId);
            Mage::register('current_category', $category);
            $this->loadLayout()->renderLayout();
        }
        else {
            $this->_redirect($this->getBaseUrl());
        }
        return;
    }



}