<?php
declare(strict_types=1);

namespace Lampenwelt\Challenge\Model\Data;

use Magento\Framework\Model\AbstractExtensibleModel;
use Lampenwelt\Challenge\Api\Data\ErpInterface;

class Erp extends AbstractExtensibleModel implements ErpInterface
{
    public function setTotalCount($totalCount)
    {
        return null;
    }

    public function getSearchCriteria()
    {
        return null;
    }

    public function setSearchCriteria($searchCriteria)
    {
        return null;
    }

    public function getItems()
    {
        return null;
    }

    public function setItems($items)
    {
        return null;
    }

    public function getTotalCount()
    {
        return null;
    }

    /**
     * @return string
     */
    public function getEntityId()
    {
        return $this->_get(self::KEY_ENTITY_ID);
    }

    /**
     * @return string
     */
    public function getOrderId()
    {
        return $this->_get(self::KEY_ORDER_ID);
    }

    /**
     * @return string
     */
    public function getCustomerEmail()
    {
        return $this->_get(self::KEY_CUSTOMER_EMAIL);
    }

    /**
     * @return string
     */
    public function getCreatedAt()
    {
        return $this->_get(self::KEY_CREATED_AT);
    }

    /**
     * @return string
     */
    public function getReturnCode()
    {
        return $this->_get(self::KEY_RETURN_CODE);
    }
}
