<?php

namespace Lampenwelt\Challenge\Model;

use Magento\Framework\Api\DataObjectHelper;
use Lampenwelt\Challenge\Api\Data\ErpInterface;

class ErpManager
{
    /**
     * @var array
     */
    private $orders;

    /**
     * @var DataObjectHelper
     */
    private $dataObjectHelper;

    /**
     * @param DataObjectHelper $dataObjectHelper
     * @param ErpInterface $orders
     */
    public function __construct(
        DataObjectHelper $dataObjectHelper,
        array $orders = []
    ) {
        $this->dataObjectHelper = $dataObjectHelper;
        $this->orders = $orders;
    }

    /**
     * @param string $orderId
     * @return ErpInterface|null
     */
    public function getOrder($orderId)
    {
        $order = null;
        if (array_key_exists($orderId, $this->orders)) {
            $order = $this->orders[$orderId];
            $this->populateOrder($orderId, $order);
        }
        return $order;
    }

    /**
     * @return array
     */
    public function getOrders()
    {
        $orders = [];
        foreach ($this->orders as $order) {

            $orders[] = $this->populateOrder($order['entity_id'], $order);
        }

        return $orders;
    }

    /**
     * @param string $entityId
     * @param ErpInterface $order
     * @return ErpInterface
     */
    private function populateOrder($entityId, ErpInterface $order)
    {
        $this->dataObjectHelper->populateWithArray(
            $order,
            [
                ErpInterface::KEY_ENTITY_ID => $entityId,
            ],
            'Lampenwelt\Challenge\Api\Data\ErpInterface'
        );

        return $order;
    }
}
