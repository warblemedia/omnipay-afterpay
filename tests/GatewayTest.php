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
        $this->options = [];
    }
}
