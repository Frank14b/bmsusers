<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller\Api;

use App\Controller\Api\UserBranchsController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\Api\UserBranchsController Test Case
 *
 * @uses \App\Controller\Api\UserBranchsController
 */
class UserBranchsControllerTest extends TestCase
{
    use IntegrationTestTrait;

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
}
