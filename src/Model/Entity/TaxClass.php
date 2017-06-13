<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * TaxClass Entity
 *
 * @property string $id
 * @property string $company_id
 * @property string $name
 *
 * @property \App\Model\Entity\Company $company
 * @property \App\Model\Entity\TaxClassRate[] $tax_class_rates
 */
class TaxClass extends Entity
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
