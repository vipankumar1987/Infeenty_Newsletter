<?php

class Infeenty_Newsletter_Block_Recaptcha_Red extends Mage_Adminhtml_Block_System_Config_Form_Field
{
    protected function _getElementHtml(Varien_Data_Form_Element_Abstract $element)
    {
		return "<img src='https://developers.google.com/recaptcha/images/reCAPTCHA_Sample_Red.png'/>";
	}
}