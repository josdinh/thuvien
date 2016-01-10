<?php

class CV_Thuvien_Block_Adminhtml_Tacpham_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
  public function __construct()
  {
      parent::__construct();
      $this->setId('tacphamGrid');
      $this->setDefaultSort('MaTpPop');
      $this->setDefaultDir('DESC');
      $this->setSaveParametersInSession(true);
  }

  protected function _prepareCollection()
  {
	  $collection = Mage::getModel('thuvien/tppop')->getCollection();
      $collection->getSelect()
                ->joinLeft(array('tpcom'=>'tptacphamcom'),'tpcom.MaTpCom = main_table.MaTpCom',array('tpcom.*'))
                ->joinLeft(array('loaitp'=>'tplisttheloai'),'loaitp.MaTheLoai = tpcom.MaLoaiTacPham',array('loaitp.TheLoai'))
                ->joinLeft(array('sachbo'=>'tplistsachbo'),'sachbo.MaSachBo = tpcom.MaSachBo',array('sachbo.SachBo'))
                ->joinLeft(array('ddc'=>'tpddc'),'ddc.MaDDC = tpcom.MaDDC',array('ddc.TenDDC'))
                ->joinLeft(array('nxb'=>'tpnhaxb'),'nxb.MaNhaXB = main_table.MaNhaXB',array('NhaXB'))
                ->joinLeft(array('htr'=>'tphientrang'),'htr.MaHienTrang = main_table.MaHienTrang',array('HienTrang'))
                ->joinLeft(array('ttr'=>'tptinhtrang'),'ttr.MaTinhTrang = main_table.MaTinhTrang',array('TinhTrang'))
                ->joinLeft(array('kho'=>'tplistkhosach'),'kho.MaKhoSach = main_table.MaKhoSach',array('KhoSach'));

      $this->setCollection($collection);

      return parent::_prepareCollection();
  }

  protected function _prepareColumns()
  {

      $this->addColumn('MaTpPop', array(
          'header'    => Mage::helper('thuvien')->__('Mã Tác Phẩm Thư viện'),
          'align'     =>'left',
          'width'     => '50px',
          'index'     => 'MaTpPop',
          'width' => '5%'
      ));

      $this->addColumn('TenTacPham', array(
          'header'    => Mage::helper('thuvien')->__('Tên tác phẩm'),
          'align'     =>'left',
          'width'     => '50px',
          'index'     => 'TenTacPham',
          'width' => '20%'
      ));

      $this->addColumn('TenDDC', array(
          'header'    => Mage::helper('thuvien')->__('DDC'),
          'align'     =>'left',
          'width'     => '50px',
          'index'     => 'TenDDC',
          'index'     => 'TenDDC',
          'width' => '15%'
      ));

      $this->addColumn('SachBo', array(
          'header'    => Mage::helper('thuvien')->__('Sách bộ'),
          'align'     =>'left',
          'width'     => '50px',
          'index'     => 'SachBo',
          'width' => '10%'
      ));

      $this->addColumn('TapSo', array(
          'header'    => Mage::helper('thuvien')->__('Tập Số'),
          'align'     =>'left',
          'width'     => '50px',
          'index'     => 'TapSo',
          'width' => '10%'
      ));

      $this->addColumn('BanSo', array(
          'header'    => Mage::helper('thuvien')->__('Bản số'),
          'align'     =>'left',
          'width'     => '50px',
          'index'     => 'BanSo',
      ));

      $this->addColumn('NhaXB', array(
          'header'    => Mage::helper('thuvien')->__('Nhà XB'),
          'align'     =>'right',
          'width'     => '50px',
          'index'     => 'NhaXB',
      ));

      $this->addColumn('NamXuatBan', array(
          'header'    => Mage::helper('thuvien')->__('Năm XB'),
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
          'header'    => Mage::helper('thuvien')->__('Ngày nhập'),
          'align'     =>'right',
          'width'     => '50px',
          'index'     => 'NgayNhap',
      ));

      $this->addColumn('GiaTien', array(
          'header'    => Mage::helper('thuvien')->__('Giá tiền'),
          'align'     =>'right',
          'width'     => '50px',
          'index'     => 'GiaTien',
      ));

      $this->addColumn('TinhTrang', array(
          'header'    => Mage::helper('thuvien')->__('Tình trạng'),
          'align'     =>'right',
          'width'     => '50px',
          'index'     => 'TinhTrang',
      ));

      $this->addColumn('HienTrang', array(
          'header'    => Mage::helper('thuvien')->__('Hiện trạng'),
          'align'     =>'right',
          'width'     => '50px',
          'index'     => 'HienTrang',
      ));

      $this->addColumn('KhoSach', array(
          'header'    => Mage::helper('thuvien')->__('Kho sách'),
          'align'     =>'right',
          'width'     => '50px',
          'index'     => 'KhoSach',
      ));


      $this->addExportType('*/*/exportCsv', Mage::helper('thuvien')->__('CSV'));
      $this->addExportType('*/*/exportXml', Mage::helper('thuvien')->__('XML'));

      return parent::_prepareColumns();
  }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('MaTpPop');
        $this->getMassactionBlock()->setFormFieldName('tppop');

        $this->getMassactionBlock()->addItem('delete', array(
             'label'    => Mage::helper('thuvien')->__('Xóa Độc giả đã chọn'),
             'url'      => $this->getUrl('*/*/massDelete'),
            'style' => 'min-width:45px',
             'confirm'  => Mage::helper('thuvien')->__('Bạn có chắc chắn xóa không?')
        ));

        return $this;
    }

  public function getRowUrl($row)
  {
      return $this->getUrl('*/*/edit', array('id' => $row->getId()));
  }

}