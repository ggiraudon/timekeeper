<?php
namespace EndUserInterface\Model\Entity;

use Cake\ORM\Entity;

/**
 * Ticket Entity
 *
 * @property string $id
 * @property string $company_id
 * @property string $client_id
 * @property string $project_id
 * @property int $ticket_number
 * @property \Cake\I18n\Time $ticket_date
 * @property string $from_email
 * @property string $ticket_title
 * @property string $status
 * @property string $user_id
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \EndUserInterface\Model\Entity\Company $company
 * @property \EndUserInterface\Model\Entity\Client $client
 * @property \EndUserInterface\Model\Entity\Project $project
 * @property \EndUserInterface\Model\Entity\User $user
 * @property \EndUserInterface\Model\Entity\Activity[] $activities
 * @property \EndUserInterface\Model\Entity\TicketAttachment[] $ticket_attachments
 * @property \EndUserInterface\Model\Entity\TicketNote[] $ticket_notes
 */
class Ticket extends Entity
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
