<?php

class CV_Thuvien_Block_Adminhtml_Quydinh_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
  public function __construct()
  {
      parent::__construct();
      $this->setId('quydinhGrid');
      $this->setDefaultSort('id');
      $this->setDefaultDir('DESC');
      $this->setSaveParametersInSession(true);
  }

  protected function _prepareCollection()
  {
      $collection = Mage::getModel('thuvien/tvquydinh')->getCollection();
      $this->setCollection($collection);
      return parent::_prepareCollection();
  }

  protected function _prepareColumns()
  { 
      $this->addColumn('TenThuVien', array(
          'header'    => Mage::helper('thuvien')->__('Tên Thư Viện'),
          'align'     =>'left',
          'width'     => '50px',
          'index'     => 'TenThuVien',
      ));

      $this->addColumn('DiaChi1', array(
          'header'    => Mage::helper('thuvien')->__('Địa chỉ 1'),
          'align'     =>'left',
          'width'     => '50px',
          'index'     => 'DiaChi1',
      ));

      $this->addColumn('ThanhPho', array(
          'header'    => Mage::helper('thuvien')->__('Thành phố'),
          'align'     =>'left',
          'width'     => '50px',
          'index'     => 'ThanhPho',
      ));

      $this->addColumn('DienThoai', array(
          'header'    => Mage::helper('thuvien')->__('Điện Thoại'),
          'align'     =>'left',
          'width'     => '50px',
          'index'     => 'DienThoai',
      ));

      $this->addColumn('Email', array(
          'header'    => Mage::helper('thuvien')->__('Email'),
          'align'     =>'left',
          'width'     => '50px',
          'index'     => 'Email',
      ));
      
         $this->addExportType('*exportCsv', Mage::helper('thuvien')->__('CSV'));
         $this->addExportType('*exportXml', Mage::helper('thuvien')->__('XML'));

      return parent::_prepareColumns();
  }

  public function getRowUrl($row)
  {
      return $this->getUrl('*/*/edit', array('id' => $row->getId()));
  }

}