<?php
namespace App\Test\TestCase\Controller;

use App\Controller\TicketNotesController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\TicketNotesController Test Case
 */
class TicketNotesControllerTest extends IntegrationTestCase
{

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
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAdd()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
