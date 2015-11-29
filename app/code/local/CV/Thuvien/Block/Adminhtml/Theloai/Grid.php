<?php

class CV_Thuvien_Block_Adminhtml_Theloai_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
  public function __construct()
  {
      parent::__construct();
      $this->setId('theloaiGrid');
      $this->setDefaultSort('MaTheLoai');
     // $this->setDefaultDir('ASC');
      $this->setSaveParametersInSession(true);
  }

  protected function _prepareCollection()
  {
      $collection = Mage::getModel('thuvien/theloai')->getCollection();
      $this->setCollection($collection);
      return parent::_prepareCollection();
  }

  protected function _prepareColumns()
  { 
      $this->addColumn('MaTheLoai', array(
          'header'    => Mage::helper('thuvien')->__('Mã thể loại'),
          'align'     =>'left',
          'width'     => '50px',
          'index'     => 'MaTheLoai',
          'width' =>'45%'
      ));

      $this->addColumn('TheLoai', array(
          'header'    => Mage::helper('thuvien')->__('Tên thể loại'),
          'align'     =>'left',
          'width'     => '50px',
          'index'     => 'TheLoai',
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
        $this->setMassactionIdField('MaTheLoai');
        $this->getMassactionBlock()->setFormFieldName('theloai');

        $this->getMassactionBlock()->addItem('delete', array(
            'label'    => Mage::helper('thuvien')->__('Xóa Thể loại đã chọn'),
            'url'      => $this->getUrl('*/*/massDelete'),
            'style' => 'min-width:45px',
            'confirm'  => Mage::helper('thuvien')->__('Bạn có chắc chắn xóa không?')
        ));

        return $this;
    }


}