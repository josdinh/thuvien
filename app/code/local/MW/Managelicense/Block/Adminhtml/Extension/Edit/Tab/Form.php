<?php

class MW_Managelicense_Block_Adminhtml_Extension_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
  protected function _prepareForm()
  {
      $form = new Varien_Data_Form();
      $this->setForm($form);
      $fieldset = $form->addFieldset('extension_form', array('legend'=>Mage::helper('managelicense')->__('Extension information')));
     
      
      
      $fieldset->addField('name','text',array(
      	'label' => Mage::helper('managelicense')->__('Name'),
      	'class' => 'required-entry',
      	'required' => true,
      	'name' => 'name'
      ));
      
      $fieldset->addField('key','text',array(
      	'label' => Mage::helper('managelicense')->__('Key'),
      	'class' => 'required-entry',
      	'required' => true,
      	'name' => 'key'
      ));
      
      $fieldset->addField('version','text',array(
      	'label' => Mage::helper('managelicense')->__('Version'),
      	'class' => 'required-entry',
      	'required' => true,
      	'name' => 'version'
      ));
      		
	 $fieldset->addField('sku','text',array(
      	'label' => Mage::helper('managelicense')->__('SKU'),
      	'class' => 'required-entry',
      	'required' => true,
      	'name' => 'sku'
      ));
      
      $fieldset->addField('url','text',array(
      	'label' => Mage::helper('managelicense')->__('Url'),
      	'class' => 'required-entry',
      	'required' => true,
      	'name' => 'url'
      ));
      		
      if ( Mage::getSingleton('adminhtml/session')->getManagelicenseData() )
      {
          $form->setValues(Mage::getSingleton('adminhtml/session')->getManagelicenseData());
          Mage::getSingleton('adminhtml/session')->setManagelicenseData(null);
      } elseif ( Mage::registry('managelicense_data') ) {
          $form->setValues(Mage::registry('managelicense_data')->getData());
      }
      return parent::_prepareForm();
  }
}