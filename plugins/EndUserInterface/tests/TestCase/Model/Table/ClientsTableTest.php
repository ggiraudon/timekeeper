<?php
namespace EndUserInterface\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use EndUserInterface\Model\Table\ClientsTable;

/**
 * EndUserInterface\Model\Table\ClientsTable Test Case
 */
class ClientsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \EndUserInterface\Model\Table\ClientsTable
     */
    public $Clients;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.end_user_interface.clients',
        'plugin.end_user_interface.companies',
        'plugin.end_user_interface.activities',
        'plugin.end_user_interface.invoices',
        'plugin.end_user_interface.projects',
        'plugin.end_user_interface.subscriptions',
        'plugin.end_user_interface.stripe_plans',
        'plugin.end_user_interface.stripe_subscriptions',
        'plugin.end_user_interface.paypal_plans',
        'plugin.end_user_interface.paypal_agreements',
        'plugin.end_user_interface.user_timers'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Clients') ? [] : ['className' => 'EndUserInterface\Model\Table\ClientsTable'];
        $this->Clients = TableRegistry::get('Clients', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Clients);

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
