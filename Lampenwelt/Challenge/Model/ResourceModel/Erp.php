<?php
declare(strict_types=1);

namespace Lampenwelt\Challenge\Model\ResourceModel;

class Erp extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * @param \Magento\Framework\Model\ResourceModel\Db\Context $context
     */
    public function __construct(
        \Magento\Framework\Model\ResourceModel\Db\Context $context
    ) {
        parent::__construct($context);
    }

    /**
     * @return void
     */
    protected function _construct() : void
    {
        $this->_init('lampenwelt_erp', 'entity_id');
    }
}
