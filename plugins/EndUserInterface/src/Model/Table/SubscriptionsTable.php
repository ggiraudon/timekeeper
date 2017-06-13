<?php
namespace EndUserInterface\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Subscriptions Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Companies
 * @property \Cake\ORM\Association\BelongsTo $Clients
 * @property \Cake\ORM\Association\BelongsTo $StripePlans
 * @property \Cake\ORM\Association\BelongsTo $StripeSubscriptions
 * @property \Cake\ORM\Association\BelongsTo $PaypalPlans
 * @property \Cake\ORM\Association\BelongsTo $PaypalAgreements
 *
 * @method \EndUserInterface\Model\Entity\Subscription get($primaryKey, $options = [])
 * @method \EndUserInterface\Model\Entity\Subscription newEntity($data = null, array $options = [])
 * @method \EndUserInterface\Model\Entity\Subscription[] newEntities(array $data, array $options = [])
 * @method \EndUserInterface\Model\Entity\Subscription|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \EndUserInterface\Model\Entity\Subscription patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \EndUserInterface\Model\Entity\Subscription[] patchEntities($entities, array $data, array $options = [])
 * @method \EndUserInterface\Model\Entity\Subscription findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class SubscriptionsTable extends Table
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

        $this->table('subscriptions');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Companies', [
            'foreignKey' => 'company_id',
            'joinType' => 'INNER',
            'className' => 'EndUserInterface.Companies'
        ]);
        $this->belongsTo('Clients', [
            'foreignKey' => 'client_id',
            'joinType' => 'INNER',
            'className' => 'EndUserInterface.Clients'
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
            ->decimal('amount')
            ->requirePresence('amount', 'create')
            ->notEmpty('amount');

        $validator
            ->requirePresence('currency', 'create')
            ->notEmpty('currency');

        $validator
            ->requirePresence('interval', 'create')
            ->notEmpty('interval');

        $validator
            ->integer('interval_count')
            ->requirePresence('interval_count', 'create')
            ->notEmpty('interval_count');

        $validator
            ->requirePresence('status', 'create')
            ->notEmpty('status');

        $validator
            ->allowEmpty('payment_type');

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
        $rules->add($rules->existsIn(['company_id'], 'Companies'));
        $rules->add($rules->existsIn(['client_id'], 'Clients'));
        return $rules;
    }
}
