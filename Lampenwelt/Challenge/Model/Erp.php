<?php
declare(strict_types=1);

namespace Lampenwelt\Challenge\Model;

use Magento\Tests\NamingConvention\true\string;

class Erp extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
    const CACHE_TAG = 'lampenwelt_erp';

    protected $_cacheTag = 'lampenwelt_erp';

    protected $_eventPrefix = 'lampenwelt_erp';

    /**
     * @return void
     */
    protected function _construct() : void
    {
        $this->_init('Lampenwelt\Challenge\Model\ResourceModel\Erp');
    }

    /**
     * @return string[]
     */
    public function getIdentities() : array
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    /**
     * @return array
     */
    public function getDefaultValues() : array
    {
        $values = [];

        return $values;
    }
}
