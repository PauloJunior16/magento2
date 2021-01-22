<?php

namespace Koala\Attributes\Setup\Patch\Data;

use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\Patch\PatchRevertableInterface;

class CreateAttributes implements DataPatchInterface, PatchRevertableInterface
{
    const ATTRIBUTE_CODE = 'product_type';

    private $moduleDataSetup;

    private $eavSetupFactory;

    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        EavSetupFactory   $eavSetupFactory
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->eavSetupFactory = $eavSetupFactory;
    }

    public static function getDependencies(): array
    {
        return [];
    }

    public function getAliases(): array
    {
        return [];
    }

    public function apply(): void
    {
        $this->moduleDataSetup->getConnection()->startSetup();
        $eavSetup = $this->eavSetupFactory->create(['setup' => $this->moduleDataSetup]);

        $productTypes = \Magento\Catalog\Model\Product\Type::TYPE_SIMPLE;
        $eavSetup->addAttribute(
            \Magento\Catalog\Model\Product::ENTITY,
            self::ATTRIBUTE_CODE,
            [
                'type' => 'text',
                'label' => 'Koala Product',
                'input' => 'select',
                'source' => '',
                'frontend' => '',
                'required' => false,
                'backend' => '',
                'sort_order' => '81',
                'global' => ScopedAttributeInterface::SCOPE_WEBSITE,
                'default_value' => null,
                'visible' => true,
                'user_defined' => true,
                'searchable' => false,
                'filterable' => true,
                'comparable' => false,
                'visible_on_front' => true,
                'unique' => false,
                'apply_to' => $productTypes,
                'group' => 'General',
                'used_in_product_listing' => false,
                'is_used_in_grid' => true,
                'is_visible_in_grid' => true,
                'is_filterable_in_grid' => true,
                'attribute_code' => 'clothing',
                'option' => [
                    'value' => [
                        'option_1' => ['Pants'],
                        'option_2' => ['T-Shirts'],
                        'option_3' => ['Shoes'],
                        'option_4' => ['Bags'],
                        'option_5' => ['Backpacks']
                    ],
                    'order' => [
                        'option_1' => 1,
                        'option_2' => 2,
                        'option_3' => 3,
                        'option_4' => 4,
                        'option_5' => 5
                    ],
                ]
            ]
        );

        $eavSetup->addAttribute(
            \Magento\Catalog\Model\Product::ENTITY,
            'fashion',
            [
                'type' => 'text',
                'label' => 'Fashion Style',
                'input' => 'select',
                'source' => '',
                'frontend' => '',
                'required' => false,
                'backend' => '',
                'sort_order' => '82',
                'global' => ScopedAttributeInterface::SCOPE_WEBSITE,
                'default_value' => null,
                'visible' => true,
                'user_defined' => true,
                'searchable' => false,
                'filterable' => true,
                'comparable' => false,
                'visible_on_front' => true,
                'unique' => false,
                'apply_to' => $productTypes,
                'group' => 'General',
                'used_in_product_listing' => false,
                'is_used_in_grid' => true,
                'is_visible_in_grid' => true,
                'is_filterable_in_grid' => true,
                'attribute_code' => 'fashion',
                'option' => [
                    'value' => [
                        'option_1' => ['Street Wear'],
                        'option_2' => ['Sports Wear'],
                        'option_3' => ['Casual Wear']
                    ],
                    'order' => [
                        'option_1' => 1,
                        'option_2' => 2,
                        'option_3' => 3,
                    ],
                ]
            ]
        );

        $this->moduleDataSetup->getConnection()->endSetup();
    }

    public function revert()
    {
        $this->moduleDataSetup->getConnection()->startSetup();
        $eavSetup = $this->eavSetupFactory->create(['setup' => $this->moduleDataSetup]);
        $eavSetup->removeAttribute(\Magento\Catalog\Model\Product::ENTITY, self::ATTRIBUTE_CODE);
        $this->moduleDataSetup->getConnection()->endSetup();
    }
}
