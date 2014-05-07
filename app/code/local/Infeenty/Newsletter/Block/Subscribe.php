<?php

/**
 * Newsletter subscribe block
 *
 * @category   Mage
 * @package    Infeenty_Newsletter
 * @author     Vipan Kumar <vipan.webdeveloper@gmail.com>
 */

class Infeenty_Newsletter_Block_Subscribe extends Mage_Newsletter_Block_Subscribe
{
	public function _construct() {
        parent::_construct(); 
        $this->setTemplate('infeenty/newsletter/subscribe.phtml');  
    }
	public function getFields(){
		$fields = array(
			'subscriber_firstname' => array('label'=>'First Name', 'type'=>'text', 'class' =>'required-entry'),
			'subscriber_lastname' => array('label'=>'Last Name', 'type'=>'text', 'class' =>'required-entry'),
			'email' => array('label'=>'Email', 'type'=>'text', 'class' =>'required-entry validate-email')
		);
		return $fields;
	}
}
