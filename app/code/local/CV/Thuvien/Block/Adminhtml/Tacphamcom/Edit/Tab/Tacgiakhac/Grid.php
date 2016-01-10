<?php

class CV_Thuvien_Block_Adminhtml_Tacphamcom_Edit_Tab_Tacgiakhac_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('tacgiakhacGrid');
        $this->setDefaultSort('MaListTG');
        $this->setDefaultDir('DESC');
        $this->setUseAjax(true);
        $this->setSaveParametersInSession(false);
        if($this->getRequest()->getParam('id')) {
            $this->setDefaultFilter(array('in_tgkhac' => 1));
        }
    }

    protected function _addColumnFilterToCollection($column)
    {
        // Set custom filter for in news flag
        if ($column->getId() == 'in_tgkhac')
        {
            $tgIds = $this->_getSelectedTacgiakhac();
            if (empty($tgIds)) {
                $tgIds = 0;
            }
            if ($column->getFilter()->getValue()) {
                $this->getCollection()->addFieldToFilter('MaListTG', array('in' => $tgIds));
            }else{
                $this->getCollection()->addFieldToFilter('MaListTG', array('nin' => $tgIds));
            }
        } else {
            parent::_addColumnFilterToCollection($column);
        }
        return $this;
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('thuvien/tacgia')->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {

        $this->addColumn('in_tgkhac', array(
            'header_css_class'  => 'a-center',
            'type'              => 'checkbox',
            'name'              => 'in_tgkhac',
            'values'            => $this->_getSelectedTacgiakhac(),
            'align'             => 'center',
            'index'             => 'MaListTG'
        ));

        $this->addColumn('MaListTG', array(
            'header'    => Mage::helper('thuvien')->__('Mã tác giả'),
            'align'     =>'left',
            'width'     => '50px',
            'index'     => 'MaListTG',
            'name' => 'MaListTG',
            'width' => '10%'
        ));

        $this->addColumn('TenTacGia', array(
            'header'    => Mage::helper('thuvien')->__('Tên tác giả'),
            'align'     =>'left',
            'width'     => '50px',
            'index'     => 'TenTacGia',
            'width' => '45%'
        ));

        $this->addColumn('KyHieuTg', array(
            'header'    => Mage::helper('thuvien')->__('Ký hiệu tác giả'),
            'align'     =>'left',
            'width'     => '50px',
            'index'     => 'KyHieuTg',
            'width' => '45%'
        ));

        $this->addColumn('position', array(
            'header'            => Mage::helper('thuvien')->__('Position'),
            'name'              => 'position',
            'type'              => 'number',
            'validate_class'    => 'validate-number',
            'index'             => 'position',
            'width'             => '0px',
            'editable'          => true,
            //'edit_only'         => !$this->_getProduct()->getId()
        ));

        return parent::_prepareColumns();
    }


    protected function _getSelectedTacgiakhac()
    {
        $news = $this->getListTG();

        if (!is_array($news)) {
            $news = array_keys($this->getSelectedTacgiakhac());
        }
        return $news;
    }

    /**
     * Retrieve related news
     *
     * @return array
     */
    public function getSelectedTacgiakhac()
    {
        $tg = array();

        if(!Mage::registry("tacphamcom_tacgiakhac")){
            $colRelated = $this->getTacgiakhac();
            //Zend_Debug::dump($colRelated);die;
            Mage::register("tacphamcom_tacgiakhac", $colRelated);
        }
        foreach (Mage::registry("tacphamcom_tacgiakhac") as $row) {
            $tg[$row->getData('MaListTG')] =  array('position' => $row->getData('position'));
        }

        return $tg;
    }

    protected function getTacgiakhac()
    {
        $matpcom = $this->getRequest()->getParam('id');
        if ($matpcom) {
            try{
                $collection = Mage::getModel('thuvien/tacgia')->getCollection();
                $collection->getSelect()
                    ->join(array('tg'=>'tptacgia'),'tg.MaListTG=main_table.MaListTG',array())
                    ->where('MaTpCom= '.$matpcom);
                return $collection;
            }catch(Exception $e)
            {
                echo $e->getMessage();die;
            }
            return $collection;
        }
        else {
            try{
                $collection = Mage::getModel('thuvien/tacgia')->getCollection();
                $collection->getSelect()
                    ->join(array('tg'=>'tptacgia'),'tg.MaListTG=main_table.MaListTG',array())
                    ->where('MaTpCom= 0');
            }catch(Exception $e)
            {
                echo $e->getMessage();die;
            }
            return $collection;
        }

    }

    protected function _prepareMassaction()
    {
        return $this;
    }

    public function getGridUrl()
    {
        return $this->_getData('grid_url') ? $this->_getData('grid_url') : $this->getUrl('*/*/tacgiakhacgrid', array('_current'=>true));
    }



}