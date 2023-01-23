<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * UserBranch Entity
 *
 * @property int $id
 * @property int $branch_id
 * @property string $user_id
 * @property string $role_id
 * @property string $status
 * @property \Cake\I18n\FrozenTime $created_at
 * @property \Cake\I18n\FrozenTime $updated_at
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Role $role
 */
class UserBranch extends Entity
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
        'branch_id' => true,
        'user_id' => true,
        'role_id' => true,
        'status' => true,
        'created_at' => true,
        'updated_at' => true,
        'user' => true,
        'role' => true,
    ];
}
