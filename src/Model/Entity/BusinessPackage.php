<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * BusinessPackage Entity
 *
 * @property int $id
 * @property int $busines_id
 * @property int $package_id
 * @property int $user_id
 * @property int $price
 * @property int $validity
 * @property string $period
 * @property int $cloudstorage
 * @property string $cloudunit
 * @property string $status
 * @property \Cake\I18n\FrozenTime $created_at
 * @property \Cake\I18n\FrozenTime $updated_at
 *
 * @property \App\Model\Entity\Package $package
 * @property \App\Model\Entity\User $user
 */
class BusinessPackage extends Entity
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
        'busines_id' => true,
        'package_id' => true,
        'user_id' => true,
        'price' => true,
        'validity' => true,
        'period' => true,
        'cloudstorage' => true,
        'cloudunit' => true,
        'status' => true,
        'created_at' => true,
        'updated_at' => true,
        'package' => true,
        'user' => true,
    ];
}
