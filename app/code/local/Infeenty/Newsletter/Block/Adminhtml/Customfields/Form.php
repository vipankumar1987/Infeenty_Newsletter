<?php

class Infeenty_Newsletter_Block_Adminhtml_Customfields_Form extends Mage_Adminhtml_Block_Widget_Form
{
  protected function _prepareForm()
  {
      $form = new Varien_Data_Form();
      $this->setForm($form);
      $fieldset = $form->addFieldset('manage_fields_form', array('legend'=>Mage::helper('newsletter')->__('Manage Fields')));
//Varien_Data_Form_Element_Fieldset
	
	
      $fieldset->addField('form_title', 'text', array(
          'label'     => Mage::helper('newsletter')->__('Title'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'form_title',
      ));
      $fieldset->addField('form_name', 'text', array(
          'label'     => Mage::helper('newsletter')->__('Title'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'form_name',
      ));
    
      $fieldset->addField('enabled', 'select', array(
          'label'     => Mage::helper('newsletter')->__('Status'),
          'name'      => 'enabled',
          'values'    => array(
              array(
                  'value'     => 1,
                  'label'     => Mage::helper('newsletter')->__('Enabled'),
              ),

              array(
                  'value'     => 2,
                  'label'     => Mage::helper('newsletter')->__('Disabled'),
              ),
          ),
      ));
	  
      if ( Mage::getSingleton('adminhtml/session')->getNewsletterData() )
      {
          $form->setValues(Mage::getSingleton('adminhtml/session')->getNewsletterData());
          Mage::getSingleton('adminhtml/session')->setNewsletterData(null);
      } elseif ( Mage::registry('newsletter_data') ) {
          $form->setValues(Mage::registry('newsletter_data')->getData());
      }
      return parent::_prepareForm();
  }
}