<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller\Api;

use App\Controller\Api\BusinessPackagesController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\Api\BusinessPackagesController Test Case
 *
 * @uses \App\Controller\Api\BusinessPackagesController
 */
class BusinessPackagesControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.BusinessPackages',
        'app.Packages',
        'app.Users',
    ];
}
