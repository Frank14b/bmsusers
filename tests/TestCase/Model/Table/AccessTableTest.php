<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AccessTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AccessTable Test Case
 */
class AccessTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\AccessTable
     */
    protected $Access;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Access',
        'app.Roleaccess',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Access') ? [] : ['className' => AccessTable::class];
        $this->Access = $this->getTableLocator()->get('Access', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Access);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\AccessTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
