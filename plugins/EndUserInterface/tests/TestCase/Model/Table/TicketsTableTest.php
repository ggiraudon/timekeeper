<?php
namespace EndUserInterface\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use EndUserInterface\Model\Table\TicketsTable;

/**
 * EndUserInterface\Model\Table\TicketsTable Test Case
 */
class TicketsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \EndUserInterface\Model\Table\TicketsTable
     */
    public $Tickets;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.end_user_interface.tickets',
        'plugin.end_user_interface.companies',
        'plugin.end_user_interface.clients',
        'plugin.end_user_interface.activities',
        'plugin.end_user_interface.invoices',
        'plugin.end_user_interface.projects',
        'plugin.end_user_interface.subscriptions',
        'plugin.end_user_interface.user_timers',
        'plugin.end_user_interface.users',
        'plugin.end_user_interface.ticket_attachments',
        'plugin.end_user_interface.ticket_notes'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Tickets') ? [] : ['className' => 'EndUserInterface\Model\Table\TicketsTable'];
        $this->Tickets = TableRegistry::get('Tickets', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Tickets);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
