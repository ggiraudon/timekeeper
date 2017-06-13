<?php
namespace EndUserInterface\Model\Entity;

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
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \EndUserInterface\Model\Entity\Company $company
 * @property \EndUserInterface\Model\Entity\Activity[] $activities
 * @property \EndUserInterface\Model\Entity\Invoice[] $invoices
 * @property \EndUserInterface\Model\Entity\Project[] $projects
 * @property \EndUserInterface\Model\Entity\Subscription[] $subscriptions
 * @property \EndUserInterface\Model\Entity\UserTimer[] $user_timers
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
