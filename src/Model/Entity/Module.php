<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Module Entity
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property string|null $reference
 * @property int $activity_id
 * @property int $price
 * @property int $price_range
 * @property string $validity
 * @property int $currency_id
 * @property string $status
 * @property \Cake\I18n\FrozenTime $created_at
 * @property \Cake\I18n\FrozenTime $updated_at
 *
 * @property \App\Model\Entity\Activity $activity
 * @property \App\Model\Entity\Currency $currency
 */
class Module extends Entity
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
        'name' => true,
        'description' => true,
        'reference' => true,
        'activity_id' => true,
        'price' => true,
        'price_range' => true,
        'validity' => true,
        'currency_id' => true,
        'status' => true,
        'created_at' => true,
        'updated_at' => true,
        'activity' => true,
        'currency' => true,
    ];
}
