<?php
declare(strict_types=1);

namespace Lampenwelt\Challenge\Model\Order;

use Lampenwelt\Challenge\Api\Data\ErpInterface;
use Lampenwelt\Challenge\Model\ErpFactory;
use Magento\Framework\Serialize\Serializer\Json;
use Lampenwelt\Challenge\Model\ErpRepository;

class SaveData
{
    /**
     * @var ErpFactory
     */
    protected $erp;

    /**
     * @var Json
     */
    protected $json;

    /**
     * @var ErpRepository
     */
    protected $erpRepository;

    /**
     * @param ErpFactory $erp
     * @param Json $json
     * @param ErpRepository $erpRepository
     */
    public function __construct(
        ErpFactory $erp,
        Json $json,
        ErpRepository $erpRepository
    ) {
        $this->erp = $erp;
        $this->json = $json;
        $this->erpRepository = $erpRepository;
    }

    /**
     * Saving order data with API response status into the `lampenwelt_erp` DB table
     *
     * @param $result
     * @param $orderData
     * @return void
     * @throws \Magento\Framework\Exception\CouldNotSaveException
     */
    public function save($result, $orderData) : void
    {
        $orderData = (array)$this->json->unserialize($orderData);
        $orderData[ErpInterface::KEY_CREATED_AT] = date('Y-m-d H:i:s');
        $orderData[ErpInterface::KEY_RETURN_CODE] = $result;

        $erp = $this->erp->create();
        $this->erpRepository->save($erp->addData($orderData));
    }
}
