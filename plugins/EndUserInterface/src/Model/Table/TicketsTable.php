<?php
namespace EndUserInterface\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Tickets Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Companies
 * @property \Cake\ORM\Association\BelongsTo $Clients
 * @property \Cake\ORM\Association\BelongsTo $Projects
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\HasMany $Activities
 * @property \Cake\ORM\Association\HasMany $TicketAttachments
 * @property \Cake\ORM\Association\HasMany $TicketNotes
 *
 * @method \EndUserInterface\Model\Entity\Ticket get($primaryKey, $options = [])
 * @method \EndUserInterface\Model\Entity\Ticket newEntity($data = null, array $options = [])
 * @method \EndUserInterface\Model\Entity\Ticket[] newEntities(array $data, array $options = [])
 * @method \EndUserInterface\Model\Entity\Ticket|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \EndUserInterface\Model\Entity\Ticket patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \EndUserInterface\Model\Entity\Ticket[] patchEntities($entities, array $data, array $options = [])
 * @method \EndUserInterface\Model\Entity\Ticket findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class TicketsTable extends Table
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

        $this->table('tickets');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Companies', [
            'foreignKey' => 'company_id',
            'joinType' => 'INNER',
            'className' => 'EndUserInterface.Companies'
        ]);
        $this->belongsTo('Clients', [
            'foreignKey' => 'client_id',
            'className' => 'EndUserInterface.Clients'
        ]);
        $this->belongsTo('Projects', [
            'foreignKey' => 'project_id',
            'className' => 'EndUserInterface.Projects'
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'className' => 'EndUserInterface.Users'
        ]);
        $this->hasMany('Activities', [
            'foreignKey' => 'ticket_id',
            'className' => 'EndUserInterface.Activities'
        ]);
        $this->hasMany('TicketAttachments', [
            'foreignKey' => 'ticket_id',
            'className' => 'EndUserInterface.TicketAttachments'
        ]);
        $this->hasMany('TicketNotes', [
            'foreignKey' => 'ticket_id',
            'className' => 'EndUserInterface.TicketNotes'
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
            ->integer('ticket_number')
            ->requirePresence('ticket_number', 'create')
            ->notEmpty('ticket_number');

        $validator
            ->dateTime('ticket_date')
            ->requirePresence('ticket_date', 'create')
            ->notEmpty('ticket_date');

        $validator
            ->allowEmpty('from_email');

        $validator
            ->requirePresence('ticket_title', 'create')
            ->notEmpty('ticket_title');

        $validator
            ->requirePresence('status', 'create')
            ->notEmpty('status');

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
        $rules->add($rules->existsIn(['project_id'], 'Projects'));
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }
}
