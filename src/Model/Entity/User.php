<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\Entity;

/**
 * User Entity
 *
 * @property int $id
 * @property string $firstname
 * @property string|null $lastname
 * @property string $username
 * @property string $email
 * @property string $password
 * @property string|null $picture
 * @property string $status
 * @property string $role
 * @property \Cake\I18n\FrozenTime $created_at
 * @property \Cake\I18n\FrozenTime $updated_at
 *
 * @property \App\Model\Entity\Branch[] $branchs
 * @property \App\Model\Entity\Busines[] $business
 * @property \App\Model\Entity\BusinessPackage[] $business_packages
 * @property \App\Model\Entity\UserBranch[] $user_branchs
 */
class User extends Entity
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
        'firstname' => true,
        'lastname' => true,
        'username' => true,
        'email' => true,
        'password' => true,
        'picture' => true,
        'status' => true,
        'role' => true,
        'created_at' => true,
        'updated_at' => true,
        'branchs' => false,
        'business' => false,
        'business_packages' => false,
        'user_branchs' => false,
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array<string>
     */
    protected $_hidden = [
        'password',
        'role'
    ];

    protected function _setPassword($password)
    {
        if (strlen($password) > 0) {
            return (new DefaultPasswordHasher)->hash($password);
        }
    }
}
