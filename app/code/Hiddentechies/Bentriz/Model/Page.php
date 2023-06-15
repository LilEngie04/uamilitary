<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Hiddentechies\Bentriz\Model;

use Exception;
use Magento\Cms\Model\PageFactory;
use Magento\Framework\File\Csv;
use Magento\Framework\Setup\SampleData\Context as SampleDataContext;
use Magento\Framework\Setup\SampleData\FixtureManager;
use Magento\Store\Model\Store;

class Page
{
    /**
     * @var FixtureManager
     */
    private FixtureManager $fixtureManager;

    /**
     * @var Csv
     */
    protected Csv $csvReader;

    /**
     * @var PageFactory
     */
    protected PageFactory $pageFactory;

    /**
     * @param SampleDataContext $sampleDataContext
     * @param PageFactory $pageFactory
     */
    public function __construct(
        SampleDataContext $sampleDataContext,
        PageFactory $pageFactory
    ) {
        $this->fixtureManager = $sampleDataContext->getFixtureManager();
        $this->csvReader = $sampleDataContext->getCsvReader();
        $this->pageFactory = $pageFactory;
    }

    /**
     * @param array $fixtures
     * @throws Exception
     */
    public function install(array $fixtures): void
    {
        foreach ($fixtures as $fileName) {
            $fileName = $this->fixtureManager->getFixture($fileName);
            if (!file_exists($fileName)) {
                continue;
            }

            $rows = $this->csvReader->getData($fileName);
            $header = array_shift($rows);

            foreach ($rows as $row) {
                $data = [];
                foreach ($row as $key => $value) {
                    $data[$header[$key]] = $value;
                }
                $row = $data;

                $this->pageFactory->create()
                    ->load($row['identifier'], 'identifier')
                    ->addData($row)
                    ->setStores([Store::DEFAULT_STORE_ID])
                    ->save();
            }
        }
    }
}
