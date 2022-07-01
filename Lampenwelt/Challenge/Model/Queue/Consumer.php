<?php
declare(strict_types=1);

namespace Lampenwelt\Challenge\Model\Queue;

use Lampenwelt\Challenge\Model\Transport\Request;
use Lampenwelt\Challenge\Model\Order\SaveData;
use Lampenwelt\Challenge\Model\Order\Status;
use Lampenwelt\Challenge\Model\Config;

class Consumer
{
    const SUCCESS_RESULT = 200;

    /**
     * @var Request
     */
    protected $request;

    /**
     * @var Status
     */
    protected $status;

    /**
     * @var SaveData
     */
    protected $saveData;

    /**
     * @var Config
     */
    protected $config;

    /**
     * @param Request $request
     * @param Status $status
     * @param SaveData $saveData
     * @param Config $config
     */
    public function __construct(
        Request $request,
        Status $status,
        SaveData $saveData,
        Config $config
    ) {
        $this->request = $request;
        $this->status = $status;
        $this->saveData = $saveData;
        $this->config = $config;
    }

    /**
     * Run process from queue
     *
     * @param $orderData
     * @return void
     * @throws \Exception
     */
    public function process($orderData) : void
    {
        // checking if the module Lampenwelt_Challenge enabled
        if ($this->config->isEnabled()) {
            // run process from queue and send request
            $result = $this->request->run($orderData);

            // save order data with result into the DB table `lampenwelt_erp`
            $this->saveData->save($result, $orderData);

            // update order status in case of successful result
            if ($result == self::SUCCESS_RESULT) {
                $this->status->update($orderData);
            }
        }
    }
}
