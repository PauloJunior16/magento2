<?php declare(strict_types=1);

namespace Doctor\CreateCategories\Setup\Patch\Data;

use Magento\Catalog\Helper\DefaultCategory;
use Magento\Catalog\Model\CategoryFactory;
use Magento\Catalog\Model\CategoryRepository;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;

class CreateCategories implements DataPatchInterface
{
    /**
     * @var ModuleDataSetupInterface
     */
    private $setup;

    /**
     * @var CategoryFactory
     */
    private $categoryFactory;

    /**
     * @var DefaultCategory
     */
    private $defaultCategoryHelper;

    /**
     * @var CategoryRepository
     */
    private $categoryRepository;

    /**
     * CreateCategories constructor.
     * @param ModuleDataSetupInterface $setup
     * @param CategoryFactory $categoryFactory
     * @param DefaultCategory $defaultCategoryHelper
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(
        ModuleDataSetupInterface $setup,
        CategoryFactory $categoryFactory,
        DefaultCategory $defaultCategoryHelper,
        CategoryRepository $categoryRepository
    ) {
        $this->setup = $setup;
        $this->categoryFactory = $categoryFactory;
        $this->defaultCategoryHelper = $defaultCategoryHelper;
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @return array
     */
    public static function getDependencies(): array
    {
        return [];
    }

    /**
     * @return array
     */
    public function getAliases(): array
    {
        return [];
    }

    /**
     * @return CreateCategories|void
     */
    public function apply()
    {
        $this->setup->startSetup();
        $this->createCategories($this->categoryCerealsBr());
        $this->createCategories($this->categoryGrainsBr());
        $this->createCategories($this->categoryTeasBr());
        $this->setup->endSetup();
    }

    /**
     * @param array $categories
     * @throws \Magento\Framework\Exception\CouldNotSaveException
     */
    private function createCategories(array $categories)
    {
        foreach ($categories as $item) {
            $category = $this->categoryFactory->create();
            $category
                ->setData($item)
                ->setStoreId(1)
                ->setAttributeSetId($category->getDefaultAttributeSetId());
            $this->categoryRepository->save($category);
        }
    }

    /**
     * @return array
     */
    private function categoryCerealsBr():array
    {
        $parentId = $this->defaultCategoryHelper->getId();
        $parentCategory = $this->categoryFactory->create();
        $parentCategory = $parentCategory->load($parentId);
        $categories = [];

        $categories[] = [
          'name' => 'Cereais',
          'url_key' => 'cereais_doctor',
          'is_active' => true,
          'is_anchor' => true,
          'include_in_menu' => true,
          'display_mode' => 'PRODUCTS_AND_PAGE',
          'parent_id' =>$parentCategory->getId()
        ];

        return $categories;
    }

    /**
     * @return array
     */
    private function categoryGrainsBr():array
    {
        $parentId = $this->defaultCategoryHelper->getId();
        $parentCategory = $this->categoryFactory->create();
        $parentCategory = $parentCategory->load($parentId);
        $categories = [];

        $categories[] = [
            'name' => 'Grãos',
            'url_key' => 'graos_doctor',
            'is_active' => true,
            'is_anchor' => true,
            'include_in_menu' => true,
            'display_mode' => 'PRODUCTS_AND_PAGE',
            'parent_id' =>$parentCategory->getId()
        ];

        return $categories;
    }

    /**
     * @return array
     */
    private function categoryTeasBr():array
    {
        $parentId = $this->defaultCategoryHelper->getId();
        $parentCategory = $this->categoryFactory->create();
        $parentCategory = $parentCategory->load($parentId);
        $categories = [];

        $categories[] = [
            'name' => 'Chás',
            'url_key' => 'chas_doctor',
            'is_active' => true,
            'is_anchor' => true,
            'include_in_menu' => true,
            'display_mode' => 'PRODUCTS_AND_PAGE',
            'parent_id' =>$parentCategory->getId()
        ];

        return $categories;
    }
}