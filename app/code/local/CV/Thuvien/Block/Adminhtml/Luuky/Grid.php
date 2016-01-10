<?php

class CV_Thuvien_Block_Adminhtml_Luuky_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
  public function __construct()
  {
      parent::__construct();
      $this->setId('luukyGrid');
      $this->setDefaultSort('MaLuuKy');
      $this->setSaveParametersInSession(true);
  }

  protected function _prepareCollection()
  {
      $collection = Mage::getModel('thuvien/luuky')->getCollection();
      $this->setCollection($collection);
      return parent::_prepareCollection();
  }

  protected function _prepareColumns()
  { 
      $this->addColumn('MaLuuKy', array(
          'header'    => Mage::helper('thuvien')->__('Mã lưu ký'),
          'align'     =>'left',
          'width'     => '5%',
          'index'     => 'MaLuuKy',
      ));

      $this->addColumn('NguoiViet', array(
          'header'    => Mage::helper('thuvien')->__('Người Viết'),
          'align'     =>'left',
          'width'     => '50px',
          'index'     => 'NguoiViet',
          'width'     => '40%',
      ));

      $this->addColumn('NgayViet', array(
          'header'    => Mage::helper('thuvien')->__('Ngày Viết'),
          'align'     =>'left',
          'width'     => '50px',
          'index'     => 'NgayViet',
          'width'     => '15%',
      ));

      $this->addColumn('NoiDung', array(
          'header'    => Mage::helper('thuvien')->__('Địa chỉ 1'),
          'align'     =>'left',
          'width'     => '50px',
          'index'     => 'NoiDung',
          'width'     => '40%',

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
        $this->setMassactionIdField('MaLuuKy');
        $this->getMassactionBlock()->setFormFieldName('luuky');

        $this->getMassactionBlock()->addItem('delete', array(
            'label'    => Mage::helper('thuvien')->__('Xóa lưu ký đã chọn'),
            'url'      => $this->getUrl('*/*/massDelete'),
            'style' => 'min-width:45px',
            'confirm'  => Mage::helper('thuvien')->__('Bạn có chắc chắn xóa không?')
        ));

        return $this;
    }


}