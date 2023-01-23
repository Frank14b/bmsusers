<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\BranchsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\BranchsTable Test Case
 */
class BranchsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\BranchsTable
     */
    protected $Branchs;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Branchs',
        'app.Users',
        'app.UserBranchs',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Branchs') ? [] : ['className' => BranchsTable::class];
        $this->Branchs = $this->getTableLocator()->get('Branchs', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Branchs);

        parent::tearDown();
    }
}
