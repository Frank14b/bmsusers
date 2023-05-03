<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ActivityMetadatas Model
 *
 * @property \App\Model\Table\ActivitiesTable&\Cake\ORM\Association\BelongsTo $Activities
 *
 * @method \App\Model\Entity\ActivityMetadata newEmptyEntity()
 * @method \App\Model\Entity\ActivityMetadata newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\ActivityMetadata[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ActivityMetadata get($primaryKey, $options = [])
 * @method \App\Model\Entity\ActivityMetadata findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\ActivityMetadata patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ActivityMetadata[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\ActivityMetadata|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ActivityMetadata saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ActivityMetadata[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ActivityMetadata[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\ActivityMetadata[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ActivityMetadata[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class ActivityMetadatasTable extends Table
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

        $this->setTable('activity_metadatas');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Activities', [
            'foreignKey' => 'activity_id',
            'joinType' => 'INNER',
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
            ->integer('activity_id')
            ->notEmptyString('activity_id');

        $validator
            ->scalar('metakey')
            ->maxLength('metakey', 255)
            ->requirePresence('metakey', 'create')
            ->notEmptyString('metakey');

        $validator
            ->scalar('metavalue')
            ->maxLength('metavalue', 1000)
            ->requirePresence('metavalue', 'create')
            ->notEmptyString('metavalue');

        $validator
            ->scalar('extra')
            ->maxLength('extra', 1000)
            ->allowEmptyString('extra');

        $validator
            ->scalar('unicity')
            ->notEmptyString('unicity');

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
        $rules->add($rules->existsIn('activity_id', 'Activities'), ['errorField' => 'activity_id']);

        return $rules;
    }
}
