<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CurrenciesFixture
 */
class CurrenciesFixture extends TestFixture
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
                'shortname' => 'Lorem ipsum dolor sit amet',
                'longname' => 'Lorem ipsum dolor sit amet',
                'symbol' => 'Lorem ipsum dolor sit amet',
                'icon' => 'Lorem ipsum dolor sit amet',
                'status' => 'Lorem ipsum dolor sit amet',
                'created_at' => 1677225681,
                'updated_at' => 1677225681,
            ],
        ];
        parent::init();
    }
}
