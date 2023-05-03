<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Activities Model
 *
 * @property \App\Model\Table\ActivityTypesTable&\Cake\ORM\Association\BelongsTo $ActivityTypes
 * @property \App\Model\Table\ActivityMetadatasTable&\Cake\ORM\Association\HasMany $ActivityMetadatas
 * @property \App\Model\Table\ModulesTable&\Cake\ORM\Association\HasMany $Modules
 *
 * @method \App\Model\Entity\Activity newEmptyEntity()
 * @method \App\Model\Entity\Activity newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Activity[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Activity get($primaryKey, $options = [])
 * @method \App\Model\Entity\Activity findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Activity patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Activity[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Activity|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Activity saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Activity[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Activity[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Activity[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Activity[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class ActivitiesTable extends Table
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

        $this->setTable('activities');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->belongsTo('ActivityTypes', [
            'foreignKey' => 'activity_type_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('ActivityMetadatas', [
            'foreignKey' => 'activity_id',
        ]);
        $this->hasMany('Modules', [
            'foreignKey' => 'activity_id',
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
            ->scalar('name')
            ->maxLength('name', 255)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->scalar('description')
            ->maxLength('description', 255)
            ->allowEmptyString('description');

        $validator
            ->scalar('reference')
            ->maxLength('reference', 255)
            ->allowEmptyString('reference');

        $validator
            ->integer('activity_type_id')
            ->notEmptyString('activity_type_id');

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

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->isUnique(['name', 'reference'], ['allowMultipleNulls' => true]), ['errorField' => 'name']);
        $rules->add($rules->existsIn('activity_type_id', 'ActivityTypes'), ['errorField' => 'activity_type_id']);

        return $rules;
    }
}
