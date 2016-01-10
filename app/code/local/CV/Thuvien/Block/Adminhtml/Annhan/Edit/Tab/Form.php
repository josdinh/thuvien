<?php

class CV_Thuvien_Block_Adminhtml_Annhan_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $this->setForm($form);
        $fieldset = $form->addFieldset('annhan_form', array('legend'=>Mage::helper('thuvien')->__('Ân nhân thư viện')));

        $fieldset->addField('ChucVi','text',array(
            'label' => Mage::helper('thuvien')->__('Chức vị'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'ChucVi',
        ));

        $fieldset->addField('HoVaTen','text',array(
            'label' => Mage::helper('thuvien')->__('Họ và tên'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'HoVaTen'
        ));

        $fieldset->addField('DiaChi1','text',array(
            'label' => Mage::helper('thuvien')->__('Địa chỉ'),
            'name' => 'DiaChi1'
        ));

        $fieldset->addField('DiaChi2','text',array(
            'label' => Mage::helper('thuvien')->__('Phường-Quận'),
            'name' => 'DiaChi2'
        ));
        $listTp = Mage::helper('thuvien')->getListTp();
        $fieldset->addField('ThanhPho','select',array(
            'label' => Mage::helper('thuvien')->__('Thành Phố'),
            'name' => 'ThanhPho',
            'values'    => $listTp
        ));

        $fieldset->addField('DienThoai', 'text', array(
            'label'     => Mage::helper('thuvien')->__('Điện Thoại'),
            'name'      => 'DienThoai',

        ));
        $fieldset->addField('Email', 'text', array(
            'label'     => Mage::helper('thuvien')->__('Email'),
            'name'      => 'Email',
        ));

        $fieldset->addField('Giup', 'text', array(
            'label'     => Mage::helper('thuvien')->__('Giúp đỡ'),
            'name'      => 'Giup',
        ));

        $fieldset->addField('GhiChu', 'textarea', array(
            'label'     => Mage::helper('thuvien')->__('Ghi chú'),
            'name'      => 'GhiChu',
        ));


        if ( Mage::getSingleton('adminhtml/session')->getAnnhanData() )
        {
            $form->setValues(Mage::getSingleton('adminhtml/session')->getAnnhanData());
            Mage::getSingleton('adminhtml/session')->setAnnhanData(null);
        } elseif ( Mage::registry('annhan_data') ) {
            $form->setValues(Mage::registry('annhan_data')->getData());
        }
        return parent::_prepareForm();
    }
}