<?php
#require_once 'Mage/Newsletter/controllers/SubscriberController.php';
class Infeenty_Newsletter_Adminhtml_CustomfieldsController extends Mage_Adminhtml_Controller_Action
{
	protected function _initAction() {
		$this->loadLayout()
			->_setActiveMenu('newsletter')
			->_title($this->__('Newsletter'))->_title($this->__('Manage Forms'))
			->_addBreadcrumb(Mage::helper('newsletter')->__('Newsletter Forms'), Mage::helper('newsletter')->__('Manage Forms'));
		
		return $this;
	}   
	public function indexAction() {
		$this->_initAction()
			->renderLayout();
	}
	protected function getModel($type, $id=''){
		return Mage::getModel($type)->load($id);
	}
	public function editAction(){
		$id = $this->getRequest()->getParam('form_id');
		$newsletterform = $this->getModel('infeentynewsletter/newsletterform', $id);
		
		if( $newsletterform->getFormId() || $id == 0 ){
			
			$action = $id == 0 ? 'New' : 'Edit';
			
			$data = Mage::getSingleTon('adminhtml/session')->getFormData(true);
			
			if (!empty($data)) {
				$newsletterform->setData($data);
			}
			
			Mage::register('newsletter_data', $newsletterform);
			$this->loadLayout()
				->_setActiveMenu('newsletter/customfields')
				->_title($this->__('Newsletter'))
				->_title($this->__('Custom fields'))
				->_title($this->__($action.' - Form'))
				->_addBreadCrumb($this->__('Newsletter'),$this->__('Custom fields'),$this->__($action.' - Form'))
				->_addContent($this->getLayout()->createBlock('infeentynewsletter/adminhtml_newsletter_edit'))
				->_addLeft($this->getLayout()->createBlock('infeentynewsletter/adminhtml_newsletter_edit_tabs'))
				->getLayout()
				->getBlock('head')
				->setCanLoadExtJs(true);
			$this->renderLayout();
			
		}
	}
	public function newAction(){
		$this->_forward('edit');
	}
}