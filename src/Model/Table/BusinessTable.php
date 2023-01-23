<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Business Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\PackagesTable&\Cake\ORM\Association\BelongsToMany $Packages
 *
 * @method \App\Model\Entity\Busines newEmptyEntity()
 * @method \App\Model\Entity\Busines newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Busines[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Busines get($primaryKey, $options = [])
 * @method \App\Model\Entity\Busines findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Busines patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Busines[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Busines|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Busines saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Busines[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Busines[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Busines[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Busines[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class BusinessTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('business');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsToMany('Packages', [
            'foreignKey' => 'busines_id',
            'targetForeignKey' => 'package_id',
            'joinTable' => 'business_packages',
        ]);
    }
}
