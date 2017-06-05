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
use Wrsft\Controller\Component\EventServicesComponent;

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

        $this->provisionResellers();
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

        $this->provisionResellers();

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

        return $insertionResult;
    }

    public function test_insert_invalid_simple_event_fail(){

        $eventRaised = false;
        EventManager::instance()->on("Event.created", function(Event $event, $subject, $options) use($eventRaised){
            $eventRaised = true;
        });

        $ecowas_evt = self::$ecowas_event;
        unset($ecowas_evt["title"]);

        $insertionResult = $this->component->insert_events([$ecowas_evt]);

        pr($insertionResult);

        $this->assertEmpty($insertionResult["events"]);

        $this->assertCount(3, $this->component->retrieveEvents(false));

        //assert event not raised
        $this->assertFalse($eventRaised);

        //assert resellers not notified
        $this->assertCount(0, $this->EventsResellers->find()->toArray());

    }

    /**
     *
     * @depends test_insert_simple_event_succeed
     *
     * @param $insertionResult
     */
    public function test_update_event_minCost_increased_succeed($insertionResult){

        EventManager::instance()->on(EventServicesComponent::EVENT_UPDATED, function(Event $event, $subject, $options){});
        $this->provisionResellers();

        $event = $insertionResult["events"]["entities"][0];

        $event->sub_header = "Breaking news!";
        $event->min_cost = 470;

        //only notify reseller  min cost if more than default_cost || new min cost is more than reseller min_cost

        $updateResult = $this->component->update_event([$event]);

        $eventResellers = $this->EventsResellers->find()->toArray();

        $this->assertCount(2, $eventResellers);

        $updated = true;
        foreach ($eventResellers as $reseller){
            if($reseller->cost !== $event->min_cost){
                $updated = false;
                break;
            }
        }

        $this->assertTrue($updated, "Failed updating resellers");
    }

    /**
     *
     * @depends test_insert_simple_event_succeed
     *
     * @param $insertionResult
     */
    public function test_update_event_defaultCost_decreased_moreThan_prevMinCost_succeed($insertionResult){

        $event = $insertionResult["events"]["entities"][0];

        $event->sub_header = "Breaking news!";
        $event->min_cost = 400.51;
        $event->default_cost = 445;
        //only notify reseller  min cost if more than default_cost || new min cost is more than reseller min_cost
    }

    /**
     *
     * @depends test_insert_simple_event_succeed
     *
     * @param $insertionResult
     */
    public function test_update_event_priceChanged_existing_patron_fail($insertionResult){

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

    private function provisionResellers(){

        $users = TableRegistry::get(
            "Users",
            [
                "className" => '\Wrsft\Model\Table\UsersTable'
            ]
        );

        $roles = TableRegistry::get(
            "Roles",
            [
                "className" => '\Wrsft\Model\Table\RolesTable'
            ]
        );

        $resellerRole = $roles->newEntity([ "name" => EventServicesComponent::ROLE_RESELLER]);
        $resellerRole = $roles->saveOrFail($resellerRole);

        $password = "Password_1";

        $entities = $users->newEntities([
            [
                'first_name' => "Audrey",
                'last_name' => 'Sekongo',
                'email' => 'audrey@wrsft.com',
                'confirmed' => 'T',
                'disabled' => 'F',
                'password' => $password,
                'birth_date' => (new Date('1980-02-22'))->format('Y-m-d H:i:s'),
                "roles" => [
                    [
                        "id" => $resellerRole->id
                    ]
                ]
            ],
            [
                'first_name' => "Yasmonud",
                'last_name' => 'plantine',
                'email' => 'plantine@wrsft.com',
                'confirmed' => 'T',
                'disabled' => 'F',
                'password' => $password,
                'birth_date' => (new Date('1985-02-22'))->format('Y-m-d H:i:s'),
                "roles" => [
                    [
                        "id" => $resellerRole->id
                    ]
                ]
            ],
        ]);

        $entities = $users->saveMany(
            $entities,
            [
                "associated" => ["Roles"]
            ]);

        return $entities;
    }

}