<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Access Model
 *
 * @property \App\Model\Table\RoleaccessTable&\Cake\ORM\Association\HasMany $Roleaccess
 *
 * @method \App\Model\Entity\Acces newEmptyEntity()
 * @method \App\Model\Entity\Acces newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Acces[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Acces get($primaryKey, $options = [])
 * @method \App\Model\Entity\Acces findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Acces patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Acces[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Acces|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Acces saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Acces[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Acces[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Acces[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Acces[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class AccessTable extends Table
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

        $this->setTable('access');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->hasMany('Roleaccess', [
            'foreignKey' => 'acces_id',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->scalar('title')
            ->maxLength('title', 255)
            ->requirePresence('title', 'create')
            ->notEmptyString('title');

        $validator
            ->scalar('middleware')
            ->maxLength('middleware', 255)
            ->requirePresence('middleware', 'create')
            ->notEmptyString('middleware');

        $validator
            ->scalar('apiroute')
            ->maxLength('apiroute', 255)
            ->requirePresence('apiroute', 'create')
            ->notEmptyString('apiroute');

        $validator
            ->scalar('description')
            ->maxLength('description', 255)
            ->allowEmptyString('description');

        $validator
            ->scalar('status')
            ->notEmptyString('status');

        $validator
            ->dateTime('created_at')
            ->notEmptyDateTime('created_at');

        $validator
            ->dateTime('updated_at')
            ->notEmptyDateTime('updated_at');

        return $validator;
    }
}
