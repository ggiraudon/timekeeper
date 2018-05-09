<?php
namespace EndUserInterface\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * TicketsFixture
 *
 */
class TicketsFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'uuid', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'company_id' => ['type' => 'uuid', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'client_id' => ['type' => 'uuid', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'project_id' => ['type' => 'uuid', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'ticket_number' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'ticket_date' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => 'CURRENT_TIMESTAMP', 'comment' => '', 'precision' => null],
        'from_email' => ['type' => 'string', 'length' => 120, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'ticket_title' => ['type' => 'string', 'length' => 250, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'status' => ['type' => 'string', 'length' => null, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'user_id' => ['type' => 'uuid', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => 'CURRENT_TIMESTAMP', 'comment' => '', 'precision' => null],
        'modified' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => 'CURRENT_TIMESTAMP', 'comment' => '', 'precision' => null],
        '_indexes' => [
            'company_id' => ['type' => 'index', 'columns' => ['company_id', 'user_id'], 'length' => []],
            'client_id' => ['type' => 'index', 'columns' => ['client_id', 'project_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8_general_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Records
     *
     * @var array
     */
    public $records = [
        [
            'id' => '520800fb-d0e5-4713-a9df-af8322104a95',
            'company_id' => 'a5299362-9dbb-4311-a8ba-340e74d52d57',
            'client_id' => '55f861cc-c3fe-42eb-b54e-7268eb3e2fb0',
            'project_id' => '04e89c0c-f137-492a-a946-7eeb07457882',
            'ticket_number' => 1,
            'ticket_date' => '2018-05-08 15:43:41',
            'from_email' => 'Lorem ipsum dolor sit amet',
            'ticket_title' => 'Lorem ipsum dolor sit amet',
            'status' => 'Lorem ipsum dolor sit amet',
            'user_id' => 'b15dedf0-ac91-4970-a893-dda729ac6567',
            'created' => '2018-05-08 15:43:41',
            'modified' => '2018-05-08 15:43:41'
        ],
    ];
}
