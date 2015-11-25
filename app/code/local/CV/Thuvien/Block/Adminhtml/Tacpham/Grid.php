<?php

class CV_Thuvien_Block_Adminhtml_Tacpham_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
  public function __construct()
  {
      parent::__construct();
      $this->setId('tacphamGrid');
      $this->setDefaultSort('MaTpCom');
      $this->setDefaultDir('DESC');
      $this->setSaveParametersInSession(true);
  }

  protected function _prepareCollection()
  {
	  //echo get_class(Mage::getModel('thuvien/tacphamcom'));die;
      $collection = Mage::getModel('thuvien/tacphamcom')->getCollection();
      $this->setCollection($collection);
	  //Zend_debug::dump($collection->getData());
      return parent::_prepareCollection();
  }

  protected function _prepareColumns()
  { 
      $this->addColumn('MaTpCom', array(
          'header'    => Mage::helper('thuvien')->__('Mã Tác Phẩm'),
          'align'     =>'left',
          'width'     => '50px',
          'index'     => 'MaTpCom',
      ));

      $this->addColumn('tentacpham', array(
          'header'    => Mage::helper('thuvien')->__('Tên tác phẩm'),
          'align'     =>'left',
          'width'     => '50px',
          'index'     => 'TenTacPham',
      ));

      $this->addColumn('PhuThem', array(
          'header'    => Mage::helper('thuvien')->__('Phụ Thêm'),
          'align'     =>'left',
          'width'     => '50px',
          'index'     => 'PhuThem',
      ));

      $this->addColumn('Tomluoc', array(
          'header'    => Mage::helper('thuvien')->__('Tóm lược'),
          'align'     =>'left',
          'width'     => '50px',
          'index'     => 'Tomluoc',
      ));

      
         $this->addExportType('*exportCsv', Mage::helper('thuvien')->__('CSV'));
         $this->addExportType('*exportXml', Mage::helper('thuvien')->__('XML'));

      return parent::_prepareColumns();
  }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('MaDocGia');
        $this->getMassactionBlock()->setFormFieldName('docgia');

        $this->getMassactionBlock()->addItem('delete', array(
             'label'    => Mage::helper('thuvien')->__('Xóa Độc giả đã chọn'),
             'url'      => $this->getUrl('*/*/massDelete'),
            'style' => 'min-width:45px',
             'confirm'  => Mage::helper('thuvien')->__('Bạn có chắc chắn xóa không?')
        ));

        /* $statuses = Mage::getSingleton('thuvien/status')->getOptionArray();

        array_unshift($statuses, array('label'=>'', 'value'=>''));
        $this->getMassactionBlock()->addItem('status', array(
             'label'=> Mage::helper('managelicense')->__('Thay đổi trạng thái'),
             'url'  => $this->getUrl('//massStatus', array('_current'=>true)),
             'additional' => array(
                    'visibility' => array(
                         'name' => 'status',
                         'type' => 'select',
                         'class' => 'required-entry',
                         'label' => Mage::helper('managelicense')->__('Status'),
                         'values' => $statuses
                     )
             )
        ));*/
        return $this;
    }

  public function getRowUrl($row)
  {
      return $this->getUrl('*/*/edit', array('id' => $row->getId()));
  }

}