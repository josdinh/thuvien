<?php

class CV_Thuvien_Block_Adminhtml_Nhaxb_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
  public function __construct()
  {
      parent::__construct();
      $this->setId('nhaxbGrid');
      $this->setDefaultSort('MaNhaXB');
     // $this->setDefaultDir('ASC');
      $this->setSaveParametersInSession(true);
  }

  protected function _prepareCollection()
  {
      $collection = Mage::getModel('thuvien/nhaxb')->getCollection();
      $this->setCollection($collection);
      return parent::_prepareCollection();
  }

  protected function _prepareColumns()
  { 
      $this->addColumn('MaNhaXB', array(
          'header'    => Mage::helper('thuvien')->__('Mã Nhà Xuất Bản'),
          'align'     =>'left',
          'width'     => '50px',
          'index'     => 'MaNhaXB',
          'width' =>'45%'
      ));

      $this->addColumn('NhaXB', array(
          'header'    => Mage::helper('thuvien')->__('Tên Nhà Xuất Bản'),
          'align'     =>'left',
          'width'     => '50px',
          'index'     => 'NhaXB',
          'width' =>'45%'
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
        $this->setMassactionIdField('MaNhaXB');
        $this->getMassactionBlock()->setFormFieldName('nhaxb');

        $this->getMassactionBlock()->addItem('delete', array(
            'label'    => Mage::helper('thuvien')->__('Xóa Nhà XB đã chọn'),
            'url'      => $this->getUrl('*/*/massDelete'),
            'style' => 'min-width:45px',
            'confirm'  => Mage::helper('thuvien')->__('Bạn có chắc chắn xóa không?')
        ));

        return $this;
    }


}