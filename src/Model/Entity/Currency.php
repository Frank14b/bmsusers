<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Currency Entity
 *
 * @property int $id
 * @property string $shortname
 * @property string $longname
 * @property string $symbol
 * @property string $icon
 * @property string $status
 * @property \Cake\I18n\FrozenTime $created_at
 * @property \Cake\I18n\FrozenTime $updated_at
 *
 * @property \App\Model\Entity\Module[] $modules
 */
class Currency extends Entity
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
        'shortname' => true,
        'longname' => true,
        'symbol' => true,
        'icon' => true,
        'status' => true,
        'created_at' => true,
        'updated_at' => true,
        'modules' => true,
    ];
}
