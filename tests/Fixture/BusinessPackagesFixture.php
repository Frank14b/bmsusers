<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * BusinessPackagesFixture
 */
class BusinessPackagesFixture extends TestFixture
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
                'busines_id' => 1,
                'package_id' => 1,
                'user_id' => 1,
                'price' => 1,
                'validity' => 1,
                'period' => 'Lorem ipsum dolor sit amet',
                'cloudstorage' => 1,
                'cloudunit' => 'Lorem ipsum dolor sit amet',
                'status' => 'Lorem ipsum dolor sit amet',
                'created_at' => 1674329445,
                'updated_at' => 1674329445,
            ],
        ];
        parent::init();
    }
}
