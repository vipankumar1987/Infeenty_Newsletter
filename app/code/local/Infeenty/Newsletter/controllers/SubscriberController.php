<?php
require_once 'Mage/Newsletter/controllers/SubscriberController.php';
class Infeenty_Newsletter_SubscriberController extends Mage_Newsletter_SubscriberController 
{
    /**
      * New subscription action
      */

    public function newAction()
    {
		$error_message = $this->__('Please fill required fields');
		$success_mesge = '';
		if ($this->getRequest()->isPost() && $this->getRequest()->getPost('email')) {
            $session            = Mage::getSingleton('core/session');
            $customerSession    = Mage::getSingleton('customer/session');
            $email              = (string) $this->getRequest()->getPost('email');
			$firstname = (string) $this->getRequest()->getPost('subscriber_firstname');
			$lastname = (string) $this->getRequest()->getPost('subscriber_lastname');
			
            try {
                if (!Zend_Validate::is($email, 'EmailAddress')) {
                    Mage::throwException($this->__('Please enter a valid email address.'));
                }


                if (Mage::getStoreConfig(Mage_Newsletter_Model_Subscriber::XML_PATH_ALLOW_GUEST_SUBSCRIBE_FLAG) != 1 && 
                    !$customerSession->isLoggedIn()) {
                    Mage::throwException($this->__('Sorry, but administrator denied subscription for guests. Please <a href="%s">register</a>.', Mage::helper('customer')->getRegisterUrl()));
                }

                $ownerId = Mage::getModel('customer/customer')
                        ->setWebsiteId(Mage::app()->getStore()->getWebsiteId())
                        ->loadByEmail($email)
                        ->getId();

				if ($ownerId !== null && $ownerId != $customerSession->getId()) {
                    Mage::throwException($this->__('This email address is already assigned to another user.'));
                }
				
				if( $ownerId == null ){
					if (!Zend_Validate::is($firstname, 'NotEmpty')) {
						Mage::throwException($this->__('First name is empty.'));
					}
					if (!Zend_Validate::is($lastname, 'NotEmpty')) {
						Mage::throwException($this->__('Last name is empty.'));
					}
				}

                $status = Mage::getModel('newsletter/subscriber')->subscribe($email, $firstname , $lastname);
				
                if ($status == Mage_Newsletter_Model_Subscriber::STATUS_NOT_ACTIVE) {
					$success_mesge = $this->__('Confirmation request has been sent.');
                   // $session->addSuccess($success_mesge);
                }
                else {
					$success_mesge = $this->__('Thank you for your subscription.');
                   // $session->addSuccess($success_mesge);
                }
            }
            catch (Mage_Core_Exception $e) {
				$error_message = $this->__('There was a problem with the subscription: %s', $e->getMessage());
               // $session->addException($e, $error_message);
            }
            catch (Exception $e) {
				$error_message = $this->__('There was a problem with the subscription.');
                //$session->addException($e, $error_message );
            }
        }
		$response = Mage::helper('core')->jsonEncode(array('error'=> $error_message,'success'=>$success_mesge));
		$this->getResponse()->setHeader('Content-Type','application/json');
		$this->getResponse()->setBody($response);
        //$this->_redirectReferer();
    }

 }