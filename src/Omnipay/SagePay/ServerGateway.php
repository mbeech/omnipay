<?php

namespace Omnipay\SagePay;

use Omnipay\SagePay\Message\ServerAuthorizeRequest;
use Omnipay\SagePay\Message\ServerCompleteAuthorizeRequest;
use Omnipay\SagePay\Message\ServerPurchaseRequest;

/**
 * Sage Pay Server Gateway
 */
class ServerGateway extends DirectGateway
{
    public function getName()
    {
        return 'Sage Pay Server';
    }

    public function getLowProfile()
    {
        return $this->getParameter('lowProfile');
    }

    public function setLowProfile($value)
    {
        return $this->setParameter('lowProfile', $value);
    }

    public function authorize(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\SagePay\Message\ServerAuthorizeRequest', $parameters);
    }

    public function completeAuthorize(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\SagePay\Message\ServerCompleteAuthorizeRequest', $parameters);
    }

    public function purchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\SagePay\Message\ServerPurchaseRequest', $parameters);
    }

    public function completePurchase(array $parameters = array())
    {
        return $this->completeAuthorize($parameters);
    }
}
