<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Inventory Model
 *
 * @method \App\Model\Entity\Inventory get($primaryKey, $options = [])
 * @method \App\Model\Entity\Inventory newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Inventory[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Inventory|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Inventory|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Inventory patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Inventory[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Inventory findOrCreate($search, callable $callback = null, $options = [])
 */
class InventoryTable extends Table
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

        $this->setTable('inventory');
        $this->setDisplayField('inventoryid');
        $this->setPrimaryKey('inventoryid');
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
            ->integer('inventoryid')
            ->allowEmpty('inventoryid', 'create');

        $validator
            ->scalar('productid')
            ->maxLength('productid', 255)
            ->requirePresence('productid', 'create')
            ->notEmpty('productid');

        $validator
            ->scalar('sourceid')
            ->maxLength('sourceid', 255)
            ->requirePresence('sourceid', 'create')
            ->notEmpty('sourceid');

        $validator
            ->scalar('weight')
            ->maxLength('weight', 255)
            ->requirePresence('weight', 'create')
            ->notEmpty('weight');

        $validator
            ->scalar('unitprice')
            ->maxLength('unitprice', 255)
            ->requirePresence('unitprice', 'create')
            ->notEmpty('unitprice');

        $validator
            ->scalar('totalinventory')
            ->maxLength('totalinventory', 255)
            ->requirePresence('totalinventory', 'create')
            ->notEmpty('totalinventory');

        $validator
            ->dateTime('datetime')
            ->requirePresence('datetime', 'create')
            ->notEmpty('datetime');

        $validator
            ->scalar('userid')
            ->maxLength('userid', 255)
            ->requirePresence('userid', 'create')
            ->notEmpty('userid');

        return $validator;
    }
}
