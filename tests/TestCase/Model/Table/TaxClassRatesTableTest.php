<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TaxClassRatesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TaxClassRatesTable Test Case
 */
class TaxClassRatesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\TaxClassRatesTable
     */
    public $TaxClassRates;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.tax_class_rates',
        'app.tax_classes',
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
        $config = TableRegistry::exists('TaxClassRates') ? [] : ['className' => 'App\Model\Table\TaxClassRatesTable'];
        $this->TaxClassRates = TableRegistry::get('TaxClassRates', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TaxClassRates);

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
