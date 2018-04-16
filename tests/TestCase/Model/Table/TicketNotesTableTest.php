<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TicketNotesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TicketNotesTable Test Case
 */
class TicketNotesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\TicketNotesTable
     */
    public $TicketNotes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.ticket_notes',
        'app.tickets',
        'app.companies',
        'app.clients',
        'app.activities',
        'app.users',
        'app.user_timers',
        'app.projects',
        'app.invoices',
        'app.tax_classes',
        'app.tax_class_rates',
        'app.ticket_attachments'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('TicketNotes') ? [] : ['className' => 'App\Model\Table\TicketNotesTable'];
        $this->TicketNotes = TableRegistry::get('TicketNotes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TicketNotes);

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
