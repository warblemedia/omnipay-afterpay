<?php

namespace Omnipay\AfterPay\Test;

use Omnipay\AfterPay\Gateway;
use Omnipay\Tests\GatewayTestCase;

class GatewayTest extends GatewayTestCase
{
    /** @var \Omnipay\AfterPay\Gateway */
    protected $gateway;

    /** @var array */
    protected $options;

    public function setUp()
    {
        $this->gateway = new Gateway($this->getHttpClient(), $this->getHttpRequest());
    }

    /** @test */
    public function configuration()
    {
        $request = $this->gateway->configuration();

        static::assertInstanceOf('Omnipay\AfterPay\Message\ConfigurationRequest', $request);
    }

    /** @test */
    public function configurationRequest()
    {
        $this->setMockHttpResponse('ConfigurationSuccess.txt');

        $response = $this->gateway->configuration($this->options)->send();
        $expected = array(
            'type'          => 'PAY_BY_INSTALLMENT',
            'description'   => 'Pay over time',
            'maximumAmount' => array(
                'amount'   => '1000.00',
                'currency' => 'AUD',
            ),
        );

        static::assertTrue($response->isSuccessful());
        static::assertEquals($expected, $response->getData());
    }
}
