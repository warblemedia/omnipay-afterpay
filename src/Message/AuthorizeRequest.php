<?php

namespace Omnipay\AfterPay\Message;

/**
 * @method Response send()
 */
class AuthorizeRequest extends AbstractRequest
{
    /**
     * @return mixed
     * @throws \Omnipay\Common\Exception\InvalidCreditCardException
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData()
    {
        $this->validate('amount', 'card');
        $this->getCard()->validate();

        $data = $this->getBaseData();

        return $data;
    }
}
