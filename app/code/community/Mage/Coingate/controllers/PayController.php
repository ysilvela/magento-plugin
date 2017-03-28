<?php

class Mage_Eligebtc_PayController extends Mage_Core_Controller_Front_Action
{

    public function getCheckout()
    {
        return Mage::getSingleton('checkout/session');
    }

    public function getQuote()
    {
        return $this->getCheckout()->getQuote();
    }

    public function redirectAction()
    {
        $session = Mage::getSingleton('checkout/session');
        $session->setPayQuoteId($session->getQuoteId());
        $session->unsQuoteId();

        $coingate = Mage::getModel('coingate/EligebtcFactory');

        $this->_redirectUrl($coingate->getRequest());
    }

    public function callbackAction()
    {
        $this->getResponse()->setBody($this->getLayout()->createBlock('eligebtc/callback')->toHtml());
    }

    public function cancelAction()
    {
        $session = Mage::getSingleton('checkout/session');
        $session->setQuoteId($session->getPayQuoteId(TRUE));
        $this->_redirect('checkout/cart');
    }

    public function successAction()
    {
        $session = Mage::getSingleton('checkout/session');
        $session->setQuoteId($session->getPayQuoteId(TRUE));
        Mage::getSingleton('checkout/session')->getQuote()->setIsActive(FALSE)->save();
        $this->_redirect('checkout/onepage/success', array('_secure' => TRUE));
    }

    public function failAction()
    {
        $order = Mage::getModel('sales/order');
        $order->load(Mage::getSingleton('checkout/session')->getLastOrderId());

        if ($order->getId()) {
            $order->setStatus('canceled')->save();
        }

        $this->_redirect('checkout/onepage/failure');
    }
}
