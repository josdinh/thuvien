<?php

class MW_Managelicense_Block_Adminhtml_Managelicense_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
  protected function _prepareForm()
  {
      $form = new Varien_Data_Form();
      $this->setForm($form);
      $fieldset = $form->addFieldset('managelicense_form', array('legend'=>Mage::helper('managelicense')->__('License information')));
     
      $fieldset->addField('order_id', 'text', array(
          'label'     => Mage::helper('managelicense')->__('Order Id'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'order_id',
      ));
            
      $fieldset->addField('extension','text',array(
      	'label' => Mage::helper('managelicense')->__('Extension'),
      	'class' => 'required-entry',
      	'required' => true,
      	//'onchange'=>'rendkey()',
      	'name' => 'extension'
      ));
      
      $fieldset->addField('email','text',array(
      	'label' => Mage::helper('managelicense')->__('Email'),
      	'class' => 'required-entry',
      	'required' => true,
      	'name' => 'email'
      ));
      
      $fieldset->addField('magento_url','text',array(
      	'label' => Mage::helper('managelicense')->__('Magento Url'),
      	'class' => 'required-entry',
      	'required' => true,
      //	'onchange'=>'rendkey()',
      	'name' => 'magento_url'
      ));
     
        $fieldset->addField('comment', 'text', array(
          'name'      => 'comment',
          'label'     => Mage::helper('managelicense')->__('Comment'),
          'required'  => false,
      ));
      
      $fieldset->addField('status', 'select', array(
          'label'     => Mage::helper('managelicense')->__('Status'),
          'name'      => 'status',
      	//  'onchange' =>'rendkey()',
          'values'    => array(
              
              
               array(
                  'value'     => 0,
                  'label'     => Mage::helper('managelicense')->__('Closed'),
              ),
              
               array(
                  'value'     => 3,
                  'label'     => Mage::helper('managelicense')->__('Trial'),
              ),
              
              array(
                  'value'     => 1,
                  'label'     => Mage::helper('managelicense')->__('Pending'),
              ),

              array(
                  'value'     => 2,
                  'label'     => Mage::helper('managelicense')->__('Activated'),
              ),
          ),
      ));
      
       $fieldset->addField('key_active', 'text', array(         
          'label'     => Mage::helper('managelicense')->__('Key activate'),   
       	  'name'=>'key_active',
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