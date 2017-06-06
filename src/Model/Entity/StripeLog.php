<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * StripeLog Entity
 *
 * @property string $id
 * @property string $company_id
 * @property \Cake\I18n\Time $date_time
 * @property string $event_type
 * @property string $content
 *
 * @property \App\Model\Entity\Company $company
 */
class StripeLog extends Entity
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
