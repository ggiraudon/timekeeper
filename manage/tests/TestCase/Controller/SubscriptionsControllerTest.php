<?php
namespace App\Test\TestCase\Controller;

use App\Controller\SubscriptionsController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\SubscriptionsController Test Case
 */
class SubscriptionsControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.subscriptions',
        'app.companies',
        'app.clients',
        'app.activities',
        'app.invoices',
        'app.projects',
        'app.user_timers',
        'app.stripe_plans',
        'app.stripe_subscriptions',
        'app.paypal_subscriptions'
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
