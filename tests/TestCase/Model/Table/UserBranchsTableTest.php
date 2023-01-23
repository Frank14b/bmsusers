<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\UserBranchsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\UserBranchsTable Test Case
 */
class UserBranchsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\UserBranchsTable
     */
    protected $UserBranchs;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.UserBranchs',
        'app.Users',
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
        $config = $this->getTableLocator()->exists('UserBranchs') ? [] : ['className' => UserBranchsTable::class];
        $this->UserBranchs = $this->getTableLocator()->get('UserBranchs', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->UserBranchs);

        parent::tearDown();
    }
}
