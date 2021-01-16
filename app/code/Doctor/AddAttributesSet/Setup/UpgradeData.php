<?php

namespace Doctor\AddAttributesSet\Setup;

use Magento\Catalog\Model\Product;
use Magento\Catalog\Setup\CategorySetupFactory;
use Magento\Eav\Model\Entity\Attribute\SetFactory;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\UpgradeDataInterface;

class UpgradeData implements UpgradeDataInterface
{
    private $setFactory;
    private $categorySetupFactory;

    public function __construct(
        SetFactory $setFactory,
        CategorySetupFactory $categorySetupFactory
    ) {
        $this->setFactory = $setFactory;
        $this->categorySetupFactory = $categorySetupFactory;
    }

    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        if (version_compare($context->getVersion(), '1.0.1', '<')) {

            $setup->startSetup();

            $categorySetup = $this->categorySetupFactory->create(['setup' => $setup]);
            $attributeSet = $this->setFactory->create();

            $entityTypeId = $categorySetup->getDefaultAttributeSetId(Product::ENTITY);
            $attributeSetId = $categorySetup->getDefaultAttributeSetId($entityTypeId);
            $data = [
                'attribute_set_name' => 'Cereais',
                'entity_type_id' => $entityTypeId,
                'sort_order' => 201,
            ];
            $attributeSet->setData($data);
            $attributeSet->validate();
            $attributeSet->save();
            $attributeSet->initFromSkeleton($attributeSetId);
            $attributeSet->save();

            $setup->endSetup();
        }

        if (version_compare($context->getVersion(), '1.0.2', '<')) {

            $setup->startSetup();

            $categorySetup = $this->categorySetupFactory->create(['setup' => $setup]);
            $attributeSet = $this->setFactory->create();

            $entityTypeId = $categorySetup->getDefaultAttributeSetId(Product::ENTITY);
            $attributeSetId = $categorySetup->getDefaultAttributeSetId($entityTypeId);
            $data = [
                'attribute_set_name' => 'Chás',
                'entity_type_id' => $entityTypeId,
                'sort_order' => 202,
            ];
            $attributeSet->setData($data);
            $attributeSet->validate();
            $attributeSet->save();
            $attributeSet->initFromSkeleton($attributeSetId);
            $attributeSet->save();

            $setup->endSetup();
        }

        if (version_compare($context->getVersion(), '1.0.2', '<')) {

            $setup->startSetup();

            $categorySetup = $this->categorySetupFactory->create(['setup' => $setup]);
            $attributeSet = $this->setFactory->create();

            $entityTypeId = $categorySetup->getDefaultAttributeSetId(Product::ENTITY);
            $attributeSetId = $categorySetup->getDefaultAttributeSetId($entityTypeId);
            $data = [
                'attribute_set_name' => 'Ervas',
                'entity_type_id' => $entityTypeId,
                'sort_order' => 203,
            ];
            $attributeSet->setData($data);
            $attributeSet->validate();
            $attributeSet->save();
            $attributeSet->initFromSkeleton($attributeSetId);
            $attributeSet->save();

            $setup->endSetup();
        }

        if (version_compare($context->getVersion(), '1.0.2', '<')) {

            $setup->startSetup();

            $categorySetup = $this->categorySetupFactory->create(['setup' => $setup]);
            $attributeSet = $this->setFactory->create();

            $entityTypeId = $categorySetup->getDefaultAttributeSetId(Product::ENTITY);
            $attributeSetId = $categorySetup->getDefaultAttributeSetId($entityTypeId);
            $data = [
                'attribute_set_name' => 'Frutas Secas',
                'entity_type_id' => $entityTypeId,
                'sort_order' => 204,
            ];
            $attributeSet->setData($data);
            $attributeSet->validate();
            $attributeSet->save();
            $attributeSet->initFromSkeleton($attributeSetId);
            $attributeSet->save();

            $setup->endSetup();
        }

        if (version_compare($context->getVersion(), '1.0.2', '<')) {

            $setup->startSetup();

            $categorySetup = $this->categorySetupFactory->create(['setup' => $setup]);
            $attributeSet = $this->setFactory->create();

            $entityTypeId = $categorySetup->getDefaultAttributeSetId(Product::ENTITY);
            $attributeSetId = $categorySetup->getDefaultAttributeSetId($entityTypeId);
            $data = [
                'attribute_set_name' => 'Castanhas',
                'entity_type_id' => $entityTypeId,
                'sort_order' => 205,
            ];
            $attributeSet->setData($data);
            $attributeSet->validate();
            $attributeSet->save();
            $attributeSet->initFromSkeleton($attributeSetId);
            $attributeSet->save();

            $setup->endSetup();
        }
    }
}
