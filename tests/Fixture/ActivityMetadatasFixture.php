<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ActivityMetadatasFixture
 */
class ActivityMetadatasFixture extends TestFixture
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
                'activity_id' => 1,
                'metakey' => 'Lorem ipsum dolor sit amet',
                'metavalue' => 'Lorem ipsum dolor sit amet',
                'extra' => 'Lorem ipsum dolor sit amet',
                'unicity' => 'Lorem ipsum dolor sit amet',
                'status' => 'Lorem ipsum dolor sit amet',
                'created_at' => 1677225656,
                'updated_at' => 1677225656,
            ],
        ];
        parent::init();
    }
}
