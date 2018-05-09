<?php
namespace EndUserInterface\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Clients Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Companies
 * @property \Cake\ORM\Association\HasMany $Activities
 * @property \Cake\ORM\Association\HasMany $Invoices
 * @property \Cake\ORM\Association\HasMany $Projects
 * @property \Cake\ORM\Association\HasMany $Subscriptions
 * @property \Cake\ORM\Association\HasMany $UserTimers
 *
 * @method \EndUserInterface\Model\Entity\Client get($primaryKey, $options = [])
 * @method \EndUserInterface\Model\Entity\Client newEntity($data = null, array $options = [])
 * @method \EndUserInterface\Model\Entity\Client[] newEntities(array $data, array $options = [])
 * @method \EndUserInterface\Model\Entity\Client|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \EndUserInterface\Model\Entity\Client patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \EndUserInterface\Model\Entity\Client[] patchEntities($entities, array $data, array $options = [])
 * @method \EndUserInterface\Model\Entity\Client findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ClientsTable extends Table
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

        $this->table('clients');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Companies', [
            'foreignKey' => 'company_id',
            'joinType' => 'INNER',
            'className' => 'EndUserInterface.Companies'
        ]);
        $this->hasMany('Activities', [
            'foreignKey' => 'client_id',
            'className' => 'EndUserInterface.Activities'
        ]);
        $this->hasMany('Invoices', [
            'foreignKey' => 'client_id',
            'className' => 'EndUserInterface.Invoices'
        ]);
        $this->hasMany('Projects', [
            'foreignKey' => 'client_id',
            'className' => 'EndUserInterface.Projects'
        ]);
        $this->hasMany('Subscriptions', [
            'foreignKey' => 'client_id',
            'className' => 'EndUserInterface.Subscriptions'
        ]);
        $this->hasMany('UserTimers', [
            'foreignKey' => 'client_id',
            'className' => 'EndUserInterface.UserTimers'
        ]);
        $this->hasMany('Tickets', [
            'foreignKey' => 'client_id',
            'className' => 'EndUserInterface.Tickets'
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
            ->requirePresence('billing_address', 'create')
            ->notEmpty('billing_address');

        $validator
            ->requirePresence('phone', 'create')
            ->notEmpty('phone');

        $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->notEmpty('email');

        $validator
            ->decimal('default_rate')
            ->requirePresence('default_rate', 'create')
            ->notEmpty('default_rate');

        $validator
            ->requirePresence('currency', 'create')
            ->notEmpty('currency');

        $validator
            ->allowEmpty('username');

        $validator
            ->allowEmpty('password');

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
        $rules->add($rules->isUnique(['email']));
        $rules->add($rules->isUnique(['username']));
        $rules->add($rules->existsIn(['company_id'], 'Companies'));

        return $rules;
    }
}
