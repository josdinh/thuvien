<?php

class CV_Thuvien_Block_Adminhtml_Tacphamcom_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
  protected function _prepareForm()
  {
      $form = new Varien_Data_Form();
      $this->setForm($form);
      $fieldset = $form->addFieldset('tpcom_form', array('legend'=>Mage::helper('thuvien')->__('Thông tin Tác Phẩm')));

      try {
          $config = Mage::getSingleton('cmspro/wysiwyg_config')->getConfig();
          $config->setData(Mage::helper('cmspro/data')->recursiveReplace(
                  '/thuvien/', '/' . (string) Mage::app()->getConfig()->getNode('admin/routers/adminhtml/args/frontName') . '/', $config->getData()
              )
          );
      } catch (Exception $ex) {
          $config = null;
      }

      $fieldset->addField('TenTacPham','text',array(
      	'label' => Mage::helper('thuvien')->__('Tên Tác Phẩm'),
      	'class' => 'required-entry',
      	'required' => true,
        'width'=>'100%',
      	//'onchange'=>'rendkey()',
      	'name' => 'TenTacPham'
      ));
      
      $fieldset->addField('NguyenTac','text',array(
      	'label' => Mage::helper('thuvien')->__('Nguyên tác'),
      	'name' => 'NguyenTac'
      ));
		
	  $fieldset->addField('PhuThem','text',array(
      	'label' => Mage::helper('thuvien')->__('Phụ đề'),
      	'name' => 'PhuThem'
      ));

      $fieldset->addField('TomLuoc','editor',array(
        'label' => Mage::helper('thuvien')->__('Tóm lược'),
      	'name' => 'TomLuoc',
        'config'    =>$config,
        'style'     => 'height:36em; width:700px;',
      ));

      $fieldset->addField('MucLuc','editor',array(
          'label' => Mage::helper('thuvien')->__('Mục Lục'),
          'name' => 'MucLuc',
          'config'    =>$config,
          'style'     => 'height:36em; width:700px;',


      ));

      $fieldset->addField('BanMem','file',array(
          'label' => Mage::helper('thuvien')->__('Bản mềm'),
          'name' => 'BanMem',
      ));

      $fieldset->addField('Hinh','image',array(
          'label' => Mage::helper('thuvien')->__('Hình Ảnh'),
          'name' => 'Hinh',
      ));

	  $theloai=Mage::helper('thuvien')->getDSTheLoai();
      $fieldset->addField('MaLoaiTacPham', 'select', array(
          'label'     => Mage::helper('thuvien')->__('Thể loại'),
          'name'      => 'MaLoaiTacPham',
		  'values'=>$theloai,          
      ));

      $ngonngu=Mage::helper('thuvien')->getDSNgonngu();
      $fieldset->addField('MaNgonNgu','select',array(
          'label' => Mage::helper('thuvien')->__('Ngôn ngữ'),
          'required' => true,
          'name' => 'MaNgonNgu',
          'values'=>$ngonngu,
      ));

      $listDDC=Mage::helper('thuvien')->getDsDDC();
	  $fieldset->addField('MaDDC', 'select', array(
          'label'     => Mage::helper('thuvien')->__('DCC'),
          'name'      => 'MaDDC',
          'values'=>$listDDC,
      ));

      $fieldset->addField('ISBN','text',array(
          'label' => Mage::helper('thuvien')->__('ISBN-ISSN'),
          'name' => 'ISBN'
      ));

      $fieldset->addField('TapSo','text',array(
          'label' => Mage::helper('thuvien')->__('Tập số'),                   
          'name' => 'TapSo'
      ));

      $sachbo=Mage::helper('thuvien')->getDSSachbo();
      $fieldset->addField('MaSachBo','select',array(
          'label' => Mage::helper('thuvien')->__('Sách bộ'),
          'name' => 'MaSachBo',
		  'values'=>$sachbo,
      ));

      $listTacGia=Mage::getModel('thuvien/tacgia')->getListTacGiaOptions();
      $fieldset->addField('MaKyHieuTg','select',array(
          'label' => Mage::helper('thuvien')->__('Tác giả chính'),
          'name' => 'MaKyHieuTg',
          'values'=>$listTacGia,
      ));


      $fieldset->addField('NoiBat','select',array(
          'label' => Mage::helper('thuvien')->__('Tác phẩm nổi bật'),
          'name' => 'NoiBat',
          'options'   => array(
              '1' => Mage::helper('cms')->__('Có'),
              '0' => Mage::helper('cms')->__('Không'),
          ),
      ));


      if ( Mage::getSingleton('adminhtml/session')->getTpcomData() )
      {
          $form->setValues(Mage::getSingleton('adminhtml/session')->getTpcomData());
          Mage::getSingleton('adminhtml/session')->setTpcomData(null);
      } elseif ( Mage::registry('tpcom_data') ) {
          $form->setValues(Mage::registry('tpcom_data')->getData());
      }
      return parent::_prepareForm();
  }
}