<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TaxClassesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TaxClassesTable Test Case
 */
class TaxClassesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\TaxClassesTable
     */
    public $TaxClasses;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.tax_classes',
        'app.companies',
        'app.clients',
        'app.activities',
        'app.users',
        'app.projects',
        'app.invoices',
        'app.tax_class_rates'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('TaxClasses') ? [] : ['className' => 'App\Model\Table\TaxClassesTable'];
        $this->TaxClasses = TableRegistry::get('TaxClasses', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TaxClasses);

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
