<?php
declare(strict_types=1);

namespace Lampenwelt\Challenge\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Data\SearchResultInterface;
use Lampenwelt\Challenge\Model\Erp;

interface ErpRepositoryInterface
{
    /**
     * Get array of all possible orders according the search criteria
     *
     * @param SearchCriteriaInterface $searchCriteria
     * @return SearchResultInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria);


    /**
     * Saving data into DB table
     *
     * @param ErpInterface $object
     * @return mixed
     */
    public function save(Erp $object);
}
