<?php

class MW_Managelicense_Block_Adminhtml_Extension_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
  public function __construct()
  {
      parent::__construct();
      $this->setId('extensionGrid');
      $this->setDefaultSort('extension_id');
      $this->setDefaultDir('ASC');
      $this->setSaveParametersInSession(true);
  }

  protected function _prepareCollection()
  {
      $collection = Mage::getModel('managelicense/extension')->getCollection();
      $this->setCollection($collection);
      return parent::_prepareCollection();
  }

  protected function _prepareColumns()
  {
      $this->addColumn('extension_id', array(
          'header'    => Mage::helper('managelicense')->__('ID'),
          'align'     =>'right',
          'width'     => '50px',
          'index'     => 'extension_id',
      ));

      $this->addColumn('name', array(
          'header'    => Mage::helper('managelicense')->__('Name'),
          'align'     =>'left',
          'index'     => 'name',
      ));
      
       $this->addColumn('key',array(
      	'header' => Mage::helper('managelicense')->__('Key'),
      	'align' => 'left',
      	'index' => 'key',
      ));
      
      $this->addColumn('version',array(
      	'header' => Mage::helper('managelicense')->__('Version'),
      	'align' => 'left',
      	'index' => 'version',
      ));

      $this->addColumn('sku',array(
      	'header' => Mage::helper('managelicense')->__('SKU'),
      	'align' => 'left',
      	'index' => 'sku',
      ));
      
       $this->addColumn('url',array(
      	'header' => Mage::helper('managelicense')->__('Url'),
      	'align' => 'left',
      	'index' => 'url',
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
        $this->setMassactionIdField('extension_id');
        $this->getMassactionBlock()->setFormFieldName('extension');

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