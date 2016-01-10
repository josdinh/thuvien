<?php

class CV_Thuvien_Block_Adminhtml_Tacphamcom_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
  public function __construct()
  {
      parent::__construct();
      $this->setId('tacphamGrid');
      $this->setDefaultSort('MaTpCom');
      $this->setDefaultDir('DESC');
      $this->setSaveParametersInSession(true);
  }

  protected function _prepareCollection()
  {
	  $collection = Mage::getModel('thuvien/tpcom')->getCollection();
      $collection->getSelect()
                ->joinLeft(array('loaitp'=>'tplisttheloai'),'loaitp.MaTheLoai = main_table.MaLoaiTacPham',array('loaitp.TheLoai'))
                ->joinLeft(array('sachbo'=>'tplistsachbo'),'sachbo.MaSachBo = main_table.MaSachBo',array('sachbo.SachBo'))
                ->joinLeft(array('ddc'=>'tpddc'),'ddc.MaDDC = main_table.MaDDC',array('ddc.TenDDC'));
      $this->setCollection($collection);
      return parent::_prepareCollection();
  }

  protected function _prepareColumns()
  {

      $this->addColumn('MaTpCom', array(
          'header'    => Mage::helper('thuvien')->__('Mã Tác Phẩm'),
          'align'     =>'left',
          'width'     => '50px',
          'index'     => 'MaTpCom',
          'width' => '5%'
      ));

      $this->addColumn('tentacpham', array(
          'header'    => Mage::helper('thuvien')->__('Tên tác phẩm'),
          'align'     =>'left',
          'width'     => '50px',
          'index'     => 'TenTacPham',
          'width' => '20%'
      ));

      $this->addColumn('NguyenTac', array(
          'header'    => Mage::helper('thuvien')->__('Nguyên Tác'),
          'align'     =>'left',
          'width'     => '50px',
          'index'     => 'NguyenTac',
          'width' => '15%'
      ));

      $this->addColumn('PhuThem', array(
          'header'    => Mage::helper('thuvien')->__('Phụ Thêm'),
          'align'     =>'left',
          'width'     => '50px',
          'index'     => 'PhuThem',
          'width' => '15%'
      ));

      $this->addColumn('TenDDC', array(
          'header'    => Mage::helper('thuvien')->__('DDC'),
          'align'     =>'left',
          'width'     => '50px',
          'index'     => 'TenDDC',
          'index'     => 'TenDDC',
          'width' => '15%'
      ));
      $this->addColumn('TheLoai', array(
          'header'    => Mage::helper('thuvien')->__('Thể Loại'),
          'align'     =>'left',
          'width'     => '50px',
          'index'     => 'TheLoai',
          'width' => '10%'
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

      $this->addColumn('NoiBat', array(
          'header'    => Mage::helper('thuvien')->__('Nổi bật'),
          'align'     =>'left',
          'width'     => '50px',
          'type'  => 'options',
          'index'     => 'NoiBat',
          'width' => '10%',
          'options'   => array(
              0 => Mage::helper('cms')->__('Không'),
              1 => Mage::helper('cms')->__('Có')
          ),
      ));



      $this->addExportType('*/*/exportCsv', Mage::helper('thuvien')->__('CSV'));
      $this->addExportType('*/*/exportXml', Mage::helper('thuvien')->__('XML'));

      return parent::_prepareColumns();
  }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('MaTpCom');
        $this->getMassactionBlock()->setFormFieldName('tpcom');

        $this->getMassactionBlock()->addItem('delete', array(
             'label'    => Mage::helper('thuvien')->__('Xóa tác phẩm đã chọn'),
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