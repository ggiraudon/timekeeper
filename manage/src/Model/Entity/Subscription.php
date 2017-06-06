<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Subscription Entity
 *
 * @property string $id
 * @property string $company_id
 * @property string $client_id
 * @property string $name
 * @property float $amount
 * @property string $currency
 * @property string $interval
 * @property int $interval_count
 * @property string $status
 * @property string $payment_type
 * @property string $stripe_plan_id
 * @property string $stripe_subscription_id
 * @property string $paypal_subscription_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Company $company
 * @property \App\Model\Entity\Client $client
 * @property \App\Model\Entity\StripePlan $stripe_plan
 * @property \App\Model\Entity\StripeSubscription $stripe_subscription
 * @property \App\Model\Entity\PaypalSubscription $paypal_subscription
 */
class Subscription extends Entity
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
}
