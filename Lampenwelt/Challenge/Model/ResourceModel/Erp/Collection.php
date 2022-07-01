<?php
declare(strict_types=1);

namespace Lampenwelt\Challenge\Model\ResourceModel\Erp;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'entity_id';
    protected $_eventPrefix = 'lampenwelt_erp_collection';
    protected $_eventObject = 'erp_collection';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct() : void
    {
        $this->_init(
            'Lampenwelt\Challenge\Model\Erp',
            'Lampenwelt\Challenge\Model\ResourceModel\Erp'
        );
    }
}
