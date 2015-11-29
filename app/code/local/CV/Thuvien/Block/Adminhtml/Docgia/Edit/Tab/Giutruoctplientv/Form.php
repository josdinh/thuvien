<?php
class CV_Thuvien_Block_Adminhtml_Docgia_Edit_Tab_Giutruoctplientv_Form extends Mage_Adminhtml_Block_Widget_Form
{
  /*protected function _prepareForm()
  {
      $form = new Varien_Data_Form();
      $this->setForm($form);
      $fieldset = $form->addFieldset('docgia_muon_form', array('legend'=>Mage::helper('thuvien')->__('Giữ trước tác phẩm')));
      $maDocGia = $this->getRequest()->getParam('id');
      $fieldset->addField('MaSach','text',array(
          'label' => Mage::helper('thuvien')->__('Mã Sách'),
          'name' => 'SoTien',
          'style' => 'width:150px'
      ));

      $fieldset->addField('HanTra', 'date', array(
          'label'     => Mage::helper('thuvien')->__('Hạn trả'),
          'name'      => 'HanTra',
          "readonly" =>true,
          'time'        =>    false,
          'input_format'=>  $this->expiredDates(),
          'format'      =>  $this->expiredDates(),
          'image'       => $this->getSkinUrl('images/grid-cal.gif'),
      ));

      $muonUrl = Mage::helper("adminhtml")->getUrl("thuvien/adminhtml_muontra/muontpdocgia");
      $fieldset->addField('docgia_muon', 'button', array(
          'value' => 'Mượn',
          'name' => 'docgia_muon',
          'onclick' => 'muontp(\''.$muonUrl.'\','.$maDocGia.')',
          'style' => '123',
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
    }*/
}