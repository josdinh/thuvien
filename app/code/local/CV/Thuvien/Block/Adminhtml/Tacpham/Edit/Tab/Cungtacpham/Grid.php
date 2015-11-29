<?php

class CV_Thuvien_Block_Adminhtml_Tacpham_Edit_Tab_Cungtacpham_Grid extends Mage_Adminhtml_Block_Widget_Grid
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
		if(Mage::registry('tacphamcom_data')->getData('MaTpCom')){
			$collection = Mage::getModel('thuvien/tacphampop')->getCollection();
			$collection->getSelect()->join( array('tpcom'=> 'tptacphamcom'), 'tpcom.MaTpCom = main_table.MaTpCom', array('tpcom.TenTacPham','MaTpCom'))
						->join( array('tpnhaxb'=> 'tpnhaxb'), 'tpnhaxb.MaNhaXB = main_table.MaNhaXB', array('tpnhaxb.NhaXB'))
						->where('main_table.MaTpCom = "'.Mage::registry('tacphamcom_data')->getData('MaTpCom').'"')
			;
			$this->setCollection($collection);			
			return parent::_prepareCollection();
		}
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