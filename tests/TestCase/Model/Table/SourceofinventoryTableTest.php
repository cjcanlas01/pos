<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SourceofinventoryTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SourceofinventoryTable Test Case
 */
class SourceofinventoryTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\SourceofinventoryTable
     */
    public $Sourceofinventory;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.sourceofinventory'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Sourceofinventory') ? [] : ['className' => SourceofinventoryTable::class];
        $this->Sourceofinventory = TableRegistry::getTableLocator()->get('Sourceofinventory', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Sourceofinventory);

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
