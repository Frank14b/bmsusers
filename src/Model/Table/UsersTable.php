<?php

declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Users Model
 *
 * @property \App\Model\Table\BranchsTable&\Cake\ORM\Association\HasMany $Branchs
 * @property \App\Model\Table\BusinessTable&\Cake\ORM\Association\HasMany $Business
 * @property \App\Model\Table\BusinessPackagesTable&\Cake\ORM\Association\HasMany $BusinessPackages
 * @property \App\Model\Table\UserBranchsTable&\Cake\ORM\Association\HasMany $UserBranchs
 *
 * @method \App\Model\Entity\User newEmptyEntity()
 * @method \App\Model\Entity\User newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\User[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\User get($primaryKey, $options = [])
 * @method \App\Model\Entity\User findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\User[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\User|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class UsersTable extends Table
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

        $this->setTable('users');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->hasMany('Branchs', [
            'foreignKey' => 'user_id',
        ]);
        $this->hasMany('Business', [
            'foreignKey' => 'user_id',
        ]);
        $this->hasMany('BusinessPackages', [
            'foreignKey' => 'user_id',
        ]);
        $this->hasMany('UserBranchs', [
            'foreignKey' => 'user_id',
        ]);
    }

    public function validationDefault(Validator $validator): Validator
    {
        return $validator
            ->notEmpty('email', 'An email is required')
            ->email('email')
            ->add('email', 'valid-email', [
                'rule' => ['rule' => 'email'],
                'message' => 'custom@example.com'
            ])
            ->notEmpty('username', 'Username is required')
            ->notEmpty('password', 'Password is required')
            ->add('password', 'length', ['rule' => ['lengthBetween', 8, 100]])
            ->notEmpty('firstname', 'Firstname is required')
            ->notEmpty('role', 'A role is required')
            ->add('role', 'inList', [
                'rule' => ['inList', ['1', '2']],
                'message' => 'Please enter a valid role'
            ]);
    }

    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->addCreate($rules->isUnique(['email'], 'User Email already used'));

        $rules->addCreate($rules->isUnique(['username'], 'User name already used'));

        // Add a rule that is applied for create and update operations
        $rules->add(function ($entity, $options) use ($rules) {
            // Return a boolean to indicate pass/failure
            // if ($entity->role == "email") {
            //     $rules->isUnique(['email']);
            // }
        });

        // Add a rule for create.
        $rules->addCreate(function ($entity, $options) {
            // Return a boolean to indicate pass/failure
        }, 'ruleName');

        // Add a rule for update
        $rules->addUpdate(function ($entity, $options) {
            // Return a boolean to indicate pass/failure
        }, 'ruleName');

        // Add a rule for the deleting.
        $rules->addDelete(function ($entity, $options) {
            // Return a boolean to indicate pass/failure
        }, 'ruleName');

        return $rules;
    }
}
