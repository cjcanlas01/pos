<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\InventoryTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\InventoryTable Test Case
 */
class InventoryTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\InventoryTable
     */
    public $Inventory;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.inventory'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Inventory') ? [] : ['className' => InventoryTable::class];
        $this->Inventory = TableRegistry::getTableLocator()->get('Inventory', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Inventory);

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
