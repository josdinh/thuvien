<?php

class CV_Thuvien_Block_Adminhtml_Luuky_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $this->setForm($form);
        $fieldset = $form->addFieldset('luuky_form', array('legend'=>Mage::helper('thuvien')->__('Lưu ký và đề nghị')));

        $fieldset->addField('NguoiViet','text',array(
            'label' => Mage::helper('thuvien')->__('Người viết'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'NguoiViet',
        ));

        $fieldset->addField('NgayViet', 'date', array(
            'label'     => Mage::helper('thuvien')->__('Ngày viết'),
            'name'      => 'NgayViet',
            'time'        =>    false,
            "readonly" =>true,
            'input_format'=>  $this->expiredDates(),
            'format'      =>  $this->expiredDates(),
            'image'       => $this->getSkinUrl('images/grid-cal.gif'),
        ));

        $fieldset->addField('NoiDung','textarea',array(
            'label' => Mage::helper('thuvien')->__('Nội dung'),
            'name' => 'NoiDung'
        ));

        if ( Mage::getSingleton('adminhtml/session')->getNoiDungData() )
        {
            $form->setValues(Mage::getSingleton('adminhtml/session')->getNoiDungData());
            Mage::getSingleton('adminhtml/session')->setNoiDungData(null);
        } elseif ( Mage::registry('luuky_data') ) {
            $form->setValues(Mage::registry('luuky_data')->getData());
        }
        return parent::_prepareForm();
    }

    private function expiredDates() {
        return "d-M-yyyy";
    }
}