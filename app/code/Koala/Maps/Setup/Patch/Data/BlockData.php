<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Koala\Maps\Setup\Patch\Data;

use Magento\Cms\Api\BlockRepositoryInterface;
use Magento\Cms\Model\BlockFactory;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;

/**
* Patch is mechanism, that allows to do atomic upgrade data changes
*/
class BlockData implements DataPatchInterface
{
    /**
     * @var ModuleDataSetupInterface
     */
    private $moduleDataSetup;

    /**
     * @var BlockFactory
     */
    private $blockFactory;

    /**
     * @var BlockRepositoryInterface
     */
    private $blockRepository;

    /**
     * @param ModuleDataSetupInterface $moduleDataSetup
     */
    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        BlockFactory $blockFactory,
        BlockRepositoryInterface $blockRepository
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->blockFactory = $blockFactory;
        $this->blockRepository = $blockRepository;
    }

    /**
     * Do Upgrade
     *
     * @return void
     */
    public function apply()
    {
        $this->moduleDataSetup->startSetup();
        $this->createBlockCMS();
        $this->moduleDataSetup->endSetup();
    }

    public function createBlockCMS()
    {
        /** @var \Magento\Cms\Model\Block $block */
        $block = $this->blockFactory->create();
        $block->setTitle('Maps Koala Store');
        $block->setIdentifier('Maps_Koala_Store');
        $block->setContent('<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d14626.181601914159!2d-46.6711879!3d-23.5847652!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xe2c327cf0bc2f68c!2sWebjump%20Design%20em%20Inform%C3%A1tica!5e0!3m2!1spt-BR!2sbr!4v1611249191345!5m2!1spt-BR!2sbr" width="100%" height="300" frameborder="0" style="border:0;" allowfullscreen=""></iframe>');
        $block->setIsActive(true);

        $this->blockRepository->save($block);
    }

    /**
     * @inheritdoc
     */
    public function getAliases(): array
    {
        return [];
    }

    /**
     * @inheritdoc
     */
    public static function getDependencies(): array
    {
        return [];
    }
}