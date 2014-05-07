<?php

class Infeenty_Newsletter_Block_Adminhtml_Newsletter_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
  protected function _prepareForm()
  {
	  $form = new Varien_Data_Form(array(
									  'id' => 'edit_form',
									  'action' => $this->getUrl('*/*/save', array('form_id' => $this->getRequest()->getParam('form_id'))),
									  'method' => 'post',
									  'enctype' => 'multipart/form-data'
								   )
	  );

	  $form->setUseContainer(true);
	  $this->setForm($form);
	 // $this->setTemplate('infeenty/form.phtml');
	  return parent::_prepareForm();
  }
}