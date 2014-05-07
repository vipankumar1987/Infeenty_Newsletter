<?php
/**
 * Subscriber model
 *
 * @method Mage_Newsletter_Model_Resource_Subscriber _getResource()
 * @method Mage_Newsletter_Model_Resource_Subscriber getResource()
 * @method int getStoreId()
 * @method Mage_Newsletter_Model_Subscriber setStoreId(int $value)
 * @method string getChangeStatusAt()
 * @method Mage_Newsletter_Model_Subscriber setChangeStatusAt(string $value)
 * @method int getCustomerId()
 * @method Mage_Newsletter_Model_Subscriber setCustomerId(int $value)
 * @method string getSubscriberEmail()
 * @method Mage_Newsletter_Model_Subscriber setSubscriberEmail(string $value)
 * @method int getSubscriberStatus()
 * @method Mage_Newsletter_Model_Subscriber setSubscriberStatus(int $value)
 * @method string getSubscriberConfirmCode()
 * @method Mage_Newsletter_Model_Subscriber setSubscriberConfirmCode(string $value)
 *
 * @category    Mage
 * @package     Mage_Newsletter
 * @author      Magento Core Team <core@magentocommerce.com>
 */
class Infeenty_Newsletter_Model_Mysql4_Newsletterform_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
	public function _construct(){
		//parent::_construct();
		$this->_init('infeentynewsletter/newsletterform');
	}
}
