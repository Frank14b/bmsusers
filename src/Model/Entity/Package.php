<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Package Entity
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property int $price
 * @property int $validity
 * @property string $period
 * @property int $cloudstorage
 * @property string $cloudunit
 * @property string $status
 * @property \Cake\I18n\FrozenTime $created_at
 * @property \Cake\I18n\FrozenTime $updated_at
 *
 * @property \App\Model\Entity\Busines[] $business
 */
class Package extends Entity
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
        'price' => true,
        'validity' => true,
        'period' => true,
        'cloudstorage' => true,
        'cloudunit' => true,
        'status' => true,
        'created_at' => true,
        'updated_at' => true,
        'business' => true,
    ];
}
