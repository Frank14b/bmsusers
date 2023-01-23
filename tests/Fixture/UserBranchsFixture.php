<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * UserBranchsFixture
 */
class UserBranchsFixture extends TestFixture
{
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
                'branch_id' => 1,
                'user_id' => 'Lorem ipsum dolor sit amet',
                'role_id' => 'Lorem ipsum dolor sit amet',
                'status' => 'Lorem ipsum dolor sit amet',
                'created_at' => 1674329299,
                'updated_at' => 1674329299,
            ],
        ];
        parent::init();
    }
}
