<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ActivityMetadatasTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ActivityMetadatasTable Test Case
 */
class ActivityMetadatasTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ActivityMetadatasTable
     */
    protected $ActivityMetadatas;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.ActivityMetadatas',
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
        $config = $this->getTableLocator()->exists('ActivityMetadatas') ? [] : ['className' => ActivityMetadatasTable::class];
        $this->ActivityMetadatas = $this->getTableLocator()->get('ActivityMetadatas', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->ActivityMetadatas);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\ActivityMetadatasTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\ActivityMetadatasTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
