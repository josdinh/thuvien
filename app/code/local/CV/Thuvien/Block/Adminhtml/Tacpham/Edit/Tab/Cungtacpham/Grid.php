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
						->join( array('tphientrang'=> 'tphientrang'), 'tphientrang.MaHienTrang = main_table.MaHienTrang', array('tphientrang.HienTrang'))
						->join( array('tptinhtrang'=> 'tptinhtrang'), 'tptinhtrang.MaTinhTrang = main_table.MaTinhTrang', array('tptinhtrang.TinhTrang'))
						->join( array('tplistkhosach'=> 'tplistkhosach'), 'tplistkhosach.MaKhoSach = main_table.MaKhoSach', array('tplistkhosach.KhoSach'))
						->where('main_table.MaTpCom = "'.Mage::registry('tacphamcom_data')->getData('MaTpCom').'"')
			;
			/* Zend_debug::dump($collection->getData()); */
			$this->setCollection($collection);			
			return parent::_prepareCollection();
		}
    }

    protected function _prepareColumns()
    {
		$this->addColumn('TMaTpPop', array(
            'header'    => Mage::helper('thuvien')->__('ID'),
            'align'     =>'left',
            'width'     => '50px',
            'index'     => 'MaTpPop',

        ));
        $this->addColumn('TMaTpPop', array(
            'header'    => Mage::helper('thuvien')->__('Mã tác phẩm'),
            'align'     =>'left',
            'width'     => '50px',
            'index'     => 'MaTpPop',

        ));

        $this->addColumn('BanSo', array(
            'header'    => Mage::helper('thuvien')->__('Bản'),
            'align'     =>'left',
            'width'     => '50px',
            'index'     => 'BanSo',
        ));

        $this->addColumn('NhaXB', array(
            'header'    => Mage::helper('thuvien')->__('Nhà Xuất Bản'),
            'align'     =>'right',
            'width'     => '50px',
            'index'     => 'NhaXB',
        ));

        $this->addColumn('NamXuatBan', array(
            'header'    => Mage::helper('thuvien')->__('Năm'),
            'align'     =>'right',
            'width'     => '50px',
            'index'     => 'NamXuatBan',
        ));
		
        $this->addColumn('SoTrang', array(
            'header'    => Mage::helper('thuvien')->__('Trang'),
            'align'     =>'left',
            'width'     => '50px',
            'index'     => 'SoTrang',
        ));

       $this->addColumn('Kho', array(
            'header'    => Mage::helper('thuvien')->__('Khổ'),
            'align'     =>'right',
            'width'     => '50px',
            'index'     => 'Kho',
        ));
		
		 $this->addColumn('NgayNhap', array(
            'header'    => Mage::helper('thuvien')->__('Ngày Nhập'),
            'align'     =>'right',
            'width'     => '50px',
            'index'     => 'NgayNhap',
        ));
		
		 $this->addColumn('GiaTien', array(
            'header'    => Mage::helper('thuvien')->__('Giá Tiền'),
            'align'     =>'right',
            'width'     => '50px',
            'index'     => 'GiaTien',
        ));
		
		 $this->addColumn('TinhTrang', array(
            'header'    => Mage::helper('thuvien')->__('Tình Trạng'),
            'align'     =>'right',
            'width'     => '50px',
            'index'     => 'TinhTrang',
        ));
		
		 $this->addColumn('HienTrang', array(
            'header'    => Mage::helper('thuvien')->__('Tác Phẩm'),
            'align'     =>'right',
            'width'     => '50px',
            'index'     => 'HienTrang',			
        ));

		 $this->addColumn('KhoSach', array(
            'header'    => Mage::helper('thuvien')->__('Kho'),
            'align'     =>'right',
            'width'     => '50px',
            'index'     => 'KhoSach',
        ));

		
        return parent::_prepareColumns();
    }

    private function expiredDates() {
        return "d-M-yyyy";//Mage::app()->getLocale()->getDateTimeFormat(Mage_Core_Model_Locale::FORMAT_TYPE_SHORT);
    }
}