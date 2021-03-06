<?php

class CV_Thuvien_Block_Adminhtml_Docgia_Edit_Tab_Lephi extends Mage_Adminhtml_Block_Widget_Grid
{

    public function __construct()
    {
        parent::__construct();
        $this->setId('docgiaGrid');
        $this->setDefaultSort('MaDocGia');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('thuvien/lephi')->getCollection();
        $currentId = $this->getRequest()->getParam("id");
        $collection->addFieldToFilter("MaDocGia",$currentId);
        $collection->getSelect()->join( array('lydotra'=> 'dglydotratien'), 'lydotra.MaLyDo = main_table.MaLyDo', array('lydotra.LyDo'));
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {

        $this->addColumn('NgayNhap', array(
            'header'    => Mage::helper('thuvien')->__('Ngày nhập'),
            'align'     =>'left',
            'width'     => '50px',
            'index'     => 'NgayNhap',
        ));

        $this->addColumn('LyDo', array(
            'header'    => Mage::helper('thuvien')->__('Lý do'),
            'align'     =>'left',
            'width'     => '50px',
            'index'     => 'LyDo',
            'index'     => 'LyDo',
        ));

        $this->addColumn('SoTien', array(
            'header'    => Mage::helper('thuvien')->__('Số tiền'),
            'align'     =>'right',
            'width'     => '50px',
            'index'     => 'SoTien',
        ));

        $this->addColumn('HetHan', array(
            'header'    => Mage::helper('thuvien')->__('Kỳ hạn'),
            'align'     =>'left',
            'width'     => '50px',
            'index'     => 'HetHan',
        ));

        $this->addColumn('MaGhiChu', array(
            'header'    => Mage::helper('thuvien')->__('Mã ghi chú'),
            'align'     =>'right',
            'width'     => '50px',
            'index'     => 'MaGhiChu',
        ));

        $this->addColumn('MaTaichanh', array(
            'header'    => Mage::helper('thuvien')->__('Xóa'),
            'align'     =>'center',
            'index'     => 'MaTaichanh',
            'width' =>"10%",
            'renderer' => 'thuvien/adminhtml_docgia_edit_tab_lephi_renderer_delete',
        ));

        return parent::_prepareColumns();
    }


    public function getRowUrl($row)
    {
        return $this->getUrl('/edit', array('id' => $row->getId()));
    }

}