<?php

/**
 * Newsletter subscribe block
 *
 * @category   Mage
 * @package    Infeenty_Newsletter
 * @author     Vipan Kumar <vipan.webdeveloper@gmail.com>
 */

class Infeenty_Newsletter_Block_Subscribe extends Mage_Newsletter_Block_Subscribe implements Mage_Widget_Block_Interface 
{
	public function _construct() {
        parent::_construct(); 
        $this->setTemplate();
    }
	public function setTemplate(){
		$this->_template = 'infeenty/newsletter/subscribe.phtml';
		return $this;
	}
	public function getTitle(){
		return Mage::getStoreConfig('infeenty_newsletter/general/title');
	}
	public function getDescription(){
		return Mage::getStoreConfig('infeenty_newsletter/general/description');
	}
	public function getFields(){
		$fields = array(
			'subscriber_firstname' => array('label'=>'First Name', 'type'=>'text', 'class' =>'required-entry'),
			'subscriber_lastname' => array('label'=>'Last Name', 'type'=>'text', 'class' =>'required-entry'),
			'email' => array('label'=>'Email', 'type'=>'text', 'class' =>'required-entry validate-email')
		);
		return $fields;
	}
	private function getConfig($path){
	
		return Mage::getStoreConfig(
				$path, 
				Mage::app()->getStore()->getId()
			);
	}
	protected function isSubscribed(){
		return (bool)Mage::getSingleton('core/session')->getUserSubscribe();
	}
	protected function isOnload(){
		return (bool)$this->getConfig('infeenty_newsletter/general/onstartup');

	}
}
