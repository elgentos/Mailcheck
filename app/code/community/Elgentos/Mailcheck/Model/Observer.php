<?php

class Elgentos_Mailcheck_Model_Observer
{

    public function generateDomainList()
    {
        $this->_helper = Mage::helper('elgentos_mailcheck');

        $defaultDomains = $this->_helper->getDefaultDomains();
        $defaultSecondLevelDomains = $this->_helper->getDefaultSecondLevelDomains();
        $defaultTopLevelDomains = $this->_helper->getDefaultToplevelDomains();
        $supplement = $this->_helper->getSupplement();
        $supplementCutoffPoint = $this->_helper->getSupplementCutoffPoint();

        $fullDomains = array();
        $secondLevelDomains = array();
        $tlds = array();

        if ($supplement) {
            $domainList = array();
            $customers = Mage::getModel('customer/customer')->getCollection();
            foreach ($customers as $customer) {
                $domain = $this->getFullDomain($customer->getEmail());
                if (!$domain) {
                    continue;
                }
                if (isset($domainList[$domain])) {
                    $domainList[$domain]++;
                } else {
                    $domainList[$domain] = 1;
                }
            }
            arsort($domainList);

            foreach ($domainList as $fullDomain => $total) {
                if ($total > $supplementCutoffPoint) {
                    $tld = $this->getTld($fullDomain);
                    if ($tld && !in_array($tld, $tlds)) {
                        $tlds[] = $tld;
                    }
                    $secondLevelDomains[] = str_replace('.' . $tld, '', $fullDomain);
                    $fullDomains[] = $fullDomain;
                } else {
                    break;
                }
            }
        }

        $secondLevelDomains = array_merge($secondLevelDomains, $defaultSecondLevelDomains);
        $secondLevelDomains = array_unique($secondLevelDomains);
        $fullDomains = array_merge($fullDomains, $defaultDomains);
        $fullDomains = array_unique($fullDomains);
        $tlds = array_merge($tlds, $defaultTopLevelDomains);
        $tlds = array_unique($tlds);
        // Reverse domain list to put least used in front
	$fullDomains = array_reverse($fullDomains);
	$tlds = array_reverse($tlds);
	$secondLevelDomains = array_reverse($secondLevelDomains)

        // Write output to cache
        file_put_contents($this->_helper->getTopLevelDomainCacheFilename(), Mage::helper('core')->jsonEncode($tlds));
        file_put_contents($this->_helper->getSecondLevelDomainCacheFilename(),
            Mage::helper('core')->jsonEncode($secondLevelDomains));
        file_put_contents($this->_helper->getDomainCacheFilename(), Mage::helper('core')->jsonEncode($fullDomains));
    }

    private function getFullDomain($email)
    {
        $regex = '/@(.*)/';
        preg_match($regex, $email, $matches);
        if (isset($matches[1])) {
            return $matches[1];
        }

        return false;
    }

    private function getTld($domain)
    {
        preg_match('/(.*?)((\.co)?.[a-z]{2,4})$/i', $domain, $m);
        $ext = isset($m[2]) ? substr($m[2], 1) : false;

        return $ext;
    }


}
