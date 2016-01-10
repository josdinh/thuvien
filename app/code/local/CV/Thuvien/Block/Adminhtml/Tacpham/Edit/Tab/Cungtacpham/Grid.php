<?php

class CV_Thuvien_Block_Adminhtml_Tacpham_Edit_Tab_Cungtacpham_Grid extends Mage_Adminhtml_Block_Widget_Grid
{

    public function __construct()
    {
        parent::__construct();
        $this->setId('cungtpGrid');
        $this->setDefaultSort('NgayMuon,NgayTra');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
    }

    protected function _prepareCollection()
    {
		if(Mage::registry('tppop_data')->getData('MaTpPop')){
            $maTpCom = 0;
            if(Mage::registry('tppop_data')->getData('MaTpCom')) {
                $maTpCom = Mage::registry('tppop_data')->getData('MaTpCom');
            }
			$collection = Mage::getModel('thuvien/tppop')->getCollection();
			$collection->getSelect()
						->joinLeft( array('tpnhaxb'=> 'tpnhaxb'), 'tpnhaxb.MaNhaXB = main_table.MaNhaXB', array('tpnhaxb.NhaXB'))
						->joinLeft( array('tphientrang'=> 'tphientrang'), 'tphientrang.MaHienTrang = main_table.MaHienTrang', array('tphientrang.HienTrang'))
						->joinLeft( array('tptinhtrang'=> 'tptinhtrang'), 'tptinhtrang.MaTinhTrang = main_table.MaTinhTrang', array('tptinhtrang.TinhTrang'))
						->joinLeft( array('tplistkhosach'=> 'tplistkhosach'), 'tplistkhosach.MaKhoSach = main_table.MaKhoSach', array('tplistkhosach.KhoSach'))
                        -> where('main_table.MaTpCom = "' . $maTpCom . '"');


			$this->setCollection($collection);
			return parent::_prepareCollection();
		}
    }

    protected function _prepareColumns()
    {
		$this->addColumn('GMaTpPop', array(
            'header'    => Mage::helper('thuvien')->__('ID'),
            'align'     =>'left',
            'width'     => '50px',
            'index'     => 'MaTpPop',

        ));
        $this->addColumn('GMaTpPop', array(
            'header'    => Mage::helper('thuvien')->__('Mã tác phẩm'),
            'align'     =>'left',
            'width'     => '50px',
            'index'     => 'MaTpPop',

        ));

        $this->addColumn('GBanSo', array(
            'header'    => Mage::helper('thuvien')->__('Bản'),
            'align'     =>'left',
            'width'     => '50px',
            'index'     => 'BanSo',
        ));

        $this->addColumn('GNhaXB', array(
            'header'    => Mage::helper('thuvien')->__('Nhà Xuất Bản'),
            'align'     =>'right',
            'width'     => '50px',
            'index'     => 'NhaXB',
        ));

        $this->addColumn('GNamXuatBan', array(
            'header'    => Mage::helper('thuvien')->__('Năm'),
            'align'     =>'right',
            'width'     => '50px',
            'index'     => 'NamXuatBan',
        ));

        $this->addColumn('GSoTrang', array(
            'header'    => Mage::helper('thuvien')->__('Trang'),
            'align'     =>'left',
            'width'     => '50px',
            'index'     => 'SoTrang',
        ));

       $this->addColumn('GKho', array(
            'header'    => Mage::helper('thuvien')->__('Khổ'),
            'align'     =>'right',
            'width'     => '50px',
            'index'     => 'Kho',
        ));

		 $this->addColumn('GNgayNhap', array(
            'header'    => Mage::helper('thuvien')->__('Ngày Nhập'),
            'align'     =>'right',
            'width'     => '50px',
            'index'     => 'NgayNhap',
        ));

		 $this->addColumn('GGiaTien', array(
            'header'    => Mage::helper('thuvien')->__('Giá Tiền'),
            'align'     =>'right',
            'width'     => '50px',
            'index'     => 'GiaTien',
        ));

		 $this->addColumn('GTinhTrang', array(
            'header'    => Mage::helper('thuvien')->__('Tình Trạng'),
            'align'     =>'right',
            'width'     => '50px',
            'index'     => 'TinhTrang',
        ));

		 $this->addColumn('GHienTrang', array(
            'header'    => Mage::helper('thuvien')->__('Tác Phẩm'),
            'align'     =>'right',
            'width'     => '50px',
            'index'     => 'HienTrang',
        ));

		 $this->addColumn('GKhoSach', array(
            'header'    => Mage::helper('thuvien')->__('Kho'),
            'align'     =>'right',
            'width'     => '50px',
            'index'     => 'KhoSach',
        ));

        return parent::_prepareColumns();
    }

    private function expiredDates() {
        return "d-M-yyyy";
    }
}