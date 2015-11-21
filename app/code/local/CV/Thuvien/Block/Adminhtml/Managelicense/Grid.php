<?php

class MW_Managelicense_Block_Adminhtml_Managelicense_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
  public function __construct()
  {
      parent::__construct();
      $this->setId('managelicenseGrid');
      $this->setDefaultSort('active_date');
      $this->setDefaultDir('DESC');
      $this->setSaveParametersInSession(true);
  }

  protected function _prepareCollection()
  {
      $collection = Mage::getModel('managelicense/managelicense')->getCollection();
      $this->setCollection($collection);
      return parent::_prepareCollection();
  }

  protected function _prepareColumns()
  {
      $this->addColumn('managelicense_id', array(
          'header'    => Mage::helper('managelicense')->__('ID'),
          'align'     =>'right',
          'width'     => '50px',
          'index'     => 'managelicense_id',
      ));

      $this->addColumn('order_id', array(
          'header'    => Mage::helper('managelicense')->__('Order Number'),
          'align'     =>'left',
          'index'     => 'order_id',      
          'renderer' => 'managelicense/adminhtml_managelicense_renderer_orderurl',
      ));
      
      $this->addColumn('extension',array(
      	'header' => Mage::helper('managelicense')->__('Extension'),
      	'align' => 'left',
      	'index' => 'extension',
      ));

      $this->addColumn('email',array(
      	'header' => Mage::helper('managelicense')->__('Email'),
      	'align' => 'left',
      	'index' => 'email',
      ));
      
       $this->addColumn('magento_url',array(
      	'header' => Mage::helper('managelicense')->__('Magento Url'),      	    
         'align'     =>'left',
         'index'     => 'magento_url',      
         'renderer' => 'managelicense/adminhtml_managelicense_renderer_magentourl',
      ));
      
       $this->addColumn('purchased_date',array(
      	'header' => Mage::helper('managelicense')->__('Purchased Date'),
      	'align' => 'left',
      	'index' => 'purchased_date',
        'type'      => 'datetime',
      ));      
      
       $this->addColumn('active_date',array(
      	'header' => Mage::helper('managelicense')->__('Activated Date'),
      	'align' => 'left',
      	'index' => 'active_date',
        'type'      => 'datetime',
      ));
      
      $this->addColumn('comment',array(
      	'header' => Mage::helper('managelicense')->__('Comment'),
      	'align' => 'left',
      	'index' => 'comment',       
      ));     
          
      $this->addColumn('status', array(
          'header'    => Mage::helper('managelicense')->__('Status'),
          'align'     => 'left',
          'width'     => '80px',
          'index'     => 'status',
          'type'      => 'options',
          'options'   => array(
              0 => 'Closed',
              3 => 'Trial',
              1 => 'Pending',
              2 => 'Activated',             
             ),
      ));
	  
        $this->addColumn('action',
            array(
                'header'    =>  Mage::helper('managelicense')->__('Action'),
                'width'     => '100',
                'type'      => 'action',
                'getter'    => 'getId',
                'actions'   => array(
                    array(
                        'caption'   => Mage::helper('managelicense')->__('Edit'),
                        'url'       => array('base'=> '*/*/edit'),
                        'field'     => 'id'
                    )
                ),
                'filter'    => false,
                'sortable'  => false,
                'index'     => 'stores',
                'is_system' => true,
        ));
		
		$this->addExportType('*/*/exportCsv', Mage::helper('managelicense')->__('CSV'));
		$this->addExportType('*/*/exportXml', Mage::helper('managelicense')->__('XML'));
	  
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