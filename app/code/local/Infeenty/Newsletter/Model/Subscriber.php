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
class Infeenty_Newsletter_Model_Subscriber extends Mage_Newsletter_Model_Subscriber
{
    public function subscribe($email, $fname='', $lname='')
    {
        $this->loadByEmail($email);
        $customerSession = Mage::getSingleton('customer/session');

        if(!$this->getId()) {
            $this->setSubscriberConfirmCode($this->randomSequence());
        }

        $isConfirmNeed   = (Mage::getStoreConfig(self::XML_PATH_CONFIRMATION_FLAG) == 1) ? true : false;
        $isOwnSubscribes = false;
        $ownerId = Mage::getModel('customer/customer')
            ->setWebsiteId(Mage::app()->getStore()->getWebsiteId())
            ->loadByEmail($email)
            ->getId();
        $isSubscribeOwnEmail = $customerSession->isLoggedIn() && $ownerId == $customerSession->getId();

        if (!$this->getId() || $this->getStatus() == self::STATUS_UNSUBSCRIBED
            || $this->getStatus() == self::STATUS_NOT_ACTIVE
        ) {
            if ($isConfirmNeed === true) {
                // if user subscribes own login email - confirmation is not needed
                $isOwnSubscribes = $isSubscribeOwnEmail;
                if ($isOwnSubscribes == true){
                    $this->setStatus(self::STATUS_SUBSCRIBED);
                } else {
                    $this->setStatus(self::STATUS_NOT_ACTIVE);
                }
            } else {
                $this->setStatus(self::STATUS_SUBSCRIBED);
            }
            $this->setSubscriberEmail($email);
        }

        if ($isSubscribeOwnEmail) {
            $this->setStoreId($customerSession->getCustomer()->getStoreId());
            $this->setCustomerId($customerSession->getCustomerId());
        } else {
            $this->setStoreId(Mage::app()->getStore()->getId());
            $this->setCustomerId(0);
			$this->setSubscriberFirstname($fname);
			$this->setSubscriberLastname($lname);
        }

        $this->setIsStatusChanged(true);

        try {
            $this->save();
            if ($isConfirmNeed === true
                && $isOwnSubscribes === false
            ) {
                $this->sendConfirmationRequestEmail();
            } else {
                $this->sendConfirmationSuccessEmail();
            }

            return $this->getStatus();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * Retrieve Subscribers Full Name if it was set
     *
     * @return string|null
     */
    public function getSubscriberFullName()
    {
        $name = null;
		if( $this->hasSubscriberFirstname() || $this->hasSubscriberLastname()){
			$name = $this->getSubscriberFirstname() . ' ' . $this->getSubscriberLastname();
		}elseif ($this->hasCustomerFirstname() || $this->hasCustomerLastname()) {
            $name = $this->getCustomerFirstname() . ' ' . $this->getCustomerLastname();
        }
        return $name;
    }
}
