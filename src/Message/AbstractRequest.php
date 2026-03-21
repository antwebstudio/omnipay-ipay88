<?php

namespace Omnipay\IPay88\Message;

abstract class AbstractRequest extends \Omnipay\Common\Message\AbstractRequest
{

    public function getBackendUrl()
    {
        return $this->getParameter('backendUrl');
    }

    public function setBackendUrl($backendUrl)
    {
        return $this->setParameter('backendUrl', $backendUrl);
    }

    public function getForceRequery()
    {
        return $this->getParameter('forceRequery');
    }

    public function setForceRequery($forceRequery)
    {
        return $this->setParameter('forceRequery', $forceRequery);
    }

    public function getSandboxUrl()
    {
        return $this->getParameter('sandboxUrl');
    }

    public function setSandboxUrl($sandboxUrl)
    {
        return $this->setParameter('sandboxUrl', $sandboxUrl);
    }

    public function getMerchantKey()
    {
        return $this->getParameter('merchantKey');
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

    public function getSignatureType()
    {
        return $this->getParameter('signatureType');
    }

    public function setSignatureType($signatureType)
    {
        return $this->setParameter('signatureType', $signatureType);
    }

    protected function guardParameters()
    {
        $this->validate(
            'card',
            'amount',
            'currency',
            'description',
            'transactionId',
            'returnUrl'
        );
    }

    public function createSignatureFromString($fullStringToHash)
    {
        $signatureType = $this->getSignatureType();
        
        if ($signatureType == 'sha1') {
            return base64_encode(self::hex2bin(sha1($fullStringToHash)));			
        } else if ($signatureType == 'sha256') {
            return hash('sha256', $fullStringToHash);
        } else if ($signatureType == 'hmac_sha512') {
            return hash_hmac('sha512', $fullStringToHash, $this->getMerchantKey());
        } else {
            throw new \Exception('Signature type: '.$signatureType.' is not supported.');
        }
    }

    protected static function hex2bin($hexSource)
    {
        $bin = '';
        for ($i = 0; $i < strlen($hexSource); $i = $i + 2) {
            $bin .= chr(hexdec(substr($hexSource, $i, 2)));
        }
        return $bin;
    }
}