<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\UpdatecheckingTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\UpdatecheckingTable Test Case
 */
class UpdatecheckingTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\UpdatecheckingTable
     */
    public $Updatechecking;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.updatechecking'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Updatechecking') ? [] : ['className' => UpdatecheckingTable::class];
        $this->Updatechecking = TableRegistry::getTableLocator()->get('Updatechecking', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Updatechecking);

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
}
