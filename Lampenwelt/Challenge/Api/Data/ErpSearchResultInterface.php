<?php
declare(strict_types=1);

namespace Lampenwelt\Challenge\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

interface ErpSearchResultInterface extends SearchResultsInterface
{
    /**
     * Get orders list.
     *
     * @api
     * @return ErpInterface[]
     */
    public function getItems();

    /**
     * Set orders list.
     *
     * @api
     * @param ErpInterface[] $items
     * @return $this
     */
    public function setItems(array $items = null);
}
