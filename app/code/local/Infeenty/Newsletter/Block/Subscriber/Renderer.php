<?php


class Infeenty_Newsletter_Block_Subscriber_Renderer extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
	public function render(Varien_Object $row)
	{
		$idx = $this->getColumn()->getIndex();
		$data  =  $row->getData();
		if( $idx == 'customer_lastname' )
			if( empty($data['customer_lastname'])) 
				return $data['subscriber_lastname'];
			else
				return $data['customer_lastname'];
		elseif( $idx == 'customer_firstname' )
			if( empty($data['customer_firstname'])) 
				return $data['subscriber_firstname'];
			else
				return $data['customer_firstname'];
	}
}