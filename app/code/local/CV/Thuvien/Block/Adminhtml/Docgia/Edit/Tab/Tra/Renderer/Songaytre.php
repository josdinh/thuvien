<?php
class CV_Thuvien_Block_Adminhtml_Docgia_Edit_Tab_Tra_Renderer_SongayTre extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
 public function render(Varien_Object $row) {
 		$ngaytra = date_create(date('Y-m-d', time()));
        $hantra = date_create(date('Y-m-d', strtotime($row['HanTra'])));

        $trehan = date_diff($ngaytra,$hantra);
        return $trehan->format("%R%a days");
   }
}
