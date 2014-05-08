<?php

/**
 * Newsletter subscribe block
 *
 * @category   Mage
 * @package    Infeenty_Newsletter
 * @author     Vipan Kumar <vipan.webdeveloper@gmail.com>
 */

class Infeenty_Newsletter_Block_Subscriber_Grid extends Mage_Adminhtml_Block_Newsletter_Subscriber_Grid
{
    /**
     * Constructor
     *
     * Set main configuration of grid
     */
    public function __construct()
    {
        parent::__construct();
        $this->setId('subscriberGrid_Infeenty');
        $this->setUseAjax(true);
        $this->setDefaultSort('subscriber_id', 'desc');
    }
	protected function _prepareColumns(){
		parent::_prepareColumns();
		
		$this->addColumn('firstname', array(
            'header'    => Mage::helper('newsletter')->__('First Name'),
            'index'     => 'customer_firstname',
			'renderer'  => 'Infeenty_Newsletter_Block_Subscriber_Renderer',
            'default'   =>    '----'
        ));

        $this->addColumn('lastname', array(
            'header'    => Mage::helper('newsletter')->__('Last Name'),
            'index'     => 'customer_lastname', //
			'renderer'  => 'Infeenty_Newsletter_Block_Subscriber_Renderer',
            'default'   =>    '----'
        ));		
	}
}
