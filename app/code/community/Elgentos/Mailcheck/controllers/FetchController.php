<?php

class Elgentos_Mailcheck_FetchController extends Mage_Core_Controller_Front_Action
{

    public function settingsAction()
    {
        $this->_helper = Mage::helper('elgentos_mailcheck');
        $payload = array();
        $payload['domains'] = $this->_helper->getDomains();
        $payload['topLevelDomains'] = $this->_helper->getToplevelDomains();
        $payload['secondLevelDomains'] = $this->_helper->getSecondLevelDomains();
        $payload['disposableDomains'] = $this->_helper->getDisposableDomains();
        $payload['text'] = $this->_helper->getText();
        $payload['notAllowedText'] = $this->_helper->getNotAllowedText();

        $response = Mage::helper('core')->jsonEncode($payload);
        $this->getResponse()->clearHeaders()->setHeader('Content-type', 'application/json', true);
        $this->getResponse()->setBody($response);
    }

}