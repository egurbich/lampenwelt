<?php

declare(strict_types=1);

namespace Lampenwelt\Challenge\Model\Order;

use Psr\Log\LoggerInterface;
use Magento\Sales\Model\Order;
use Magento\Sales\Api\Data\OrderInterface;
use Magento\Sales\Api\OrderRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Serialize\Serializer\Json;

class Status
{
    /**
     * @var OrderRepositoryInterface
     */
    protected $orderRepository;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * @var Json
     */
    protected $json;

    /**
     * @var SearchCriteriaBuilder
     */
    protected $searchCriteriaBuilder;

    /**
     * @param OrderRepositoryInterface $orderRepository
     * @param LoggerInterface $logger
     * @param Json $json
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     */
    public function __construct(
        OrderRepositoryInterface $orderRepository,
        LoggerInterface $logger,
        Json $json,
        SearchCriteriaBuilder $searchCriteriaBuilder
    ) {
        $this->orderRepository = $orderRepository;
        $this->logger = $logger;
        $this->json = $json;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
    }

    /**
     * Updating order state and status to 'Processing' in case if it was successfully sent to ERP
     *
     * @param $orderData
     * @return void
     */
    public function update($orderData) : void
    {
        $orderData = (array)$this->json->unserialize($orderData);
        if (isset($orderData['order_id'])) {
            try {
                // getting order by Increment ID
                $criteria = $this->searchCriteriaBuilder->addFilter(OrderInterface::INCREMENT_ID, $orderData['order_id'])->create();
                $order = $this->orderRepository->getList($criteria)->getItems();

                if ($order) {
                    $order = array_shift($order);
                    $order->setState(Order::STATE_PROCESSING);
                    $order->setStatus(Order::STATE_PROCESSING);

                    // saving order with updated status and state
                    $this->orderRepository->save($order);
                }
            } catch (\Exception $e) {
                $this->logger->error($e);
            }
        }
    }
}
