<?php

namespace Omnipay\SagePay\Message;

/**
 * Sage Pay Server Authorize Request
 */
class ServerAuthorizeRequest extends DirectAuthorizeRequest
{
    public function getData()
    {
        $this->validate('returnUrl');

        $data = $this->getBaseAuthorizeData();
        $data['NotificationURL'] = $this->getReturnUrl();

        //if (null !== $this->getLowProfile()) {
        //    $data['Profile'] = "LOW";
        //}

        $items = $this->getItems();

        if ($items) {

            $data['Basket'] = count($items);
            foreach ($items as $n => $item) {

                $data['Basket'] .= ':' . $item->getId()." - ".$item->getName();
                $data['Basket'] .= ':' . $item->getQuantity();
                $data['Basket'] .= ':' . $this->formatCurrency($item->getPrice());
                $data['Basket'] .= ':' . $this->formatCurrency($item->getTax());
                $data['Basket'] .= ':' . $this->formatCurrency($item->getPrice() + $item->getTax());
                $data['Basket'] .= ':' . $this->formatCurrency($item->getQuantity() * ($item->getPrice() + $item->getTax()));
            }
            
        }

        return $data;
    }

    public function getService()
    {
        return 'vspserver-register';
    }

    protected function createResponse($data)
    {
        return $this->response = new ServerAuthorizeResponse($this, $data);
    }
}
