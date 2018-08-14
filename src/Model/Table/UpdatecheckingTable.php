<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Updatechecking Model
 *
 * @method \App\Model\Entity\Updatechecking get($primaryKey, $options = [])
 * @method \App\Model\Entity\Updatechecking newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Updatechecking[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Updatechecking|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Updatechecking|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Updatechecking patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Updatechecking[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Updatechecking findOrCreate($search, callable $callback = null, $options = [])
 */
class UpdatecheckingTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('updatechecking');
        $this->setDisplayField('updateid');
        $this->setPrimaryKey('updateid');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('updateid')
            ->allowEmpty('updateid', 'create');

        $validator
            ->scalar('dateissued')
            ->maxLength('dateissued', 255)
            ->requirePresence('dateissued', 'create')
            ->notEmpty('dateissued');

        $validator
            ->scalar('timeissued')
            ->maxLength('timeissued', 255)
            ->requirePresence('timeissued', 'create')
            ->notEmpty('timeissued');

        $validator
            ->boolean('checked')
            ->requirePresence('checked', 'create')
            ->notEmpty('checked');

        return $validator;
    }
}
