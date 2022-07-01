<?php
declare(strict_types=1);

namespace Lampenwelt\Challenge\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer;
use Lampenwelt\Challenge\Model\Queue\OrderToQueue;
use Magento\Framework\Serialize\Serializer\Json;
use Lampenwelt\Challenge\Logger\Logger;
use Lampenwelt\Challenge\Model\Config;

class OrderPlaceAfter implements ObserverInterface
{
    /**
     * @var Logger
     */
    protected $logger;

    /**
     * @var Json
     */
    protected $json;

    /**
     * @var OrderToQueue
     */
    protected $publisher;

    /**
     * @var Config
     */
    protected $config;

    /**
     * @param Logger $logger
     * @param Json $json
     * @param OrderToQueue $publisher
     * @param Config $config
     */
    public function __construct(
        Logger $logger,
        Json $json,
        OrderToQueue $publisher,
        Config $config
    ) {
        $this->logger = $logger;
        $this->json = $json;
        $this->publisher = $publisher;
        $this->config = $config;
    }

    /**
     * @param Observer $observer
     * @return void
     */
    public function execute(Observer $observer) : void
    {
        // checking if the module Lampenwelt_Challenge enabled
        if ($this->config->isEnabled()) {

            // getting order data from event
            $order = $observer->getEvent()->getOrder();
            $customerEmail = $order->getCustomerEmail();
            $orderId = $order->getRealOrderId();
            $items = [];

            // getting products from order, saving into array SKU and ordered QTY
            foreach ($order->getAllItems() as $item) {
                $items[$item->getSku()] = $item->getQtyOrdered();
            }

            // preparing data for saving in queue
            $collectedData = [
                'order_id' => $orderId,
                'customer_email' => $customerEmail,
                'items' => $items
            ];

            // add data to queue
            $this->publish($this->json->serialize($collectedData));

            // converting items array into JSON string before saving in log file
            $items = $this->json->serialize($items);

            // saving data into the log file
            $this->logging($orderId, $customerEmail, $items);
        }
    }

    /**
     * Publishing data
     *
     * @param $data
     * @return void
     */
    private function publish($data) : void
    {
        $this->publisher->publishData($data);
    }

    /**
     * Saving data in log file
     *
     * @param $orderId
     * @param $customerEmail
     * @param $items
     * @return void
     */
    private function logging($orderId, $customerEmail, $items) : void
    {
        $this->logger->info('Order ID: ' . $orderId);
        $this->logger->info('Customer Email: ' . $customerEmail);
        $this->logger->info('Items in Order: ' . $items);
    }
}
