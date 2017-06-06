<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\StripeLogsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\StripeLogsTable Test Case
 */
class StripeLogsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\StripeLogsTable
     */
    public $StripeLogs;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.stripe_logs',
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
        $config = TableRegistry::exists('StripeLogs') ? [] : ['className' => 'App\Model\Table\StripeLogsTable'];
        $this->StripeLogs = TableRegistry::get('StripeLogs', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->StripeLogs);

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
