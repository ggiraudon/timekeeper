<?php
namespace EndUserInterface\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use EndUserInterface\Model\Table\SubscriptionsTable;

/**
 * EndUserInterface\Model\Table\SubscriptionsTable Test Case
 */
class SubscriptionsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \EndUserInterface\Model\Table\SubscriptionsTable
     */
    public $Subscriptions;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.end_user_interface.subscriptions',
        'plugin.end_user_interface.companies',
        'plugin.end_user_interface.clients',
        'plugin.end_user_interface.stripe_plans',
        'plugin.end_user_interface.stripe_subscriptions',
        'plugin.end_user_interface.paypal_plans',
        'plugin.end_user_interface.paypal_agreements'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Subscriptions') ? [] : ['className' => 'EndUserInterface\Model\Table\SubscriptionsTable'];
        $this->Subscriptions = TableRegistry::get('Subscriptions', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Subscriptions);

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
