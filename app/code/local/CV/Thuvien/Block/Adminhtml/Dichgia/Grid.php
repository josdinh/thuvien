<?php

class CV_Thuvien_Block_Adminhtml_Dichgia_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
  public function __construct()
  {
      parent::__construct();
      $this->setId('dichgiaGrid');
      $this->setDefaultSort('MaListDG');
     // $this->setDefaultDir('ASC');
      $this->setSaveParametersInSession(true);
  }

  protected function _prepareCollection()
  {
      $collection = Mage::getModel('thuvien/dichgia')->getCollection();
      $this->setCollection($collection);
      return parent::_prepareCollection();
  }

  protected function _prepareColumns()
  {
      $this->addColumn('MaListDG', array(
          'header'    => Mage::helper('thuvien')->__('Mã dịch giả'),
          'align'     =>'left',
          'width'     => '50px',
          'index'     => 'MaListDG',
          'width' =>'30%'
      ));

      $this->addColumn('TenDichGia', array(
          'header'    => Mage::helper('thuvien')->__('Tên dịch giả'),
          'align'     =>'left',
          'width'     => '50px',
          'index'     => 'TenDichGia',
          'width' =>'60%'
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
        $this->setMassactionIdField('MaListDG');
        $this->getMassactionBlock()->setFormFieldName('dichgia');

        $this->getMassactionBlock()->addItem('delete', array(
            'label'    => Mage::helper('thuvien')->__('Xóa dịch giả đã chọn'),
            'url'      => $this->getUrl('*/*/massDelete'),
            'style' => 'min-width:45px',
            'confirm'  => Mage::helper('thuvien')->__('Bạn có chắc chắn xóa không?')
        ));

        return $this;
    }


}