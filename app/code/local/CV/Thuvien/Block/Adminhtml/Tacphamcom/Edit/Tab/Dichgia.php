<?php

class CV_Thuvien_Block_Adminhtml_Tacphamcom_Edit_Tab_Dichgia extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('dichgia_grid');
        $this->setUseAjax(true); // Using ajax grid is important
        $this->setDefaultSort('MaListDG');
        $this->setDefaultFilter(array('in_dichgia'=>1)); // By default we have added a filter for the rows, that in_products value to be 1
        $this->setSaveParametersInSession(false);  //Dont save paramters in session or else it creates problems
    }

    protected function _addColumnFilterToCollection($column)
    {
        // Set custom filter for in product flag
        if ($column->getId() == 'in_dichgia') {
            $dichgias = $this->_getSelectedDichgia();
            if (empty($dichgias)) {
                $dichgias = 0;
            }
            if ($column->getFilter()->getValue()) {
                $this->getCollection()->addFieldToFilter('MaListDG', array('in'=>$dichgias));
            } else {
                if($dichgias) {
                    $this->getCollection()->addFieldToFilter('MaListDG', array('nin'=>$dichgias));
                }
            }
        } else {
            parent::_addColumnFilterToCollection($column);
        }
        return $this;
    }


    protected function _prepareCollection()
    {
        $collection = Mage::getModel('thuvien/dichgia')->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {

        $this->addColumn('in_dichgia', array(
            'header_css_class'  => 'a-center',
            'type'              => 'checkbox',
            'name'              => 'dichgia',
            'values'            => $this->_getSelectedDichgia(),
            'align'             => 'center',
            'index'             => 'MaListDG'
        ));


        $this->addColumn('MaListDG', array(
            'header'    => Mage::helper('thuvien')->__('Mã dịch giả'),
            'align'     =>'left',
            'width'     => '50px',
            'index'     => 'MaListDG',
            'name' => 'MaListDG',
            'width' => '10%'
        ));

        $this->addColumn('TenDichGia', array(
            'header'    => Mage::helper('thuvien')->__('Tên dịch giả'),
            'align'     =>'left',
            'width'     => '50px',
            'index'     => 'TenDichGia',
            'width' => '45%'
        ));

        $this->addColumn('position', array(
            'header'            => Mage::helper('catalog')->__('Position'),
            'name'              => 'position',
            'width'             => 60,
            'type'              => 'number',
            'validate_class'    => 'validate-number',
            'index'             => 'position',
            'editable'          => true,
            'edit_only'         => true
        ));

        return parent::_prepareColumns();
    }


    protected function _getSelectedDichgia()
    {
        $products = $this->getListDichgia();
        if (!is_array($products)) {
            $products = array_keys($this->getSelectedDichgia());
        }
        return $products;
    }

    /**
     * Retrieve related news
     *
     * @return array
     */
    public function getSelectedDichgia()
    {
        // Customer Data
        $tm_id = $this->getRequest()->getParam('id');
        if(!isset($tm_id)) {
            $tm_id = 0;
        }

        $dichgias = $this->getDichgia(); // This is hard-coded right now, but should actually get values from database.
        $dichGiaIds = array();

        foreach($dichgias as $row) {
            $dichGiaIds[$row->getData('MaListDG')] = array('position'=>0);
        }
        return $dichGiaIds;
    }


    protected function getDichgia()
    {
        $matpcom = $this->getRequest()->getParam('id');
        if (!isset($matpcom)) {
            $matpcom = 0;
        }
        try{
            $collection = Mage::getModel('thuvien/dichgia')->getCollection();
            $collection->getSelect()
                ->join(array('tg'=>'tpdichgia'),'tg.MaListDG=main_table.MaListDG',array())
                ->where('MaTpCom= '.$matpcom);
            return $collection;
        }catch(Exception $e)
        {
            echo $e->getMessage();die;
        }
        return $collection;
    }

    public function getGridUrl()
    {
        return $this->_getData('grid_url') ? $this->_getData('grid_url') : $this->getUrl('*/*/dichgiagrid', array('_current'=>true));
    }

}