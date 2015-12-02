<?php

class CV_Thuvien_Block_Adminhtml_Tacgia_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
  public function __construct()
  {
      parent::__construct();
      $this->setId('tacgiaGrid');
      $this->setDefaultSort('MaListTG');
     // $this->setDefaultDir('ASC');
      $this->setSaveParametersInSession(true);
  }

  protected function _prepareCollection()
  {
      $collection = Mage::getModel('thuvien/tacgia')->getCollection();
      $this->setCollection($collection);
      return parent::_prepareCollection();
  }

  protected function _prepareColumns()
  {
      $this->addColumn('MaListTG', array(
          'header'    => Mage::helper('thuvien')->__('Mã tác giả'),
          'align'     =>'left',
          'width'     => '50px',
          'index'     => 'MaListTG',
          'width' =>'15%'
      ));

      $this->addColumn('TenTacGia', array(
          'header'    => Mage::helper('thuvien')->__('Tên tác giả'),
          'align'     =>'left',
          'width'     => '50px',
          'index'     => 'TenTacGia',
          'width' =>'45%'
      ));

      $this->addColumn('KyHieuTg', array(
          'header'    => Mage::helper('thuvien')->__('Ký hiệu tác giả'),
          'align'     =>'left',
          'width'     => '50px',
          'index'     => 'KyHieuTg',
          'width' =>'30%'
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
        $this->setMassactionIdField('MaListTG');
        $this->getMassactionBlock()->setFormFieldName('tacgia');

        $this->getMassactionBlock()->addItem('delete', array(
            'label'    => Mage::helper('thuvien')->__('Xóa tác giả đã chọn'),
            'url'      => $this->getUrl('*/*/massDelete'),
            'style' => 'min-width:45px',
            'confirm'  => Mage::helper('thuvien')->__('Bạn có chắc chắn xóa không?')
        ));

        return $this;
    }


}