<?php

namespace Lampenwelt\Challenge\Model\Queue;

use Magento\Framework\MessageQueue\PublisherInterface;

class OrderToQueue
{
    const TOPIC_NAME = 'challenge.queue.order';

    /**
     * @var \Magento\Framework\MessageQueue\PublisherInterface
     */
    protected $publisher;

    /**
     * @param PublisherInterface $publisher
     */
    public function __construct(
        PublisherInterface $publisher
    ) {
        $this->publisher = $publisher;
    }

    /**
     * Adding data to queue
     *
     * @param $data
     * @return void
     */
    public function publishData($data)
    {
        $this->publisher->publish(self::TOPIC_NAME, $data);
    }
}
