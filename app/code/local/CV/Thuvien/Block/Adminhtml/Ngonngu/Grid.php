<?php

class CV_Thuvien_Block_Adminhtml_Ngonngu_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
  public function __construct()
  {
      parent::__construct();
      $this->setId('ngonnguGrid');
      $this->setDefaultSort('MaNgonNgu');
     // $this->setDefaultDir('ASC');
      $this->setSaveParametersInSession(true);
  }

  protected function _prepareCollection()
  {
      $collection = Mage::getModel('thuvien/ngonngu')->getCollection();
      $this->setCollection($collection);
      return parent::_prepareCollection();
  }

  protected function _prepareColumns()
  { 
      $this->addColumn('MaNgonNgu', array(
          'header'    => Mage::helper('thuvien')->__('Mã ngôn ngữ'),
          'align'     =>'left',
          'width'     => '50px',
          'index'     => 'MaNgonNgu',
          'width' =>'45%'
      ));

      $this->addColumn('NgonNgu', array(
          'header'    => Mage::helper('thuvien')->__('Ngôn ngữ'),
          'align'     =>'left',
          'width'     => '50px',
          'index'     => 'NgonNgu',
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
        $this->setMassactionIdField('MaNgonNgu');
        $this->getMassactionBlock()->setFormFieldName('ngonngu');

        $this->getMassactionBlock()->addItem('delete', array(
            'label'    => Mage::helper('thuvien')->__('Xóa ngôn ngữ đã chọn'),
            'url'      => $this->getUrl('*/*/massDelete'),
            'style' => 'min-width:45px',
            'confirm'  => Mage::helper('thuvien')->__('Bạn có chắc chắn xóa không?')
        ));

        return $this;
    }


}