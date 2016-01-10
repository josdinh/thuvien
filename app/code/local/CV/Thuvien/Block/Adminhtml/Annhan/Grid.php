<?php

class CV_Thuvien_Block_Adminhtml_Annhan_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
  public function __construct()
  {
      parent::__construct();
      $this->setId('annhanGrid');
      $this->setDefaultSort('MaAnNhan');
      $this->setSaveParametersInSession(true);
  }

  protected function _prepareCollection()
  {
      $collection = Mage::getModel('thuvien/tvannhan')->getCollection();
      $collection->getSelect()
                 ->joinLeft(array('tp' => 'dgthanhpho'),'tp.ThanhPho = main_table.ThanhPho',array('TenTp'));
      $this->setCollection($collection);
      return parent::_prepareCollection();
  }

  protected function _prepareColumns()
  { 
      $this->addColumn('MaAnNhan', array(
          'header'    => Mage::helper('thuvien')->__('Mã ân nhân'),
          'align'     =>'left',
          'width'     => '5%',
          'index'     => 'MaAnNhan',
      ));

      $this->addColumn('ChucVi', array(
          'header'    => Mage::helper('thuvien')->__('Chức vị'),
          'align'     =>'left',
          'width'     => '50px',
          'index'     => 'ChucVi',
          'width'     => '14%',
      ));

      $this->addColumn('HoVaTen', array(
          'header'    => Mage::helper('thuvien')->__('Họ và tên'),
          'align'     =>'left',
          'width'     => '50px',
          'index'     => 'HoVaTen',
          'width'     => '14%',
      ));

      $this->addColumn('DiaChi1', array(
          'header'    => Mage::helper('thuvien')->__('Địa chỉ 1'),
          'align'     =>'left',
          'width'     => '50px',
          'index'     => 'DiaChi1',
          'width'     => '14%',

      ));

      $this->addColumn('DiaChi2', array(
          'header'    => Mage::helper('thuvien')->__('Địa chỉ 2'),
          'align'     =>'left',
          'width'     => '50px',
          'index'     => 'DiaChi2',
          'width'     => '14%',
      ));

      $this->addColumn('TenTp', array(
          'header'    => Mage::helper('thuvien')->__('Thành Phố'),
          'align'     =>'left',
          'width'     => '50px',
          'index'     => 'TenTp',
          'width'     => '5%',

      ));

      $this->addColumn('DienThoai', array(
          'header'    => Mage::helper('thuvien')->__('Điện thoại'),
          'align'     =>'left',
          'width'     => '50px',
          'index'     => 'DienThoai',
          'width'     => '14%',
      ));

      $this->addColumn('Email', array(
          'header'    => Mage::helper('thuvien')->__('Email'),
          'align'     =>'left',
          'width'     => '50px',
          'index'     => 'Email',
          'width'     => '14%',
      ));

      $this->addExportType('*exportCsv', Mage::helper('thuvien')->__('CSV'));
      $this->addExportType('*exportXml', Mage::helper('thuvien')->__('XML'));

      return parent::_prepareColumns();
  }

  public function getRowUrl($row)
  {
      return $this->getUrl('*/*/edit', array('id' => $row->getId()));
  }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('MaAnNhan');
        $this->getMassactionBlock()->setFormFieldName('annhan');

        $this->getMassactionBlock()->addItem('delete', array(
            'label'    => Mage::helper('thuvien')->__('Xóa ân nhân đã chọn'),
            'url'      => $this->getUrl('*/*/massDelete'),
            'style' => 'min-width:45px',
            'confirm'  => Mage::helper('thuvien')->__('Bạn có chắc chắn xóa không?')
        ));

        return $this;
    }


}