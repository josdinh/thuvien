<?php

class CV_Thuvien_Block_Adminhtml_Khosach_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
  public function __construct()
  {
      parent::__construct();
      $this->setId('khosachrid');
      $this->setDefaultSort('MaKhoSach');
     // $this->setDefaultDir('ASC');
      $this->setSaveParametersInSession(true);
  }

  protected function _prepareCollection()
  {
      $collection = Mage::getModel('thuvien/khosach')->getCollection();
      $this->setCollection($collection);
      return parent::_prepareCollection();
  }

  protected function _prepareColumns()
  {
      $this->addColumn('MaKhoSach', array(
          'header'    => Mage::helper('thuvien')->__('Mã kho sách'),
          'align'     =>'left',
          'width'     => '50px',
          'index'     => 'MaKhoSach',
          'width' =>'20%'
      ));

      $this->addColumn('VietTat',array(
          'header'    => Mage::helper('thuvien')->__('VietTat'),
          'align'     =>'left',
          'width'     => '50px',
          'index'     => 'VietTat',
          'width' =>'20%'
      ));

      $this->addColumn('KhoSach',array(
          'header'    => Mage::helper('thuvien')->__('Tên kho sách'),
          'align'     =>'left',
          'width'     => '50px',
          'index'     => 'KhoSach',
          'width' =>'50%'
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
        $this->setMassactionIdField('MaKhoSach');
        $this->getMassactionBlock()->setFormFieldName('khosach');

        $this->getMassactionBlock()->addItem('delete', array(
            'label'    => Mage::helper('thuvien')->__('Xóa kho sách đã chọn'),
            'url'      => $this->getUrl('*/*/massDelete'),
            'style' => 'min-width:45px',
            'confirm'  => Mage::helper('thuvien')->__('Bạn có chắc chắn xóa không?')
        ));

        return $this;
    }


}