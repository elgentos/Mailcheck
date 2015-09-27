<?php

class Elgentos_Mailcheck_Helper_Data extends Mage_Core_Helper_Abstract
{

    public function getDefaultDomains()
    {
        $domains = $this->getConfig('default_domains');
        $domains = explode(PHP_EOL, $domains);
        $domains = array_map('trim', $domains);

        return $domains;
    }

    public function getDefaultSecondLevelDomains()
    {
        $domains = $this->getConfig('default_secondlevel_domains');
        $domains = explode(PHP_EOL, $domains);
        $domains = array_map('trim', $domains);

        return $domains;
    }

    public function getDefaultToplevelDomains()
    {
        $domains = $this->getConfig('default_toplevel_domains');
        $domains = explode(PHP_EOL, $domains);
        $domains = array_map('trim', $domains);

        return $domains;
    }

    public function getDefaultDisposableDomains()
    {
        $domains = $this->getConfig('disposable_domains');
        $domains = explode(PHP_EOL, $domains);
        $domains = array_map('trim', $domains);

        return $domains;
    }

    public function getSupplement()
    {
        return $this->getConfig('supplement_domains');
    }

    public function getSupplementCutoffPoint()
    {
        $cutoffPoint = $this->getConfig('supplement_cutoff_point');
        if (!$cutoffPoint) {
            return 50; // enforce minimum due to privacy concerns
        } else {
            return $cutoffPoint;
        }
    }

    public function getText()
    {
        return $this->getConfig('text');
    }

    public function getNotAllowedText()
    {
        return $this->getConfig('not_allowed_text');
    }

    public function getDomains()
    {
        if ($this->getSupplement() && file_exists($this->getDomainCacheFilename())) {
            $cache = file_get_contents($this->getDomainCacheFilename());

            return Mage::helper('core')->jsonDecode($cache);
        } else {
            return $this->getDefaultDomains();
        }
    }

    public function getToplevelDomains()
    {
        if ($this->getSupplement() && file_exists($this->getTopLevelDomainCacheFilename())) {
            $cache = file_get_contents($this->getTopLevelDomainCacheFilename());

            return Mage::helper('core')->jsonDecode($cache);
        } else {
            return $this->getDefaultToplevelDomains();
        }
    }

    public function getSecondLevelDomains()
    {
        if ($this->getSupplement() && file_exists($this->getSecondLevelDomainCacheFilename())) {
            $cache = file_get_contents($this->getSecondLevelDomainCacheFilename());

            return Mage::helper('core')->jsonDecode($cache);
        } else {
            return $this->getDefaultSecondLevelDomains();
        }
    }

    public function getDisposableDomains()
    {
        if($this->getConfig('warn_disposable_domains')) {
            return $this->getDefaultDisposableDomains();
        } else {
            return false;
        }
    }

    private function getConfig($key)
    {
        return Mage::getStoreConfig('customer/mailcheck/' . $key, Mage::app()->getStore()->getId());
    }

    public function getDomainCacheFilename()
    {
        return Mage::getBaseDir('var') . '/mailcheck_fulldomains.json';
    }

    public function getTopLevelDomainCacheFilename()
    {
        return Mage::getBaseDir('var') . '/mailcheck_tlds.json';
    }

    public function getSecondLevelDomainCacheFilename()
    {
        return Mage::getBaseDir('var') . '/mailcheck_secondleveldomains.json';
    }

}