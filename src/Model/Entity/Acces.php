<?php

declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Acces Entity
 *
 * @property int $id
 * @property string $title
 * @property string $middleware
 * @property string $apiroute
 * @property string|null $description
 * @property string $status
 * @property \Cake\I18n\FrozenTime $created_at
 * @property \Cake\I18n\FrozenTime $updated_at
 *
 * @property \App\Model\Entity\Roleacces[] $roleaccess
 */
class Acces extends Entity
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
        'title' => true,
        'middleware' => true,
        'apiroute' => true,
        'description' => true,
        'status' => true,
        'coverage' => true,
        'created_at' => true,
        'updated_at' => true,
        'roleaccess' => true,
    ];
    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array<string>
     */
    protected $_hidden = [
        'coverage',
        'apiroute'
    ];
}
