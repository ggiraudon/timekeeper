<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Client Entity
 *
 * @property string $id
 * @property string $company_id
 * @property string $name
 * @property string $billing_address
 * @property string $phone
 * @property string $email
 * @property float $default_rate
 * @property string $currency
 * @property string $username
 * @property string $password
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Company $company
 * @property \App\Model\Entity\Activity[] $activities
 * @property \App\Model\Entity\Invoice[] $invoices
 * @property \App\Model\Entity\Project[] $projects
 * @property \App\Model\Entity\Subscription[] $subscriptions
 * @property \App\Model\Entity\UserTimer[] $user_timers
 */
class Client extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password'
    ];
}
