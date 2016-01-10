<?php

class CV_Thuvien_Block_Adminhtml_Tacpham_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
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

      $fieldset->addField('MaTpPop','text',array(
          'label' => Mage::helper('thuvien')->__('Mã tác phẩm'),
          'class' => 'required-entry',
          'required' => true,
          'readonly' => true,
          'name' => 'MaTpPop'
      ));

      $fieldset->addField('TenTacPham','text',array(
      	'label' => Mage::helper('thuvien')->__('Tên Tác Phẩm'),
      	'readonly' => true,
      	'name' => 'TenTacPham'
      ));

      $fieldset->addField('BanSo','text',array(
          'label' => Mage::helper('thuvien')->__('Bản Số'),
          'class' => 'required-entry',
          'required' => true,
          'name' => 'BanSo'
      ));

      $nhaXB = Mage::helper('thuvien')->getListNhaXB();
      $fieldset->addField('MaNhaXB','select',array(
          'label' => Mage::helper('thuvien')->__('Nhà XB'),
          'class' => 'required-entry',
          'required' => true,
          'name' => 'MaNhaXB',
          'values' => $nhaXB
      ));

      $fieldset->addField('NamXB','text',array(
          'label' => Mage::helper('thuvien')->__('Năm XB'),
          'class' => '',
          'required' => false,
          'name' => 'NamXB'
      ));

      $fieldset->addField('SoTrang','text',array(
          'label' => Mage::helper('thuvien')->__('Số Trang'),
          'class' => '',
          'required' => false,
          'name' => 'SoTrang'
      ));

      $fieldset->addField('Kho','text',array(
          'label' => Mage::helper('thuvien')->__('Khổ'),
          'class' => '',
          'required' => false,
          'name' => 'Kho'
      ));

      $fieldset->addField('NgayNhap', 'date', array(
          'label'     => Mage::helper('thuvien')->__('Ngày Nhập'),
          'name'      => 'NgayNhap',
          'time'        =>    false,
          "readonly" =>true,
          'input_format'=>  $this->expiredDates(),
          'format'      =>  $this->expiredDates(),
          'image'       => $this->getSkinUrl('images/grid-cal.gif'),
          'class' => 'required-entry',
          'required' => true
          //'value'       => date( Mage::app()->getLocale()->getDateStrFormat(Mage_Core_Model_Locale::FORMAT_TYPE_SHORT))
      ));

      $fieldset->addField('GiaTien','text',array(
          'label' => Mage::helper('thuvien')->__('Giá Tiền'),
          'class' => '',
          'required' => false,
          'name' => 'GiaTien'
      ));

      $fieldset->addField('DonVi','text',array(
          'label' => Mage::helper('thuvien')->__('Đơn vị'),
          'class' => '',
          'required' => false,
          'name' => 'DonVi'
      ));

      $hientrang = Mage::helper('thuvien')->getListHienTrang();
      $fieldset->addField('MaHienTrang','select',array(
          'label' => Mage::helper('thuvien')->__('Hiện trạng'),
          'class' => 'required-entry',
          'required' => true,
          'name' => 'MaHienTrang',
          'values' => $hientrang
      ));

      $tinhtrang = Mage::helper('thuvien')->getListTinhTrang();
      $fieldset->addField('MaTinhTrang','select',array(
          'label' => Mage::helper('thuvien')->__('Tình trạng'),
          'class' => 'required-entry',
          'required' => true,
          'name' => 'MaTinhTrang',
          'values' => $tinhtrang
      ));

      $khosach = Mage::helper('thuvien')->getListKhoSach();
      $fieldset->addField('MaKhoSach','select',array(
          'label' => Mage::helper('thuvien')->__('Kho Sách'),
          'class' => 'required-entry',
          'required' => true,
          'name' => 'MaKhoSach',
          'values' => $khosach
      ));


      if ( Mage::getSingleton('adminhtml/session')->getTppopData() )
      {
          $form->setValues(Mage::getSingleton('adminhtml/session')->getTppopData());
          Mage::getSingleton('adminhtml/session')->setTppopData(null);
      } elseif ( Mage::registry('tppop_data') ) {
          $form->setValues(Mage::registry('tppop_data')->getData());
      }
      return parent::_prepareForm();
  }

  private function expiredDates() {
        return "d-M-yyyy";//Mage::app()->getLocale()->getDateTimeFormat(Mage_Core_Model_Locale::FORMAT_TYPE_SHORT);
  }
}