<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ModulesFixture
 */
class ModulesFixture extends TestFixture
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
                'reference' => 'Lorem ipsum dolor sit amet',
                'activity_id' => 1,
                'price' => 1,
                'price_range' => 1,
                'validity' => 'Lorem ipsum dolor sit amet',
                'currency_id' => 1,
                'status' => 'Lorem ipsum dolor sit amet',
                'created_at' => 1677225691,
                'updated_at' => 1677225691,
            ],
        ];
        parent::init();
    }
}
