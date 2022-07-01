<?php
declare(strict_types=1);
namespace Lampenwelt\Challenge\Model\Order;

use Magento\Framework\Api\SearchCriteriaBuilder;
use Lampenwelt\Challenge\Model\ErpRepository;
use Lampenwelt\Challenge\Api\Data\ErpInterface;

class OrdersList
{
    /**
     * @var SearchCriteriaBuilder
     */
    protected $searchCriteriaBuilder;

    /**
     * @var ErpRepository
     */
    protected $erpRepository;

    /**
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param ErpRepository $erpRepository
     */
    public function __construct(
        SearchCriteriaBuilder $searchCriteriaBuilder,
        ErpRepository $erpRepository
    ) {

        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->erpRepository = $erpRepository;
    }

    /**
     * Getting order records list from DB table
     *
     * @param int $requestResult
     * @param string $field
     * @return array
     */
    public function getOrdersList(int $requestResult = 200, string $field = ErpInterface::KEY_RETURN_CODE) : array
    {
        $criteria = $this->searchCriteriaBuilder->addFilter($field, $requestResult)->create();
        return $this->erpRepository->getList($criteria)->getItems();
    }
}
