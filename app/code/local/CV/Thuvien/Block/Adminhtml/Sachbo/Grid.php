<?php

class CV_Thuvien_Block_Adminhtml_Sachbo_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
  public function __construct()
  {
      parent::__construct();
      $this->setId('sachboGrid');
      $this->setDefaultSort('MaSachBo');
     // $this->setDefaultDir('ASC');
      $this->setSaveParametersInSession(true);
  }

  protected function _prepareCollection()
  {
      $collection = Mage::getModel('thuvien/sachbo')->getCollection();
      $this->setCollection($collection);
      return parent::_prepareCollection();
  }

  protected function _prepareColumns()
  {
      $this->addColumn('MaSachBo', array(
          'header'    => Mage::helper('thuvien')->__('Mã sách bộ'),
          'align'     =>'left',
          'width'     => '50px',
          'index'     => 'MaSachBo',
          'width' =>'30%'
      ));

      $this->addColumn('SachBo', array(
          'header'    => Mage::helper('thuvien')->__('Tên sách bộ'),
          'align'     =>'left',
          'width'     => '50px',
          'index'     => 'SachBo',
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
        $this->setMassactionIdField('MaSachBo');
        $this->getMassactionBlock()->setFormFieldName('sachbo');

        $this->getMassactionBlock()->addItem('delete', array(
            'label'    => Mage::helper('thuvien')->__('Xóa sách bộ đã chọn'),
            'url'      => $this->getUrl('*/*/massDelete'),
            'style' => 'min-width:45px',
            'confirm'  => Mage::helper('thuvien')->__('Bạn có chắc chắn xóa không?')
        ));

        return $this;
    }


}