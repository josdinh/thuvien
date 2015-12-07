<?php
class CV_Thuvien_Block_Page_Pager extends Mage_Page_Block_Html_Pager
{   
    protected function _construct()
    {
        parent::_construct();        
        $this->setLimit(10);
        $this->setAvailableLimit(null);
        $this->setTemplate('page/html/pager.phtml');
    }     
}