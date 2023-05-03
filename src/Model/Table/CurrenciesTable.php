<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Currencies Model
 *
 * @property \App\Model\Table\ModulesTable&\Cake\ORM\Association\HasMany $Modules
 *
 * @method \App\Model\Entity\Currency newEmptyEntity()
 * @method \App\Model\Entity\Currency newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Currency[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Currency get($primaryKey, $options = [])
 * @method \App\Model\Entity\Currency findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Currency patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Currency[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Currency|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Currency saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Currency[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Currency[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Currency[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Currency[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class CurrenciesTable extends Table
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

        $this->setTable('currencies');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->hasMany('Modules', [
            'foreignKey' => 'currency_id',
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
            ->scalar('shortname')
            ->maxLength('shortname', 255)
            ->requirePresence('shortname', 'create')
            ->notEmptyString('shortname');

        $validator
            ->scalar('longname')
            ->maxLength('longname', 255)
            ->requirePresence('longname', 'create')
            ->notEmptyString('longname');

        $validator
            ->scalar('symbol')
            ->maxLength('symbol', 255)
            ->requirePresence('symbol', 'create')
            ->notEmptyString('symbol');

        $validator
            ->scalar('icon')
            ->maxLength('icon', 1000)
            ->requirePresence('icon', 'create')
            ->notEmptyString('icon');

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
        $rules->add($rules->isUnique(['shortname', 'longname', 'symbol']), ['errorField' => 'shortname']);

        return $rules;
    }
}
