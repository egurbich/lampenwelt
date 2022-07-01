<?php
declare(strict_types=1);

namespace Lampenwelt\Challenge\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class InstallData implements InstallDataInterface
{
    /**
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     */
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context) : void
    {
        $setup->startSetup();
        $tableName = $setup->getTable('lampenwelt_erp');
        if ($setup->getConnection()->isTableExists($tableName) == true) {
            $data = [
                [
                    'order_id' => 0,
                    'customer_email' => '',
                    'created_at' => date('Y-m-d H:i:s'),
                    'return_code' => 999,
                ],
            ];
            foreach ($data as $item) {
                $setup->getConnection()->insert($tableName, $item);
            }
        }
        $setup->endSetup();
    }
}
