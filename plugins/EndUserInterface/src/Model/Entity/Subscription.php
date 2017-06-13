<?php
namespace EndUserInterface\Model\Entity;

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
 * @property string $paypal_plan_id
 * @property string $paypal_agreement_id
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \EndUserInterface\Model\Entity\Company $company
 * @property \EndUserInterface\Model\Entity\Client $client
 * @property \EndUserInterface\Model\Entity\StripePlan $stripe_plan
 * @property \EndUserInterface\Model\Entity\StripeSubscription $stripe_subscription
 * @property \EndUserInterface\Model\Entity\PaypalPlan $paypal_plan
 * @property \EndUserInterface\Model\Entity\PaypalAgreement $paypal_agreement
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
