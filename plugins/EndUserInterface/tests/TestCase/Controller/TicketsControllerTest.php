<?php
namespace EndUserInterface\Test\TestCase\Controller;

use Cake\TestSuite\IntegrationTestCase;
use EndUserInterface\Controller\TicketsController;

/**
 * EndUserInterface\Controller\TicketsController Test Case
 */
class TicketsControllerTest extends IntegrationTestCase
{

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
        'plugin.end_user_interface.users',
        'plugin.end_user_interface.user_timers',
        'plugin.end_user_interface.projects',
        'plugin.end_user_interface.invoices',
        'plugin.end_user_interface.tax_classes',
        'plugin.end_user_interface.tax_class_rates',
        'plugin.end_user_interface.ticket_attachments',
        'plugin.end_user_interface.ticket_notes'
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
