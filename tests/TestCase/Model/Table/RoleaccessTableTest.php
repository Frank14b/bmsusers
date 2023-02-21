<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RoleaccessTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RoleaccessTable Test Case
 */
class RoleaccessTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\RoleaccessTable
     */
    protected $Roleaccess;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Roleaccess',
        'app.Roles',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Roleaccess') ? [] : ['className' => RoleaccessTable::class];
        $this->Roleaccess = $this->getTableLocator()->get('Roleaccess', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Roleaccess);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\RoleaccessTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\RoleaccessTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
