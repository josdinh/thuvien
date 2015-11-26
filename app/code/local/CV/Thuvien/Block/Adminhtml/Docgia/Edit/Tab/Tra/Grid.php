<?php

class CV_Thuvien_Block_Adminhtml_Docgia_Edit_Tab_Tra_Grid extends Mage_Adminhtml_Block_Widget_Grid
{

    public function __construct()
    {
        parent::__construct();
        $this->setId('tratpGrid');
        $this->setDefaultSort('NgayMuon,NgayTra');
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
        else if(Mage::registry('MaDocGia_Lephi')){
            $currentId = Mage::registry('MaDocGia_Lephi');
        }

        $collection->addFieldToFilter("MaDocGia",$currentId);
        $collection->getSelect()->join( array('tppop'=> 'tptacphampop'), 'tppop.MaTpPop = main_table.MaTpPop', array())
                                ->join( array('tpcom'=> 'tptacphamcom'), 'tpcom.MaTpCom = tppop.MaTpCom', array('tpcom.TenTacPham','MaTpCom'))
                                ->join( array('hientrang'=> 'tphientrang'), 'tppop.MaHienTrang = hientrang.MaHienTrang', array())
                                ->where('NgayTra IS NOT NULL ');

        $collection->addFilterToMap('MaTpPop', 'main_table.MaTpPop');
        $collection->setOrder("NgayMuon","DESC");

        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {

        $this->addColumn('TMaTpPop', array(
            'header'    => Mage::helper('thuvien')->__('Mã tác phẩm'),
            'align'     =>'left',
            'width'     => '50px',
            'index'     => 'MaTpPop',

        ));

        $this->addColumn('TTenTacPham', array(
            'header'    => Mage::helper('thuvien')->__('Nhan đề'),
            'align'     =>'left',
            'width'     => '50px',
            'index'     => 'TenTacPham',
        ));

        $this->addColumn('TNgayMuon', array(
            'header'    => Mage::helper('thuvien')->__('Ngày Mượn'),
            'align'     =>'right',
            'width'     => '50px',
            'index'     => 'NgayMuon',
        ));

        $this->addColumn('TNgayTra', array(
            'header'    => Mage::helper('thuvien')->__('Ngày Trả'),
            'align'     =>'right',
            'width'     => '50px',
            'index'     => 'NgayTra',
        ));

        $this->addColumn('THanTra', array(
            'header'    => Mage::helper('thuvien')->__('Kỳ hạn'),
            'align'     =>'left',
            'width'     => '50px',
            'index'     => 'HanTra',
        ));

       $this->addColumn('TSoNgayTre', array(
            'header'    => Mage::helper('thuvien')->__('Số ngày trễ'),
            'align'     =>'right',
            'width'     => '50px',
            'index'     => 'SoNgayTre',
        ));


        return parent::_prepareColumns();
    }

    private function expiredDates() {
        return "d-M-yyyy";//Mage::app()->getLocale()->getDateTimeFormat(Mage_Core_Model_Locale::FORMAT_TYPE_SHORT);
    }
}