<?php

class CV_Thuvien_Block_Adminhtml_Docgia_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
  public function __construct()
  {
      parent::__construct();
      $this->setId('docgiaGrid');
      $this->setDefaultSort('MaDocGia');
      $this->setDefaultDir('DESC');
      $this->setSaveParametersInSession(true);
  }

  protected function _prepareCollection()
  {
      $collection = Mage::getModel('thuvien/docgia')->getCollection();
      $this->setCollection($collection);
      return parent::_prepareCollection();
  }

  protected function _prepareColumns()
  {
      $this->addColumn('MaDocGia', array(
          'header'    => Mage::helper('thuvien')->__('Mã Độc giả'),
          'align'     =>'left',
          'width'     => '50px',
          'index'     => 'MaDocGia',
      ));

      $this->addColumn('HoVaTen', array(
          'header'    => Mage::helper('thuvien')->__('Họ và Tên'),
          'align'     =>'left',
          'width'     => '50px',
          'index'     => 'HoVaTen',
      ));

      $this->addColumn('NamSinh', array(
          'header'    => Mage::helper('thuvien')->__('Năm Sinh'),
          'align'     =>'left',
          'width'     => '50px',
          'index'     => 'NamSinh',
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

      $this->addColumn('DiaChi2', array(
          'header'    => Mage::helper('thuvien')->__('Ph.-Quận'),
          'align'     =>'left',
          'width'     => '50px',
          'index'     => 'DiaChi2',
      ));

/*

         $this->addColumn('action',
             array(
                 'header'    =>  Mage::helper('managelicense')->__('Action'),
                 'width'     => '100',
                 'type'      => 'action',
                 'getter'    => 'getId',
                 'actions'   => array(
                     array(
                         'caption'   => Mage::helper('managelicense')->__('Edit'),
                         'url'       => array('base'=> '/edit'),
                         'field'     => 'id'
                     )
                 ),
                 'filter'    => false,
                 'sortable'  => false,
                 'index'     => 'stores',
                 'is_system' => true,
         ));
 */
         $this->addExportType('*exportCsv', Mage::helper('managelicense')->__('CSV'));
         $this->addExportType('*exportXml', Mage::helper('managelicense')->__('XML'));

      return parent::_prepareColumns();
  }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('managelicense_id');
        $this->getMassactionBlock()->setFormFieldName('managelicense');

        $this->getMassactionBlock()->addItem('delete', array(
             'label'    => Mage::helper('managelicense')->__('Delete'),
             'url'      => $this->getUrl('*/*/massDelete'),
             'confirm'  => Mage::helper('managelicense')->__('Are you sure?')
        ));

        $statuses = Mage::getSingleton('managelicense/status')->getOptionArray();

        array_unshift($statuses, array('label'=>'', 'value'=>''));
        $this->getMassactionBlock()->addItem('status', array(
             'label'=> Mage::helper('managelicense')->__('Change status'),
             'url'  => $this->getUrl('*/*/massStatus', array('_current'=>true)),
             'additional' => array(
                    'visibility' => array(
                         'name' => 'status',
                         'type' => 'select',
                         'class' => 'required-entry',
                         'label' => Mage::helper('managelicense')->__('Status'),
                         'values' => $statuses
                     )
             )
        ));
        return $this;
    }

  public function getRowUrl($row)
  {
      return $this->getUrl('*/*/edit', array('id' => $row->getId()));
  }

}