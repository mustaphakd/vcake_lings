<?php
/**
 * Prjct: Vhealings
 * User: musta
 * Date: 5/24/2017
 * Time: 12:23 AM
 */

namespace Wrsft\Test\TestCase\Controller\Component;


use Cake\Controller\ComponentRegistry;
use Cake\Event\Event;
use Cake\Event\EventManager;
use Cake\Network\Http\Request;
use Cake\Network\Http\Response;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

class EventServicesComponentTest extends TestCase
{

    /**
     * @var \Wrsft\Controller\Component\EventServicesComponent $component;
     */
    public $component;


    /**
 * @var \Wrsft\Model\Table\EventsTable $Events;
 */
    public $Events;

    /**
     * @var \Wrsft\Model\Table\EventsResellersTable $EventsResellers;
     */
    public $EventsResellers;

    public $fixtures = ['plugin.Wrsft.Events'];

    public function setUp()
    {
        parent::setUp();

        $request = new Request();
        $response = new Response();

        $controller = $this->getMockBuilder('Cake\Controller\Controller')
            ->setConstructorArgs($request, $response)
            ->setMethods(null)
            ->getMock();

        $registry = new ComponentRegistry($controller);

        $registry->load(
            "EventServices",
            [
                'className' => '\Wrsft\Controller\Component\EventServicesComponent'
            ]
        );

        $this->Events = TableRegistry::get(
            "Events",
            [
                "className" => '\Wrsft\Model\Table\EventsTable'
            ]
        );

        $this->EventsResellers = TableRegistry::get(
            "EventsResellers",
            [
                "className" => '\Wrsft\Model\Table\EventsResellersTable'
            ]
        );
    }

    // all inserts should raise events and notify resellers

    public function test_retrieve_all_events_succeed(){

        $events = $this->component->retrieveEvents(false);

        $this->assertCount(3, $events);
    }

    public function test_retrieve_visible_events_succeed(){

        $this->create_visible_events();
        $allEvents = $this->component->retrieveEvents(false);

        $visibleEvents = $this->component->retrieveEvents();

        $this->assertCount(5, $allEvents);
        $this->assertCount(2, $visibleEvents);
    }

    public function test_insert_simple_event_succeed(){

        EventManager::instance()->on("Event.created", function(Event $event, $subject, $options){});

        $this->EventsResellers->deleteAll();

        $insertionResult = $this->component->insert_events([self::$ecowas_event]);


        pr($insertionResult);

        $this->assertEquals(
            "Forum ECOWAS", $insertionResult["events"][0]->title);

        $this->assertCount(4, $this->component->retrieveEvents(false));

        //assert event raised
        $this->assertEventFired("Event.created");
        // assert resellers notified
        $this->assertCount(2, $this->EventsResellers->find()->toArray());
    }

    public function test_insert_invalid_simple_event_fail(){

        $ecowas_evt = self::$ecowas_event;
        unset($ecowas_evt["title"]);

        $insertionResult = $this->component->insert_events([$ecowas_evt]);

        pr($insertionResult);

        $this->assertEmpty($insertionResult["events"]);

        $this->assertCount(3, $this->component->retrieveEvents(false));

        //assert event not raised

        //assert resellers not notified
        $this->assertCount(0, $this->EventsResellers->find()->toArray());

    }

    //should only be able to update or delete non-visible -with no registered users

    //timeLines, images, tags

    private static $ecowas_event = [
        "title" => "Forum ECOWAS",
        "sub_header" => "Sommet des chef D'Etats",
        "description" => " A sommet where there is more blah blah and photo ups for best suit/out fit.",
        "start_date" => "2018-05-05",
        "end_date" => "2018-05-12",
        "min_cost" => 450,
        "default_cost" => 500,
        "currency" => "USD",
        "video_path" => "http://youtube.com",
        "status" => "soon",
        "visible" => 'T'
    ];
    private function create_visible_events(){
        $arr = $this->Events->newEntities([
            self::$ecowas_event
            ,
            [
                "title" => "Forum BECAO",
                "sub_header" => "Sommet des financier de colonies francaise",
                "description" => " A sommet where there is more blah blah and photo ups for best suit/out fit.",
                "start_date" => "2018-05-05",
                "end_date" => "2018-05-12",
                "min_cost" => 2356,
                "default_cost" => 5860,
                "currency" => "USD",
                "video_path" => "http://youtube.com",
                "status" => "soon",
                "visible" => 'T'
            ]
        ]);

        $this->Events->saveMany($arr);
    }

}