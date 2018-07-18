<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Sales Model
 *
 * @method \App\Model\Entity\Sale get($primaryKey, $options = [])
 * @method \App\Model\Entity\Sale newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Sale[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Sale|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Sale|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Sale patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Sale[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Sale findOrCreate($search, callable $callback = null, $options = [])
 */
class SalesTable extends Table
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

        $this->setTable('sales');
        $this->setDisplayField('salesid');
        $this->setPrimaryKey('salesid');
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
            ->integer('salesid')
            ->allowEmpty('salesid', 'create');

        $validator
            ->scalar('productid')
            ->maxLength('productid', 255)
            ->requirePresence('productid', 'create')
            ->notEmpty('productid');

        $validator
            ->scalar('price')
            ->maxLength('price', 255)
            ->requirePresence('price', 'create')
            ->notEmpty('price');

        $validator
            ->scalar('weight')
            ->maxLength('weight', 255)
            ->requirePresence('weight', 'create')
            ->notEmpty('weight');

        $validator
            ->scalar('amountdue')
            ->maxLength('amountdue', 255)
            ->requirePresence('amountdue', 'create')
            ->notEmpty('amountdue');

        $validator
            ->scalar('lessdiscount')
            ->maxLength('lessdiscount', 255)
            ->requirePresence('lessdiscount', 'create')
            ->notEmpty('lessdiscount');

        $validator
            ->scalar('netamountdue')
            ->maxLength('netamountdue', 255)
            ->requirePresence('netamountdue', 'create')
            ->notEmpty('netamountdue');

        $validator
            ->scalar('amounttender')
            ->maxLength('amounttender', 255)
            ->requirePresence('amounttender', 'create')
            ->notEmpty('amounttender');

        $validator
            ->scalar('amountchange')
            ->maxLength('amountchange', 255)
            ->requirePresence('amountchange', 'create')
            ->notEmpty('amountchange');

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
            ->scalar('id')
            ->maxLength('id', 255)
            ->requirePresence('id', 'create')
            ->notEmpty('id');

        return $validator;
    }
}
