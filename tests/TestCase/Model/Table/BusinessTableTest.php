<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\BusinessTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\BusinessTable Test Case
 */
class BusinessTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\BusinessTable
     */
    protected $Business;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Business',
        'app.Users',
        'app.Packages',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Business') ? [] : ['className' => BusinessTable::class];
        $this->Business = $this->getTableLocator()->get('Business', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Business);

        parent::tearDown();
    }
}
