<?php
class Infeenty_Newsletter_Block_Adminhtml_Newsletter extends Mage_Adminhtml_Block_Widget_Grid_Container{
	
  public function _construct()
  {
    parent::_construct();
    $this->_controller = 'adminhtml_newsletter';
    $this->_blockGroup = 'infeentynewsletter';
    $this->_headerText = Mage::helper('newsletter')->__('Newsletter Forms');
    $this->_addButtonLabel = Mage::helper('newsletter')->__('Add Form');
  }
}