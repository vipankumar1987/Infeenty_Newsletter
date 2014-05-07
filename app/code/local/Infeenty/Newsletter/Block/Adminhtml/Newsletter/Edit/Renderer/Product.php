<?php

class Easyshop_Slider_Block_Adminhtml_Slider_Edit_Renderer_Product extends Mage_Adminhtml_Block_Abstract implements Varien_Data_Form_Element_Renderer_Interface {

	
	public function _construct(){
        parent::_construct();

        $this->setTemplate('slider/edit/tabs.phtml');
    }

	public function render( Varien_Data_Form_Element_Abstract $element ){
		$this->assign('product_id', $element->getValue() );
		
		$product_name = $qty = $price = 'Please Select a Product First.';
		$product_found = false;
		if( $element->getValue() > 0 ){
			$model = Mage::getModel('catalog/product')->load( $element->getValue( ) );
			if( strlen( $model->getName() ) > 0 ){
				$helper = Mage::helper('core');
				$product_name  = $model->getName();
				$product_found = true;
				$price         = $helper->currency( $model->getFinalPrice());
				$qty = round( Mage::getModel('cataloginventory/stock_item')->loadByProduct($model)->getQty(),2);
			}
		}
		$this->assign('product_found', $product_found );
		$this->assign( 'product_name' , $product_name );
		$this->assign('price', $price );
		$this->assign('qty', $qty );
		return $this->toHtml();
	}
}