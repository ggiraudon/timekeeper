<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * UserTimer Entity
 *
 * @property string $id
 * @property string $user_id
 * @property string $client_id
 * @property string $project_id
 * @property string $description
 * @property \Cake\I18n\Time $start
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Client $client
 * @property \App\Model\Entity\Project $project
 */
class UserTimer extends Entity
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
