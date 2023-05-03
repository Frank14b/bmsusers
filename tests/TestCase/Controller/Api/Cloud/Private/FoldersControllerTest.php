<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller\Api\Cloud\Private;

use App\Controller\Api\Cloud\Private\FoldersController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\Api\Cloud\Private\FoldersController Test Case
 *
 * @uses \App\Controller\Api\Cloud\Private\FoldersController
 */
class FoldersControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Folders',
    ];

    /**
     * Test index method
     *
     * @return void
     * @uses \App\Controller\Api\Cloud\Private\FoldersController::index()
     */
    public function testIndex(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     * @uses \App\Controller\Api\Cloud\Private\FoldersController::view()
     */
    public function testView(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     * @uses \App\Controller\Api\Cloud\Private\FoldersController::add()
     */
    public function testAdd(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     * @uses \App\Controller\Api\Cloud\Private\FoldersController::edit()
     */
    public function testEdit(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     * @uses \App\Controller\Api\Cloud\Private\FoldersController::delete()
     */
    public function testDelete(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
