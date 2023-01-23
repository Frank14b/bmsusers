<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\BusinessPackagesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\BusinessPackagesTable Test Case
 */
class BusinessPackagesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\BusinessPackagesTable
     */
    protected $BusinessPackages;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.BusinessPackages',
        'app.Packages',
        'app.Users',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('BusinessPackages') ? [] : ['className' => BusinessPackagesTable::class];
        $this->BusinessPackages = $this->getTableLocator()->get('BusinessPackages', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->BusinessPackages);

        parent::tearDown();
    }
}
