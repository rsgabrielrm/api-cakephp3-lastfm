<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SongsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SongsTable Test Case
 */
class SongsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\SongsTable
     */
    public $Songs;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.songs'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Songs') ? [] : ['className' => SongsTable::class];
        $this->Songs = TableRegistry::getTableLocator()->get('Songs', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Songs);

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
