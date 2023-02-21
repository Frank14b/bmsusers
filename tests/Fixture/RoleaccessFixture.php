<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * RoleaccessFixture
 */
class RoleaccessFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'roleaccess';
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'role_id' => 1,
                'acces_id' => 1,
                'status' => 'Lorem ipsum dolor sit amet',
                'created_at' => 1677003515,
                'updated_at' => 1677003515,
            ],
        ];
        parent::init();
    }
}
