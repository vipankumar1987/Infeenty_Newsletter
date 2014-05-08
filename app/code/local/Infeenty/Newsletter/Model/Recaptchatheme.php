<?php

class Infeenty_Newsletter_Model_Recaptchatheme extends Varien_Object
{
    static public function toOptionArray()
    {
        return array(
            1     		=> Mage::helper('newsletter')->__('Red'),
            2   		=> Mage::helper('newsletter')->__('White'),
            3    => Mage::helper('newsletter')->__('Blackglass'),
            4   		=> Mage::helper('newsletter')->__('Clean')
        );
    }
}