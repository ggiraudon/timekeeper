<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TaxClassRates Model
 *
 * @property \Cake\ORM\Association\BelongsTo $TaxClasses
 *
 * @method \App\Model\Entity\TaxClassRate get($primaryKey, $options = [])
 * @method \App\Model\Entity\TaxClassRate newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\TaxClassRate[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TaxClassRate|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TaxClassRate patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TaxClassRate[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\TaxClassRate findOrCreate($search, callable $callback = null, $options = [])
 */
class TaxClassRatesTable extends Table
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

        $this->table('tax_class_rates');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->belongsTo('TaxClasses', [
            'foreignKey' => 'tax_class_id',
            'joinType' => 'INNER'
        ]);
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
            ->uuid('id')
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->decimal('rate')
            ->requirePresence('rate', 'create')
            ->notEmpty('rate');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['tax_class_id'], 'TaxClasses'));

        return $rules;
    }
}
