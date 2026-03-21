<?php
namespace Omnipay\IPay88;

use Omnipay\Common\AbstractGateway;

/**
 * iPay8 Gateway Driver for Omnipay
 *
 * This driver is based on
 * Online Payment Switching Gateway Technical Specification Version 1.6.1
 * @link https://drive.google.com/file/d/0B4YUBYSgSzmAbGpjUXMyMWx6S2s/view?usp=sharing
 */
class Gateway extends AbstractGateway
{
    public function getName()
    {
        return 'iPay88';
    }

    public function getDefaultParameters()
    {
        return [
            'merchantKey' => '',
            'merchantCode' => '',
            'backendUrl' => '',
            'forceRequery' => true,
            'signatureType' => 'hmac_sha512',
        ];
    }

    public function getMerchantKey()
    {
        return $this->getParameter('merchantKey');
    }

    public function setForceRequery($boolean)
    {
        return $this->setParameter('forceRequery', $boolean);
    }
    public function getForceRequery()
    {
        return $this->getParameter('forceRequery');
    }
    public function setSandboxUrl($sandboxUrl)
    {
        return $this->setParameter('sandboxUrl', $sandboxUrl);
    }

    public function getSandboxUrl()
    {
        return $this->getParameter('sandboxUrl');
    }

    public function setSignatureType($signatureType)
    {
        return $this->setParameter('signatureType', $signatureType);
    }

    public function setMerchantKey($merchantKey)
    {
        return $this->setParameter('merchantKey', $merchantKey);
    }

    public function getMerchantCode()
    {
        return $this->getParameter('merchantCode');
    }

    public function setMerchantCode($merchantCode)
    {
        return $this->setParameter('merchantCode', $merchantCode);
    }

    public function getBackendUrl()
    {
        return $this->getParameter('backendUrl');
    }

    public function setBackendUrl($backendUrl)
    {
        return $this->setParameter('backendUrl', $backendUrl);
    }

    public function purchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\IPay88\Message\PurchaseRequest', $parameters);
    }

    public function completePurchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\IPay88\Message\CompletePurchaseRequest', $parameters);
    }

}