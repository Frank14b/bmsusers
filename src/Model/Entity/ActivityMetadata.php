<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ActivityMetadata Entity
 *
 * @property int $id
 * @property int $activity_id
 * @property string $metakey
 * @property string $metavalue
 * @property string|null $extra
 * @property string $unicity
 * @property string $status
 * @property \Cake\I18n\FrozenTime $created_at
 * @property \Cake\I18n\FrozenTime $updated_at
 *
 * @property \App\Model\Entity\Activity $activity
 */
class ActivityMetadata extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected $_accessible = [
        'activity_id' => true,
        'metakey' => true,
        'metavalue' => true,
        'extra' => true,
        'unicity' => true,
        'status' => true,
        'created_at' => true,
        'updated_at' => true,
        'activity' => true,
    ];
}
