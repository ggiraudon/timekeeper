<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PaypalLogsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PaypalLogsTable Test Case
 */
class PaypalLogsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\PaypalLogsTable
     */
    public $PaypalLogs;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.paypal_logs',
        'app.companies',
        'app.clients',
        'app.activities',
        'app.users',
        'app.projects',
        'app.invoices'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('PaypalLogs') ? [] : ['className' => 'App\Model\Table\PaypalLogsTable'];
        $this->PaypalLogs = TableRegistry::get('PaypalLogs', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->PaypalLogs);

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
