<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * PackagesFixture
 */
class PackagesFixture extends TestFixture
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
                'name' => 'Lorem ipsum dolor sit amet',
                'description' => 'Lorem ipsum dolor sit amet',
                'price' => 1,
                'validity' => 1,
                'period' => 'Lorem ipsum dolor sit amet',
                'cloudstorage' => 1,
                'cloudunit' => 'Lorem ipsum dolor sit amet',
                'status' => 'Lorem ipsum dolor sit amet',
                'created_at' => 1674329403,
                'updated_at' => 1674329403,
            ],
        ];
        parent::init();
    }
}
