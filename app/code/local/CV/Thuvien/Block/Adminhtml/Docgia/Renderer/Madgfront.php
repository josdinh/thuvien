<?php
class CV_Thuvien_Block_Adminhtml_Docgia_Renderer_Madgfront extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    public function render(Varien_Object $row) {

        $madg = $row->getData('MaDgTv');
        return Mage::helper('thuvien')->getMaDgTvShow($madg);
    }
}
