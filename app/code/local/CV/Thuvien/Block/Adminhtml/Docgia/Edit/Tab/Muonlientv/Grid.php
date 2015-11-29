<?php

class CV_Thuvien_Block_Adminhtml_Docgia_Edit_Tab_Muonlientv_Grid extends Mage_Adminhtml_Block_Widget_Grid
{

  /*  public function __construct()
    {
        parent::__construct();
        $this->setId('muontpGrid');
        $this->setDefaultSort('MaTpPop');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('thuvien/dgmuontra')->getCollection();
        $currentId = 0;
        if (Mage::registry('docgia_data')) {
            $currentId = Mage::registry('docgia_data')->getData('MaDocGia');
        }
        else if(Mage::registry('MaDocGia_Muon')){
            $currentId = Mage::registry('MaDocGia_Muon');
        }

        $collection->addFieldToFilter("MaDocGia",$currentId);
        $collection->getSelect()->join( array('tppop'=> 'tptacphampop'), 'tppop.MaTpPop = main_table.MaTpPop', array())
                                ->join( array('tpcom'=> 'tptacphamcom'), 'tpcom.MaTpCom = tppop.MaTpCom', array('tpcom.TenTacPham','MaTpCom'))
                                ->where('main_table.NgayTra IS NULL ');
        $collection->addFilterToMap('MaTpPop', 'main_table.MaTpPop');
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {

        $this->addColumn('MMaTpPop', array(
            'header'    => Mage::helper('thuvien')->__('Mã tác phẩm'),
            'align'     =>'left',
            'width'     => '50px',
            'index'     => 'MaTpPop',

        ));

        $this->addColumn('MTenTacPham', array(
            'header'    => Mage::helper('thuvien')->__('Nhan đề'),
            'align'     =>'left',
            'width'     => '50px',
            'index'     => 'TenTacPham',
        ));

        $this->addColumn('MNgayMuon', array(
            'header'    => Mage::helper('thuvien')->__('Ngày Mượn'),
            'align'     =>'right',
            'width'     => '50px',
            'index'     => 'NgayMuon',
        ));

        $this->addColumn('NgayTra', array(
            'header'    => Mage::helper('thuvien')->__('Ngày Trả'),
            'align'     =>'right',
            'width'     => '50px',
            'index'     => 'NgayTra',
        ));

        $this->addColumn('HanTra', array(
            'header'    => Mage::helper('thuvien')->__('Kỳ hạn'),
            'align'     =>'left',
            'width'     => '50px',
            'index'     => 'HanTra',
        ));

       $this->addColumn('SoNgayTre', array(
            'header'    => Mage::helper('thuvien')->__('Số ngày trễ'),
            'align'     =>'right',
            'width'     => '50px',
            'index'     => 'SoNgayTre',
        ));

    /*
        $this->addColumn('MaTaichanh', array(
            'header'    => Mage::helper('thuvien')->__('Trả sách'),
            'align'     =>'center',
            'index'     => 'MaTaichanh',
            'width' =>"10%",
            'renderer' => 'thuvien/adminhtml_docgia_edit_tab_muon_renderer_tra',
        ));*

        return parent::_prepareColumns();
    }

    private function expiredDates() {
        return "d-M-yyyy";//Mage::app()->getLocale()->getDateTimeFormat(Mage_Core_Model_Locale::FORMAT_TYPE_SHORT);
    }*/
}