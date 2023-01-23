<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * BusinessPackages Model
 *
 * @property \App\Model\Table\PackagesTable&\Cake\ORM\Association\BelongsTo $Packages
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\BusinessPackage newEmptyEntity()
 * @method \App\Model\Entity\BusinessPackage newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\BusinessPackage[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\BusinessPackage get($primaryKey, $options = [])
 * @method \App\Model\Entity\BusinessPackage findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\BusinessPackage patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\BusinessPackage[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\BusinessPackage|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\BusinessPackage saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\BusinessPackage[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\BusinessPackage[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\BusinessPackage[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\BusinessPackage[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class BusinessPackagesTable extends Table
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

        $this->setTable('business_packages');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Packages', [
            'foreignKey' => 'package_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
        ]);
    }
}
