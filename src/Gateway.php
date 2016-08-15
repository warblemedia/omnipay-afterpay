<?php

namespace Omnipay\AfterPay;

use Omnipay\Common\AbstractGateway;

class Gateway extends AbstractGateway
{
    /**
     * @return string
     */
    public function getName()
    {
        return 'AfterPay';
    }

    /**
     * @return array
     */
    public function getDefaultParameters()
    {
        return [
            'key'      => '',
            'testMode' => false,
        ];
    }

    /**
     * @return mixed
     */
    public function getKey()
    {
        return $this->getParameter('key');
    }

    /**
     * @param $value
     * @return $this
     */
    public function setKey($value)
    {
        return $this->setParameter('key', $value);
    }

    /**
     * @param array $parameters
     * @return \Omnipay\AfterPay\Message\AuthorizeRequest
     */
    public function authorize(array $parameters = [])
    {
        return $this->createRequest('\Omnipay\AfterPay\Message\AuthorizeRequest', $parameters);
    }
}
