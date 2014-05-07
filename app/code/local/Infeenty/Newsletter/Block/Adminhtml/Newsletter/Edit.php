<?php

class Infeenty_Newsletter_Block_Adminhtml_Newsletter_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
                 
        $this->_objectId = 'form_id';
        $this->_blockGroup = 'infeentynewsletter';
        $this->_controller = 'adminhtml_newsletter';
        
        $this->_updateButton('save', 'label', Mage::helper('newsletter')->__('Save Form'));
        $this->_updateButton('delete', 'label', Mage::helper('newsletter')->__('Delete Form'));
		
        $this->_addButton('saveandcontinue', array(
            'label'     => Mage::helper('adminhtml')->__('Save And Continue Edit'),
            'onclick'   => 'saveAndContinueEdit()',
            'class'     => 'save',
        ), -100);
    }
	protected function _prepareLayout() {
		parent::_prepareLayout();
/*		if (Mage::getSingleton('cms/wysiwyg_config')->isEnabled()) {
			$this->getLayout()->getBlock('head')->setCanLoadTinyMce(true);
		}
*/	}


    public function getHeaderText()
    {
        if( Mage::registry('newsletter_data') && Mage::registry('newsletter_data')->getFormId() ) {
            return Mage::helper('newsletter')->__("Edit newsletter '%s'", $this->htmlEscape(Mage::registry('newsletter_data')->getFormTitle()));
        } else {
            return Mage::helper('newsletter')->__('Add newsletter');
        }
    }
}