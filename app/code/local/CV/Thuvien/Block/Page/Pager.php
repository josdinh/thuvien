<?php
class CV_Thuvien_Block_Page_Pager extends Mage_Page_Block_Html_Pager
{   
    protected function _construct()
    {
        parent::_construct();        
        $this->setLimit($this->getLimit());
        $this->setAvailableLimit(array(20=>20,30=>30,50=>50));
        $this->setTemplate('page/html/pager.phtml');
    }     
}