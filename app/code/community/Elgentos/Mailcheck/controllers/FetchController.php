<?php

class Elgentos_Mailcheck_FetchController extends Mage_Core_Controller_Front_Action
{

    public function settingsAction()
    {
        $this->_helper = Mage::helper('elgentos_mailcheck');
        $payload = array();
        $payload['domains'] = $this->_helper->getDomains();
        $payload['topleveldomains'] = $this->_helper->getToplevelDomains();
        $payload['secondleveldomains'] = $this->_helper->getSecondLevelDomains();
        $payload['text'] = $this->_helper->getText();

        $response = Mage::helper('core')->jsonEncode($payload);
        $this->getResponse()->clearHeaders()->setHeader('Content-type', 'application/json', true);
        $this->getResponse()->setBody($response);
    }

}