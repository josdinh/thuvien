<?php

class CV_Thuvien_Block_Adminhtml_Tacphamcom_Edit_Tab_Cungtacpham extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('cungtacpham_grid');
        $this->setUseAjax(true); // Using ajax grid is important
        $this->setDefaultSort('Tppopid');
        $this->setDefaultFilter(array('in_cungtacpham'=>1)); // By default we have added a filter for the rows, that in_products value to be 1
        $this->setSaveParametersInSession(false);  //Dont save paramters in session or else it creates problems
    }

    protected function _addColumnFilterToCollection($column)
    {
        // Set custom filter for in product flag
        if ($column->getId() == 'in_cungtacpham') {
            $cungtp = $this->_getSelectedCungtp();
            if (empty($cungtp)) {
                $cungtp = 0;
            }
            if ($column->getFilter()->getValue()) {
                $this->getCollection()->addFieldToFilter('Tppopid', array('in'=>$cungtp));
            } else {
                if($cungtp) {
                    $this->getCollection()->addFieldToFilter('Tppopid', array('nin'=>$cungtp));
                }
            }
        } else {
            parent::_addColumnFilterToCollection($column);
        }
        return $this;
    }


    protected function _prepareCollection()
    {
            $collection = Mage::getModel('thuvien/tppop')->getCollection();
            $collection->getSelect()
                ->joinLeft( array('tpnhaxb'=> 'tpnhaxb'), 'tpnhaxb.MaNhaXB = main_table.MaNhaXB', array('tpnhaxb.NhaXB'))
                ->joinLeft( array('tphientrang'=> 'tphientrang'), 'tphientrang.MaHienTrang = main_table.MaHienTrang', array('tphientrang.HienTrang'))
                ->joinLeft( array('tptinhtrang'=> 'tptinhtrang'), 'tptinhtrang.MaTinhTrang = main_table.MaTinhTrang', array('tptinhtrang.TinhTrang'))
                ->joinLeft( array('tplistkhosach'=> 'tplistkhosach'), 'tplistkhosach.MaKhoSach = main_table.MaKhoSach', array('tplistkhosach.KhoSach'));

            $this->setCollection($collection);
            return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn('in_cungtacpham', array(
            'header_css_class'  => 'a-center',
            'type'              => 'checkbox',
            'name'              => 'Tppopid',
            'values'            => $this->_getSelectedCungtp(),
            'align'             => 'center',
            'index'             => 'Tppopid'
        ));

        $this->addColumn('TMaTpPop', array(
            'header'    => Mage::helper('thuvien')->__('Mã tác phẩm'),
            'align'     =>'left',
            'width'     => '50px',
            'index'     => 'MaTpPop',

        ));

        $this->addColumn('BanSo', array(
            'header'    => Mage::helper('thuvien')->__('Bản'),
            'align'     =>'left',
            'width'     => '50px',
            'index'     => 'BanSo',
        ));

        $this->addColumn('NhaXB', array(
            'header'    => Mage::helper('thuvien')->__('Nhà Xuất Bản'),
            'align'     =>'right',
            'width'     => '50px',
            'index'     => 'NhaXB',
        ));

        $this->addColumn('NamXuatBan', array(
            'header'    => Mage::helper('thuvien')->__('Năm'),
            'align'     =>'right',
            'width'     => '50px',
            'index'     => 'NamXuatBan',
        ));

        $this->addColumn('SoTrang', array(
            'header'    => Mage::helper('thuvien')->__('Trang'),
            'align'     =>'left',
            'width'     => '50px',
            'index'     => 'SoTrang',
        ));

        $this->addColumn('Kho', array(
            'header'    => Mage::helper('thuvien')->__('Khổ'),
            'align'     =>'right',
            'width'     => '50px',
            'index'     => 'Kho',
        ));

        $this->addColumn('NgayNhap', array(
            'header'    => Mage::helper('thuvien')->__('Ngày Nhập'),
            'align'     =>'right',
            'width'     => '50px',
            'index'     => 'NgayNhap',
        ));

        $this->addColumn('GiaTien', array(
            'header'    => Mage::helper('thuvien')->__('Giá Tiền'),
            'align'     =>'right',
            'width'     => '50px',
            'index'     => 'GiaTien',
        ));

        $this->addColumn('TinhTrang', array(
            'header'    => Mage::helper('thuvien')->__('Tình Trạng'),
            'align'     =>'right',
            'width'     => '50px',
            'index'     => 'TinhTrang',
        ));

        $this->addColumn('HienTrang', array(
            'header'    => Mage::helper('thuvien')->__('Tác Phẩm'),
            'align'     =>'right',
            'width'     => '50px',
            'index'     => 'HienTrang',
        ));

        $this->addColumn('KhoSach', array(
            'header'    => Mage::helper('thuvien')->__('Kho'),
            'align'     =>'right',
            'width'     => '50px',
            'index'     => 'KhoSach',
        ));
        $this->addColumn('position', array(
            'header'            => Mage::helper('catalog')->__('Position'),
            'name'              => 'position',
            'width'             => 60,
            'type'              => 'hidden',
            'validate_class'    => 'validate-number',
            'index'             => 'position',
            'editable'          => true,
            'edit_only'         => true
        ));

        return parent::_prepareColumns();
    }


    protected function _getSelectedCungtp()
    {
        $products = $this->getListCungtp();
        if (!is_array($products)) {
            $products = array_keys($this->getSelectedCungtp());
        }
        return $products;
    }

    /**
     * Retrieve related news
     *
     * @return array
     */
    public function getSelectedCungtp()
    {
        $cungtp = $this->getCungtp(); // This is hard-coded right now, but should actually get values from database.
        $cungtpIds = array();

        foreach($cungtp as $row) {
            $cungtpIds[$row->getData('Tppopid')] = array('position'=>0);
        }
        return $cungtpIds;
    }


    protected function getCungtp()
    {
        $matpcom = $this->getRequest()->getParam('id');
        if (!isset($matpcom)) {
            $matpcom = 0;
        }
        try{
            $collection = Mage::getModel('thuvien/tppop')->getCollection();
            $collection->getSelect()->where('MaTpCom = '.$matpcom);
            return $collection;
        }catch(Exception $e)
        {
            echo $e->getMessage();die;
        }
        return $collection;
    }

    public function getGridUrl()
    {
        return $this->_getData('grid_url') ? $this->_getData('grid_url') : $this->getUrl('*/*/cungtpgrid', array('_current'=>true));
    }
    private function expiredDates() {
        return "d-M-yyyy";
    }

}