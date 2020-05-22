<?php
/**
 * @author Hafizh FF
 * @copyright Copyright (c) 2020 Magento (https://www.magento.com)
 * @package Hz_PriceMonitor
 */
namespace Hz\PriceMonitor\Setup;

use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\DB\Ddl\Table;

class InstallData implements InstallDataInterface
{
    /**
     * EAV setup factory
     *
     * @var EavSetupFactory
     */
    private $eavSetupFactory;

    /**
     * InstallData constructor.
     * @param EavSetupFactory $eavSetupFactory
     */
    public function __construct(EavSetupFactory $eavSetupFactory)
    {
        $this->eavSetupFactory = $eavSetupFactory;
    }

    /**
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface $context
     * @throws \Zend_Db_Exception
     */
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $this->createRequestTable($setup);
        $this->createRequestTableLog($setup);
    }

    /**
     * @param ModuleDataSetupInterface $setup
     * @throws \Zend_Db_Exception
     */
    private function createRequestTable(ModuleDataSetupInterface $setup)
    {
        $table = $setup->getConnection()
            ->newTable($setup->getTable('hz_price_monitoring'))
            ->addColumn(
                'id',
                Table::TYPE_INTEGER,
                null,
                ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
                'Entity Id'
            )
            ->addColumn(
                'url',
                Table::TYPE_TEXT,
                255,
                ['default' => null, 'nullable' => false],
                'Url'
            )
            ->addColumn(
                'name',
                Table::TYPE_TEXT,
                255,
                ['default' => null, 'nullable' => false],
                'Name'
            )
            ->addColumn(
                'price',
                Table::TYPE_INTEGER,
                null,
                ['nullable' => false, 'default' => '0'],
                'Price Product'
            )
            ->addColumn(
                'description',
                Table::TYPE_TEXT,
                255,
                ['nullable' => true, 'default' => '0'],
                'Description'
            )
            ->addColumn(
                'image',
                Table::TYPE_TEXT,
                255,
                ['nullable' => true, 'default' => '0'],
                'Image'
            );
        $setup->getConnection()->createTable($table);
    }

    /**
     * @param ModuleDataSetupInterface $setup
     * @throws \Zend_Db_Exception
     */
    private function createRequestTableLog(ModuleDataSetupInterface $setup)
    {
        $table = $setup->getConnection()
            ->newTable($setup->getTable('hz_price_monitoring_log'))
            ->addColumn(
                'id',
                Table::TYPE_INTEGER,
                null,
                ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
                'Entity Id'
            )
            ->addColumn(
                'url',
                Table::TYPE_TEXT,
                255,
                ['default' => null, 'nullable' => false],
                'Url'
            )
            ->addColumn(
                'price',
                Table::TYPE_INTEGER,
                null,
                ['default' => '0', 'nullable' => false],
                'Price Product'
            )
            ->addColumn(
                'created_at',
                Table::TYPE_TIMESTAMP,
                null,
                ['default' => Table::TIMESTAMP_INIT_UPDATE, 'nullable' => true],
                'Created Log'
            );
        $setup->getConnection()->createTable($table);
    }
}
