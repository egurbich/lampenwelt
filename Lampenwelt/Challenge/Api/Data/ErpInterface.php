<?php
declare(strict_types=1);

namespace Lampenwelt\Challenge\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

interface ErpInterface extends SearchResultsInterface
{
    const KEY_ENTITY_ID = 'entity_id';
    const KEY_ORDER_ID = 'order_id';
    const KEY_CUSTOMER_EMAIL = 'customer_email';
    const KEY_CREATED_AT = 'created_at';
    const KEY_RETURN_CODE = 'return_code';

    /**
     * @return string
     */
    public function getEntityId();

    /**
     * @return string
     */
    public function getOrderId();

    /**
     * @return string
     */
    public function getCustomerEmail();

    /**
     * @return string
     */
    public function getCreatedAt();

    /**
     * @return string
     */
    public function getReturnCode();
}
