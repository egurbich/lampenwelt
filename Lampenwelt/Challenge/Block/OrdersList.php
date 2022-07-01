<?php
declare(strict_types=1);

namespace Lampenwelt\Challenge\Block;

use Lampenwelt\Challenge\Api\Data\ErpInterface;
use Lampenwelt\Challenge\Model\Config;
use Lampenwelt\Challenge\Model\ErpRepository;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\SortOrder;
use Magento\Framework\View\Element\Template\Context;
use Magento\Framework\Api\SortOrderBuilder;

class OrdersList extends \Magento\Framework\View\Element\Template
{
    const PAGE_SIZE = 10;

    /**
     * @var SearchCriteriaBuilder
     */
    protected $searchCriteriaBuilder;

    /**
     * @var ErpRepository
     */
    protected $erpRepository;

    /**
     * @var SortOrderBuilder
     */
    protected $sortOrderBuilder;

    /**
     * @var Config
     */
    protected $config;

    /**
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param ErpRepository $erpRepository
     * @param SortOrderBuilder $sortOrderBuilder
     * @param Config $config
     * @param Context $context
     */
    public function __construct(
        SearchCriteriaBuilder $searchCriteriaBuilder,
        ErpRepository $erpRepository,
        SortOrderBuilder $sortOrderBuilder,
        Config $config,
        Context $context
    ) {
        parent::__construct($context);
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->erpRepository = $erpRepository;
        $this->sortOrderBuilder = $sortOrderBuilder;
        $this->config = $config;
    }

    /**
     * Getting order records list from DB table
     *
     * @return array
     */
    public function getOrdersList() : array
    {
        // checking if the module Lampenwelt_Challenge enabled
        if ($this->config->isEnabled()) {
            return [];
        }

        // setting Sort Order
        $sortOrder = $this->sortOrderBuilder
            ->setField(ErpInterface::KEY_ORDER_ID)
            ->setDirection(SortOrder::SORT_DESC)
            ->create();
        // creating filter criteria
        $criteria = $this->searchCriteriaBuilder
            ->setSortOrders([$sortOrder])
            ->setPageSize(self::PAGE_SIZE)
            ->create();
        return $this->erpRepository->getList($criteria)->getItems();
    }

    /**
     * @return OrdersList
     */
    public function _prepareLayout() : object
    {
        return parent::_prepareLayout();
    }
}
