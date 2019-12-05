<?php
/**
 * @author     Pavel Usachev <pausachev@gmail.com>
 * @copyright  2019 Pavel Usachev
 * @license    https://opensource.org/licenses/BSD-3-Clause  BSD-3-Clause
 */
namespace ALevel\CustomTotal\Setup\Patch\Data;

use Magento\Catalog\Model\Product;
use Magento\Catalog\Model\Product\Attribute\Backend\Price;
use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\Patch\PatchInterface;

/**
 * Class AddWrapProductAttributes
 * @package ALevel\CustomTotal\Setup\Patch\Data
 */
class AddWrapProductAttributes implements DataPatchInterface
{
    /**
     * @var EavSetupFactory
     */
    private $eavSetupFactory;

    /**
     * AddWrapProductAttributes constructor.
     * @param EavSetupFactory $eavSetupFactory
     */
    public function __construct(EavSetupFactory $eavSetupFactory)
    {
        $this->eavSetupFactory = $eavSetupFactory;
    }

    /** {@inheritDoc} */
    public static function getDependencies()
    {
        return [];
    }

    /** {@inheritDoc} */
    public function getAliases()
    {
        return [];
    }

    /** {@inheritDoc} */
    public function apply()
    {

        $setup = $this->eavSetupFactory->create();
        $setup->addAttribute(
            Product::ENTITY,
            'is_wrapped',
            [
                'group' => 'General',
                'type' => 'int',
                'label' => 'Is Wrapped',
                'input' => 'boolean',
                'source' => '',
                'frontend' => '',
                'backend' => '',
                'required' => false,
                'sort_order' => 50,
                'global' => ScopedAttributeInterface::SCOPE_GLOBAL,
                'is_used_in_grid' => true,
                'is_visible_in_grid' => true,
                'is_filterable_in_grid' => true,
                'visible' => true,
                'is_html_allowed_on_front' => false,
                'visible_on_front' => true,
                ]
        );

        $setup->addAttribute(
            Product::ENTITY,
            'wrapped_price',
            [
                'group' => 'General',
                'type' => 'decimal',
                'label' => 'Wrap price',
                'input' => 'price',
                'source' => '',
                'frontend' => '',
                'backend' => Price::class,
                'required' => false,
                'sort_order' => 50,
                'global' => ScopedAttributeInterface::SCOPE_GLOBAL,
                'is_used_in_grid' => true,
                'is_visible_in_grid' => true,
                'is_filterable_in_grid' => true,
                'visible' => true,
                'is_html_allowed_on_front' => false,
                'visible_on_front' => true,
            ]
        );
    }
}
