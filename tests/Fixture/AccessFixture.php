<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * AccessFixture
 */
class AccessFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'access';
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
                'title' => 'Lorem ipsum dolor sit amet',
                'middleware' => 'Lorem ipsum dolor sit amet',
                'apiroute' => 'Lorem ipsum dolor sit amet',
                'description' => 'Lorem ipsum dolor sit amet',
                'status' => 'Lorem ipsum dolor sit amet',
                'created_at' => 1676995662,
                'updated_at' => 1676995662,
            ],
        ];
        parent::init();
    }
}
