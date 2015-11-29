<?php

class CV_Thuvien_Block_Adminhtml_Ddc_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
  public function __construct()
  {
      parent::__construct();
      $this->setId('theloaiGrid');
      $this->setDefaultSort('MaDDC');
      $this->setDefaultDir('DESC');
      $this->setSaveParametersInSession(true);
  }

  protected function _prepareCollection()
  {
      $collection = Mage::getModel('thuvien/ddc')->getCollection();
      $this->setCollection($collection);
      return parent::_prepareCollection();
  }

  protected function _prepareColumns()
  { 
      $this->addColumn('DDC', array(
          'header'    => Mage::helper('thuvien')->__('DDC'),
          'align'     =>'left',
          'width'     => '50px',
          'index'     => 'DDC',
          'width' => '45%'
      ));

      $this->addColumn('TenDDC', array(
          'header'    => Mage::helper('thuvien')->__('Tên DDC'),
          'align'     =>'left',
          'width'     => '50px',
          'index'     => 'TenDDC',
          'width' => '45%'
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
        $this->setMassactionIdField('MaDDC');
        $this->getMassactionBlock()->setFormFieldName('ddc');

        $this->getMassactionBlock()->addItem('delete', array(
            'label'    => Mage::helper('thuvien')->__('Xóa DDC đã chọn'),
            'url'      => $this->getUrl('*/*/massDelete'),
            'style' => 'min-width:45px',
            'confirm'  => Mage::helper('thuvien')->__('Bạn có chắc chắn xóa không?')
        ));

        return $this;
    }


}