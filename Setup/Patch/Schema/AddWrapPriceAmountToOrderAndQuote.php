<?php
/**
 * @author     Pavel Usachev <pausachev@gmail.com>
 * @copyright  2019 Pavel Usachev
 * @license    https://opensource.org/licenses/BSD-3-Clause  BSD-3-Clause
 */
namespace ALevel\CustomTotal\Setup\Patch\Schema;

use Magento\Framework\Setup\Patch\SchemaPatchInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;

/**
 * Class AddWrapPriceAmountToOrderAndQuote
 * @package ALevel\CustomTotal\Setup\Patch\Schema
 */
class AddWrapPriceAmountToOrderAndQuote implements SchemaPatchInterface
{
    /**
     * @var SchemaSetupInterface
     */
    private $schemaSetup;

    /**
     * EnableSegmentation constructor.
     *
     * @param SchemaSetupInterface $schemaSetup
     */
    public function __construct(
        SchemaSetupInterface $schemaSetup
    ) {
        $this->schemaSetup = $schemaSetup;
    }

    /**
     * @inheritDoc
     */
    public static function getDependencies()
    {
        return [];
    }

    /**
     * @inheritDoc
     */
    public function getAliases()
    {
        return [];
    }

    /**
     * @inheritDoc
     */
    public function apply()
    {
        $columns = [
            'quote' => [
                'wrap_total_amount' => [
                    'type' => Table::TYPE_DECIMAL,
                    'nullable' => false,
                    'default'  => 0.0,
                    'comment'  => 'Wrap price'
                ],
                'base_wrap_total_amount'=> [
                    'type' => Table::TYPE_DECIMAL,
                    'nullable' => false,
                    'default'  => 0.0,
                    'comment'  => 'Base Wrap price'
                ]
            ],
            'quote_address' => [
                'wrap_total_amount'=> [
                    'type' => Table::TYPE_DECIMAL,
                    'nullable' => false,
                    'default'  => 0.0,
                    'comment'  => 'Wrap price'
                ],
                'base_wrap_total_amount' => [
                    'type' => Table::TYPE_DECIMAL,
                    'nullable' => false,
                    'default'  => 0.0,
                    'comment'  => 'Base Wrap price'
                ]
            ],
            'sales_order' => [
                'wrap_total_amount'=> [
                    'type' => Table::TYPE_DECIMAL,
                    'nullable' => false,
                    'default'  => 0.0,
                    'comment'  => 'Wrap price'
                ],
                'base_wrap_total_amount' => [
                    'type' => Table::TYPE_DECIMAL,
                    'nullable' => false,
                    'default'  => 0.0,
                    'comment'  => 'Base Wrap price'
                ]
            ],
        ];

        $connection = $this->schemaSetup->getConnection();

        foreach ($columns as $tableName => $columnData) {
            foreach ($columnData as $columnName => $definition) {
                $connection->addColumn(
                    $connection->getTableName($tableName),
                    $columnName,
                    $definition
                );
            }
        }
    }
}
