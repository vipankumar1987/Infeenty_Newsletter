<?php

class Infeenty_Newsletter_Block_Adminhtml_Newsletter_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

  public function __construct()
  {
      parent::__construct();
      $this->setId('newsletter_tabs');
      $this->setDestElementId('edit_form');
      $this->setTitle(Mage::helper('newsletter')->__('Form Information'));
  }

  protected function _beforeToHtml()
  {
     $this->addTab('basic_information', array(
          'label'     => Mage::helper('newsletter')->__('Form Information'),
          'title'     => Mage::helper('newsletter')->__('Form Information'),
          'content'   => $this->getLayout()->createBlock('infeentynewsletter/adminhtml_newsletter_edit_tab_form')->toHtml(),
      ));
	  $this->addTab('field_configuration', array(
         'label'     => Mage::helper('newsletter')->__('Fields'),
         'title'     => Mage::helper('newsletter')->__('Fields'),
         'content'   => $this->getLayout()->createBlock('infeentynewsletter/adminhtml_customfields_form')->toHtml(),
      ));
      return parent::_beforeToHtml();
  }
}