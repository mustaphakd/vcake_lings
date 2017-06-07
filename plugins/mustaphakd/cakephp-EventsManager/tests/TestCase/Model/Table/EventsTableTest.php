<?php
/**
 * Prjct: Vhealings
 * User: musta
 * Date: 6/1/2017
 * Time: 11:34 PM
 */

namespace Wrsft\Test\TestCase\Model\Table;


use Cake\Core\Configure;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Cake\Utility\Text;

class EventsTableTest extends TestCase
{

    /**
     * @var \Wrsft\Model\Table\EventsTable $Events
     */
    public $Events;

   // public $fixtures = []; // ['plugin.Wrsft.Events'];
    public $autoFixtures = false;


    public function setUp()
    {
        parent::setUp();

        $this->Events = TableRegistry::get(
            "Events",
            [
                "className" => '\Wrsft\Model\Table\EventsTable',
            ]
        );

        Configure::write(
            'Fixture.Wrsft.EventsLocationIds',
            [
                Text::uuid(),
                Text::uuid(),
                Text::uuid()
            ]);


        $fixtureManger = $this->fixtureManager;
        $this->fixtures = ['plugin.Wrsft.Events'];
        $testObject = $this;

        $closure = \Closure::bind(
            function () use($fixtureManger, $testObject){
               call_user_func(array($fixtureManger, "_loadFixtures"),$testObject);
            },
            null,
            $fixtureManger
        );

        $closure();

        $this->loadFixtures("Events");
    }

    public function test_retrieve_all_events_succeed(){

        $arr = $this->Events->find()->toArray();

        $this->assertCount(3, $arr);

        return $arr;
    }

}