<?php

namespace Omnipay\AfterPay;

use Omnipay\Common\AbstractGateway;

/**
 * AfterPay Gateway
 */
class Gateway extends AbstractGateway
{
    public function getName()
    {
        return 'AfterPay';
    }

    public function getDefaultParameters()
    {
        return [
            'key'      => '',
            'testMode' => false,
        ];
    }

    public function getKey()
    {
        return $this->getParameter('key');
    }

    public function setKey($value)
    {
        return $this->setParameter('key', $value);
    }

    /**
     * @return Message\AuthorizeRequest
     */
    public function authorize(array $parameters = [])
    {
        return $this->createRequest('\Omnipay\AfterPay\Message\AuthorizeRequest', $parameters);
    }
}
