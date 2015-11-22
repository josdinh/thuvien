<?php

class CV_Thuvien_Block_Adminhtml_Docgia_Edit_Tab_Lephi_Form extends Mage_Adminhtml_Block_Widget_Form
{
  protected function _prepareForm()
  {
      $form = new Varien_Data_Form();
      $this->setForm($form);
      $fieldset = $form->addFieldset('lephi_form', array('legend'=>Mage::helper('thuvien')->__('Thông tin Lệ phí')));
      $listLyDo = Mage::getModel('thuvien/lplydo')->getCollection();
      $lyDoArr = array();
      if($listLyDo->getSize()) {
          foreach($listLyDo->getData() as $key=>$value) {
              $lyDoArr[$value['MaLyDo']] = $value['LyDo'];
          }
      }

      $listGhichu = Mage::getModel('thuvien/lpghichu')->getCollection();
      $ghichuArr = array();
      if($listGhichu->getSize()) {
          foreach($listGhichu->getData() as $key=>$value) {
              $ghichuArr[$value['MaGhiChu']] = $value['GhiChu'];
          }
      }
      $fieldset->addField('SoTien','text',array(
          'label' => Mage::helper('thuvien')->__('Số Tiền'),
          'name' => 'SoTien',
          'style' => 'width:150px'
      ));

      $fieldset->addField('MaLyDo','select',array(
          'label' => Mage::helper('thuvien')->__('Lý Do'),
          'name' => 'MaLyDo',
          'values' => $lyDoArr,
      ));

    /*  $fieldset->addField('GhiChu', 'select', array(
          'label'     => Mage::helper('thuvien')->__('Ghi Chú'),
          'name'      => 'GhiChu',
          'values' => $ghichuArr,
      ));*/

      $fieldset->addField('NgayNhap', 'date', array(
          'label'     => Mage::helper('thuvien')->__('Ngày Nhập'),
          'name'      => 'NgayNhap',
          'time'        =>    false,
          'input_format'=>  $this->expiredDates(),
          'format'      =>  $this->expiredDates(),
          'image'       => $this->getSkinUrl('images/grid-cal.gif'),
          //'value'       => date( Mage::app()->getLocale()->getDateStrFormat(Mage_Core_Model_Locale::FORMAT_TYPE_SHORT))
      ));

       $fieldset->addField('HetHan', 'date', array(
           'label'     => Mage::helper('thuvien')->__('Hết Hạn'),
           'name'      => 'HetHan',
           'time'        =>    false,
           'input_format'=>  $this->expiredDates(),
           'format'      =>  $this->expiredDates(),
           'image'       => $this->getSkinUrl('images/grid-cal.gif'),
        ));


      $fieldset->addField('themlephi', 'button', array(
          'value' => 'Thêm lệ phí',
          'name' => 'themlephi',
          'onclick' => 'test()'
      ));

      if ( Mage::getSingleton('adminhtml/session')->getDocgiaData() )
      {
          $form->addValues(Mage::getSingleton('adminhtml/session')->getDocgiaData());
          Mage::getSingleton('adminhtml/session')->setDocgiaData(null);
      } elseif ( Mage::registry('docgia_data') ) {
          $form->addValues(Mage::registry('docgia_data')->getData());
      }
      return parent::_prepareForm();
  }

    private function expiredDates() {
        return "d-M-yyyy";//Mage::app()->getLocale()->getDateTimeFormat(Mage_Core_Model_Locale::FORMAT_TYPE_SHORT);
    }
}