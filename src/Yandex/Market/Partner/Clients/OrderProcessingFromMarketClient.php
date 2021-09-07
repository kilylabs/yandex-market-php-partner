<?php

namespace Yandex\Market\Partner\Clients;

use Yandex\Market\Partner\Models\Response\AcceptOrderResponse;
use Yandex\Market\Partner\Models\Response\GetCartResponse;

class OrderProcessingFromMarketClient extends Client
{
    /**
     * Sends the store a list of items in the shopping cart
     *
     * @see https://yandex.ru/dev/market/partner-dsbs/doc/dg/reference/post-cart.html
     *
     * @param $response
     * @return \Yandex\Market\Partner\Models\Cart
     */
    public function getCart($response)
    {
        $decodedResponseBody = $this->getDecodedBody($response);
        $getCartResponse = new GetCartResponse($decodedResponseBody);

        return $getCartResponse->getCart();
    }

    /**
     * Sends a new order to the store
     *
     * @see https://yandex.ru/dev/market/partner-dsbs/doc/dg/reference/post-order-accept.html
     *
     * @param $response
     * @return \Yandex\Marketplace\Partner\Models\OrderInfo
     */
    public function acceptOrder($response)
    {
        $decodedResponseBody = $this->getDecodedBody($response);
        $acceptOrderResponse = new AcceptOrderResponse($decodedResponseBody);

        return $acceptOrderResponse->getOrder();
    }

    /**
     * Notifies the store about changing the status of the order.
     *
     * @see https://yandex.ru/dev/market/partner-dsbs/doc/dg/reference/post-order-status.html
     *
     * @param $response
     * @return \Yandex\Marketplace\Partner\Models\OrderInfo
     */
    public function orderStatus($response)
    {
        $decodedResponseBody = $this->getDecodedBody($response);
        $acceptOrderResponse = new AcceptOrderResponse($decodedResponseBody);

        return $acceptOrderResponse->getOrder();
    }

    /**
     * @param $response
     * @return array
     */
    public function getResponse($response)
    {
        return $this->getDecodedBody($response);
    }
}
