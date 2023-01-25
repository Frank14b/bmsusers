<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Branch Entity
 *
 * @property int $id
 * @property string $name
 * @property int $user_id
 * @property int $busines_id
 * @property string|null $description
 * @property string|null $phone
 * @property string|null $email
 * @property string $status
 * @property \Cake\I18n\FrozenTime $created_at
 * @property \Cake\I18n\FrozenTime $updated_at
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\UserBranch[] $user_branchs
 */
class Branch extends Entity
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
        'user_id' => true,
        'busines_id' => true,
        'description' => true,
        'phone' => true,
        'email' => true,
        'status' => true,
        'created_at' => true,
        'updated_at' => true,
        'user' => true,
        'user_branchs' => true,
        'busines' => true
    ];
}
