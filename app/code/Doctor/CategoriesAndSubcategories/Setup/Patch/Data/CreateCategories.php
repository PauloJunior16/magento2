<?php declare(strict_types=1);

namespace Doctor\CategoriesAndSubcategories\Setup\Patch\Data;

use Magento\Catalog\Helper\DefaultCategory;
use Magento\Catalog\Model\CategoryFactory;
use Magento\Catalog\Model\CategoryRepository;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;

/**
 * Class CreateCategories
 *
 * @package Doctor\CategoriesAndSubcategories\Setup\Patch\Data
 */
class CreateCategories implements DataPatchInterface
{
    /**
     * @var ModuleDataSetupInterface
     */
    private $setup;

    /** @var CategoryFactory */
    private $categoryFactory;

    /** @var DefaultCategory */
    private $defaultCategoryHelper;

    /** @var CategoryRepository */
    private $categoryRepository;

    /**
     * CreateAllCategories constructor.
     *
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
     * @inheritDoc
     */
    public static function getDependencies(): array
    {
        return [];
    }

    /**
     * @inheritDoc
     */
    public function getAliases(): array
    {
        return [];
    }

    /**
     * @inheritDoc
     * @throws \Magento\Framework\Exception\CouldNotSaveException
     */
    public function apply(): void
    {
        $this->setup->startSetup();
        $this->createCategories($this->categoryDoctorFit());
        $this->createCategories($this->subcategoriesOfDoctorFit());
        $this->setup->endSetup();
    }

    /**
     * Method for create all categories and subcategories
     *
     * @param array $categories
     * @throws \Magento\Framework\Exception\CouldNotSaveException
     */
    private function createCategories(array $categories): void
    {
        foreach ($categories as $item) {
            $category = $this->categoryFactory->create();
            $category
                ->setData($item)
                ->setAttributeSetId($category->getDefaultAttributeSetId());
            $this->categoryRepository->save($category);
        }
    }

    /**
     * Method for create category DoctorFit
     * @return array
     */
    private function categoryDoctorFit(): array
    {
        $parentId = $this->defaultCategoryHelper->getId();
        $parentCategory = $this->categoryFactory->create();
        $parentCategory = $parentCategory->load($parentId);
        $categories = [];
        $categories[] = [
            'name' => 'Doctor Fit',
            'url_key' => 'doctor_fit',
            'is_active' => true,
            'is_anchor' => true,
            'include_in_menu' => true,
            'display_mode' => 'PRODUCTS_AND_PAGE',
            'parent_id' => $parentCategory->getId()
        ];
        return $categories;
    }

    /**
     * Method for create subcategorie Proteínas
     *
     * @return array
     */
    private function subcategoriesOfDoctorFit(): array
    {
        $category = $this->categoryFactory->create();
        $parentCategory = $category->loadByAttribute('url_key', 'proteinas');
        $categories = [];
        $categories[] = [
            'name' => 'Proteínas',
            'url_key' => 'proteinas',
            'active' => true,
            'is_anchor' => true,
            'include_in_menu' => true,
            'display_mode' => 'PRODUCTS_AND_PAGE',
            'is_active' => true,
            'parent_id' => $parentCategory
        ];
        return $categories;
    }

    /**
     * Method for create subcategorie Vitaminas
     *
     * @return array
     */

    private function subcategoriesOfVitaminas(): array
    {
        $category = $this->categoryFactory->create();
        $parentCategory = $category->loadByAttribute('url_key', 'vitaminas');
        $categories = [];
        $categories[] = [
            'name' => 'Vitaminas',
            'url_key' => 'vitaminas',
            'active' => true,
            'is_anchor' => true,
            'include_in_menu' => true,
            'display_mode' => 'PRODUCTS_AND_PAGE',
            'is_active' => true,
            'parent_id' => $parentCategory
        ];
        return $categories;
    }
}
