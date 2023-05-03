<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ActivityTypesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ActivityTypesTable Test Case
 */
class ActivityTypesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ActivityTypesTable
     */
    protected $ActivityTypes;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.ActivityTypes',
        'app.Activities',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('ActivityTypes') ? [] : ['className' => ActivityTypesTable::class];
        $this->ActivityTypes = $this->getTableLocator()->get('ActivityTypes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->ActivityTypes);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\ActivityTypesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\ActivityTypesTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
