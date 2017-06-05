<?php
/**
 * Prjct: Vhealings
 * User: musta
 * Date: 6/1/2017
 * Time: 11:34 PM
 */

namespace Wrsft\Test\TestCase\Model\Table;


use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

class EventsTableTest extends TestCase
{

    /**
     * @var \Wrsft\Model\Table\EventsTable $Events
     */
    public $Events;

    public $fixtures = ['Fixture.Wrsft.Events'];

    public function setUp()
    {
        parent::setUp();

        $this->Events = TableRegistry::get(
            "Events",
            [
                "className" => 'Wrsft\Model\Table\EventsTable',
            ]
        );
    }

    public function test_retrieve_all_events_succeed(){

        $arr = $this->Events->find()->toArray();

        $this->assertCount(3, $arr);

        return $arr;
    }

}