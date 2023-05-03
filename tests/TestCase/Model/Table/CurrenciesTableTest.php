<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CurrenciesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CurrenciesTable Test Case
 */
class CurrenciesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\CurrenciesTable
     */
    protected $Currencies;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Currencies',
        'app.Modules',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Currencies') ? [] : ['className' => CurrenciesTable::class];
        $this->Currencies = $this->getTableLocator()->get('Currencies', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Currencies);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\CurrenciesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\CurrenciesTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
