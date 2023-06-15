<?php

/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Hiddentechies\Bentriz\Setup;

use Hiddentechies\Bentriz\Model\Block;
use Hiddentechies\Bentriz\Model\Page;
use Magento\Framework\Setup;

class Installer implements Setup\SampleData\InstallerInterface {

    /**
     * @var \Magento\CmsSampleData\Model\Page|Page
     */
    private \Magento\CmsSampleData\Model\Page|Page $page;

    /**
     * @var \Magento\CmsSampleData\Model\Block
     */
    private \Magento\CmsSampleData\Model\Block|Block $block;

    /**
     * @param Page $page
     * @param Block $block
     */
    public function __construct(
    Page $page,
            Block $block
    ) {
        $this->page = $page;
        $this->block = $block;
    }

    /**
     * {@inheritdoc}
     */
    public function install() {

        //$this->page->install(['Hiddentechies_Bentriz::fixtures/pages/pages.csv']);
        $this->page->install(
                [

                    'Hiddentechies_Bentriz::DemoPages/pages.csv',
                ]
        );
        $this->block->install(
                [

                    'Hiddentechies_Bentriz::DemoBlocks/blocks.csv',
                ]
        );
    }

}
