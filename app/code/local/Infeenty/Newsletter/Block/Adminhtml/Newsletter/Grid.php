<?php

class Infeenty_Newsletter_Block_Adminhtml_Newsletter_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
  public function _construct()
  {
	  parent::_construct();
	  $this->setId('newsletterGrid');
	  $this->setDefaultSort('form_id');
	  $this->setDefaultDir('ASC');
	  $this->setSaveParametersInSession(true);
  }

  protected function _prepareCollection()
  {
	  $collection = Mage::getModel('infeentynewsletter/newsletterform')->getCollection();
	  $this->setCollection($collection);
	  return parent::_prepareCollection();
  }

  protected function _prepareColumns()
  {
	  $this->addColumn('form_id', array(
		  'header'    => Mage::helper('newsletter')->__('ID'),
		  'align'     =>'right',
		  'width'     => '50px',
		  'index'     => 'form_id',
	  ));
	  $this->addColumn('form_name', array(
		  'header'    => Mage::helper('newsletter')->__('Name'),
		  'align'     =>'right',
		  'width'     => '50px',
		  'index'     => 'form_name',
	  ));

	  $this->addColumn('form_title', array(
		  'header'    => Mage::helper('newsletter')->__('Title'),
		  'align'     =>'left',
		  /*'renderer' => 'slider/adminhtml_widget_grid_column_renderer_inline',*/
		  'index'     => 'form_title',
	  ));

	  /*
	  $this->addColumn('content', array(
			'header'    => Mage::helper('slider')->__('Item Content'),
			'width'     => '150px',
			'index'     => 'content',
	  ));
	  */

	  $this->addColumn('enabled', array(
		  'header'    => Mage::helper('newsletter')->__('Status'),
		  'align'     => 'left',
		  'width'     => '80px',
		  'index'     => 'enabled',
		  'type'      => 'options',
		  'options'   => array(
			  1 => 'Enabled',
			  2 => 'Disabled',
		  ),
	  ));
	  
		$this->addColumn('action',
			array(
				'header'    =>  Mage::helper('newsletter')->__('Action'),
				'width'     => '100',
				'type'      => 'action',
				'getter'    => 'getId',
				'actions'   => array(
					array(
						'caption'   => Mage::helper('newsletter')->__('Edit'),
						'url'       => array('base'=> '*/*/edit'),
						'field'     => 'form_id'
					)
				),
				'filter'    => false,
				'sortable'  => false,
				'index'     => 'stores',
				'is_system' => true,
		));
		
		$this->addExportType('*/*/exportCsv', Mage::helper('newsletter')->__('CSV'));
		$this->addExportType('*/*/exportXml', Mage::helper('newsletter')->__('XML'));
	  
	  return parent::_prepareColumns();
  }

	protected function _prepareMassaction()
	{
		$this->setMassactionIdField('form_id');
		$this->getMassactionBlock()->setFormFieldName('newsletter');

		$this->getMassactionBlock()->addItem('delete', array(
			 'label'    => Mage::helper('newsletter')->__('Delete'),
			 'url'      => $this->getUrl('*/*/massDelete'),
			 'confirm'  => Mage::helper('newsletter')->__('Are you sure?')
		));

		$statuses = Mage::getSingleton('infeentynewsletter/status')->getOptionArray();

		array_unshift($statuses, array('label'=>'', 'value'=>''));
		$this->getMassactionBlock()->addItem('status', array(
			 'label'=> Mage::helper('newsletter')->__('Change status'),
			 'url'  => $this->getUrl('*/*/massStatus', array('_current'=>true)),
			 'additional' => array(
					'visibility' => array(
						 'name' => 'status',
						 'type' => 'select',
						 'class' => 'required-entry',
						 'label' => Mage::helper('newsletter')->__('Status'),
						 'values' => $statuses
					 )
			 )
		));
		return $this;
	}

  public function getRowUrl($row)
  {
	  return $this->getUrl('*/*/edit', array('form_id' => $row->getFormId()));
  }

}