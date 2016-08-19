<?php

namespace Omnipay\AfterPay\Message;

use Omnipay\Common\Message\AbstractRequest as BaseAbstractRequest;

abstract class AbstractRequest extends BaseAbstractRequest
{
    protected $liveEndpoint = 'https://api.secure-afterpay.com.au/v1/';
    protected $testEndpoint = 'https://api-sandbox.secure-afterpay.com.au/v1/';

    /**
     * @return mixed
     */
    public function getMerchantId()
    {
        return $this->getParameter('merchantId');
    }

    /**
     * @param mixed $value
     * @return $this
     * @throws \Omnipay\Common\Exception\RuntimeException
     */
    public function setMerchantId($value)
    {
        return $this->setParameter('merchantId', $value);
    }

    /**
     * @return mixed
     */
    public function getMerchantSecret()
    {
        return $this->getParameter('merchantSecret');
    }

    /**
     * @param mixed $value
     * @return $this
     * @throws \Omnipay\Common\Exception\RuntimeException
     */
    public function setMerchantSecret($value)
    {
        return $this->setParameter('merchantSecret', $value);
    }

    /**
     * @param mixed $data
     * @return \Omnipay\AfterPay\Message\Response
     * @throws \Guzzle\Http\Exception\RequestException
     */
    public function sendData($data)
    {
        $endpoint = $this->getEndpoint();
        $httpMethod = $this->getHttpMethod();

        $httpRequest = $this->httpClient->createRequest($httpMethod, $endpoint, null, $data);
        $httpRequest->addHeader('Authorization', $this->buildAuthorizationHeader());

        $httpResponse = $httpRequest->send();

        $this->response = $this->createResponse($httpResponse->getBody());

        return $this->response;
    }

    /**
     * @return string
     */
    public function getHttpMethod()
    {
        return 'POST';
    }

    /**
     * @return string
     */
    protected function getEndpoint()
    {
        return $this->getTestMode() ? $this->testEndpoint : $this->liveEndpoint;
    }

    /**
     * @param mixed $data
     * @return \Omnipay\AfterPay\Message\Response
     */
    protected function createResponse($data)
    {
        return new Response($this, $data);
    }

    /**
     * @return string
     */
    protected function buildAuthorizationHeader()
    {
        $merchantId = $this->getMerchantId();
        $merchantSecret = $this->getMerchantSecret();

        return 'Basic: ' . base64_encode($merchantId . ':' . $merchantSecret);
    }
}
