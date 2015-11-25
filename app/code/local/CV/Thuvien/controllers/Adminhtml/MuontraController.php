<?php
class  CV_Thuvien_Adminhtml_MuonTraController extends Mage_Adminhtml_Controller_Action
{

	public function IndexAction()
    {
        $this->loadLayout();
        $this->_setActiveMenu('muontrasach');
        $this->renderLayout();
    }

}



