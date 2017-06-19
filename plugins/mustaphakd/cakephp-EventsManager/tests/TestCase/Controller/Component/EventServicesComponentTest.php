<?php
/**
 * Prjct: Vhealings
 * User: musta
 * Date: 5/24/2017
 * Time: 12:23 AM
 */

namespace Wrsft\Test\TestCase\Controller\Component;


use Cake\Chronos\Date;
use Cake\Controller\ComponentRegistry;
use Cake\Core\Configure;
use Cake\Datasource\ConnectionManager;
use Cake\Event\Event;
use Cake\Event\EventManager;
use Cake\Http\ServerRequest;
use Cake\Http\Response;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\Fixture\TestFixture;
use Cake\TestSuite\TestCase;
use Cake\Utility\Text;
use Wrsft\Controller\Component\EventServicesComponent;
use Wrsft\Test\Fixture\EventsResellersFixture;

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
     * @var \Wrsft\Model\Table\UsersTable $Users;
     */
    public $Users;

    /**
     * @var \Wrsft\Model\Table\RolesTable $Roles;
     */
    public $Roles;

    /**
     * @var \Wrsft\Model\Table\RolesUsersTable $RolesUsers;
     */
    public $RolesUsers;

    /**
     * @var \Wrsft\Model\Table\EventsResellersTable $EventsResellers;
     */
    public $EventsResellers;

    public $fixtures = []; //'plugin.Wrsft.Events', 'plugin.Wrsft.Users', 'plugin.Wrsft.Roles'];
    public $autoFixtures = false;

    public function setUp()
    {
        Configure::write(
            'Fixture.Wrsft.EventsLocationIds',
            [
                Text::uuid(),
                Text::uuid(),
                Text::uuid()
            ]);

        parent::setUp();

        $request = new ServerRequest();
        $response = new Response();

        $controller = $this->getMockBuilder('Cake\Controller\Controller')
            ->setConstructorArgs([$request, $response])
            ->setMethods(null)
            ->getMock();

        $registry = new ComponentRegistry($controller);


        $this->Users = TableRegistry::get(
            "Users",
            [
                "className" => '\Wrsft\Model\Table\UsersTable'
            ]
        );
        $this->Roles = TableRegistry::get(
            "Roles",
            [
                "className" => '\Wrsft\Model\Table\RolesTable'
            ]
        );
        $this->Events = TableRegistry::get(
            "Events",
            [
                "className" => '\Wrsft\Model\Table\EventsTable'
            ]
        );
        $this->RolesUsers = TableRegistry::get(
            "RolesUsers",
            [
                "className" => '\Wrsft\Model\Table\RolesUsersTable'
            ]
        );

        $this->EventsResellers = TableRegistry::get(
            "EventsResellers",
            [
                "className" => '\Wrsft\Model\Table\EventsResellersTable'
            ]
        );

        $handle = $this;

        $this->preLoadFixtures(
            ['plugin.Wrsft.Events', 'plugin.Wrsft.Users', 'plugin.Wrsft.Roles'],

            function() use($handle){
                $handle->loadFixtures('Events', 'Users', 'Roles');
            }
        );

        $this->provision_rolesUsers();

        $this->component = $registry->load(
            "EventServices",
            [
                'className' => '\Wrsft\Controller\Component\EventServicesComponent'
            ]
        );

    }

    public function  tearDown()
    {
        $this->dropTable(
            $this->EventsResellers->getTable(),
            new EventsResellersFixture());

        parent::tearDown();
    }

    // all inserts should raise events and notify resellers

    public function test_retrieve_all_events_succeed(){

       $this->provisionResellers();

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

        $this->provisionResellers();

        $eventCalled = false;
        EventManager::instance()->on(
            EventServicesComponent::EVENT_CREATED,
            function(Event $event) use (&$eventCalled){
                $eventCalled = true;
            });

        $this->EventsResellers->deleteAll([]);

        $insertionResult = $this->component->insert_events([self::$ecowas_event]);

        $this->assertEquals(
            "Forum ECOWAS", $insertionResult["events"]['entities'][0]->title);

        $this->assertCount(4, $this->component->retrieveEvents(false));

        //assert event raised
        $this->assertTrue($eventCalled, "Event Created event should have been called");
        // assert resellers notified
        $this->assertCount(2, $this->EventsResellers->find()->toArray());
    }

    public function test_insert_invalid_simple_event_fail(){

        $this->provisionResellers();

        $eventRaised = false;
        EventManager::instance()->on(
            EventServicesComponent::EVENT_CREATED,
            function(Event $event) use(&$eventRaised){
                $eventRaised = true;
        });

        $ecowas_evt = self::$ecowas_event;
        unset($ecowas_evt["title"]);
        $this->EventsResellers->deleteAll([]);

        $insertionResult = $this->component->insert_events([$ecowas_evt]);

        $this->assertEmpty($insertionResult["events"]["entities"]);
        $this->assertCount(3, $this->component->retrieveEvents(false));
        //assert event not raised
        $this->assertFalse($eventRaised,  "Event Created event should not have been called");
        //assert resellers not notified
        $this->assertCount(0, $this->EventsResellers->find()->toArray());
    }

    /**
     *
     * @depends test_insert_simple_event_succeed
     *
     * @param $insertionResult
     */
    public function test_update_event_minCost_increased_succeed(){

        $this->provisionResellers();
        $eventRaised = false;

        EventManager::instance()->on(
            EventServicesComponent::EVENT_UPDATED,
            function(Event $event) use (&$eventRaised){
                $eventRaised = true;
            });

        $insertionResult = $this->component->insert_events([self::$ecowas_event]);

        $event =  $insertionResult["events"]["entities"][0];
        $event->sub_header = "Breaking news!";
        $event->min_cost = 470;

        $eventArr = $event->toArray();
        //only notify reseller  min cost if more than default_cost || new min cost is more than reseller min_cost
        $this->component->update_event($eventArr);

        $event = $this->Events->get(
            $event->id,
            [
                "contain" => ["Resellers"]
            ]);

        $resellersAttempt = $event->resellers;
        $eventResellers = $this->EventsResellers->find()->toArray();

        $this->assertCount(2, $resellersAttempt);

        $updated = true;
        foreach ($eventResellers as $reseller){
            if( ($reseller->event_id == $event->id ) && ($reseller->cost !== $event->min_cost)){
                $updated = false;
                break;
            }
        }

        $this->assertTrue($eventRaised, "Event's update event should have been called");

        $this->assertTrue($updated, "Failed updating resellers");
    }

    /**
     *
     * @depends test_insert_simple_event_succeed
     *
     * @param $insertionResult
     */
    public function test_update_event_defaultCost_decreased_moreThan_prevMinCost_succeed(){

        $this->provisionResellers();

        $insertionResult = $this->component->insert_events([self::$ecowas_event]);
        $event = $insertionResult["events"]["entities"][0];

        $event->sub_header = "Breaking news!";
        $event->min_cost = 400.51;
        $event->default_cost = 445;
        //only notify reseller  min cost if more than default_cost || new min cost is more than reseller min_cost
        $this->component->update_event($event->toArray());
        $eventResellers = $this->EventsResellers->find()->where(["event_id" => $event->id])->toArray();

        $this->assertCount(2, $eventResellers, "more than 2 entries found");
        $updated = true;

        foreach ($eventResellers as $reseller){
            if($reseller->cost < $event->min_cost || $reseller->cost > $event->default_cost){
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

        $data = [
            $this::$ecowas_event
            ,
            [
                "title" => "Forum BECAO",
                "sub_header" => "Sommet des financier",
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
        ];

        $arr = $this->Events->newEntities($data);
        $this->Events->saveMany($arr, ["associated" => false]);
    }

    ///
    /// creates "reseller" role, add two new users and
    /// adds an eventReseller with just one reseller for a first found event
    private function provisionResellers(){

        $resellerRole = $this->Roles->newEntity([ "name" => EventServicesComponent::ROLE_RESELLER]);
        $resellerRole = $this->Roles->saveOrFail($resellerRole);

        $password = "Password%1";

        $entities = $this->Users->newEntities([
            [
                'first_name' => "Audrey",
                'last_name' => 'Sekongo',
                'email' => 'audreyane@wrsft.com',
                'confirmed' => 'T',
                'disabled' => 'F',
                'password' => $password,
                'birth_date' => (new Date('1980-02-22'))->format('Y-m-d'),
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
                'birth_date' => (new Date('1985-02-22'))->format('Y-m-d'),
                "roles" => [
                    [
                        "id" => $resellerRole->id
                    ]
                ]
            ],
        ]);

        $this->Users->saveMany(
            $entities,
            [
                "associated" => ["Roles"]
            ]);

        $topEvent = $this->Events->find()->firstOrFail();
        $resellers = $this->component->GetAllResellers();

        $eventResellerFixture = new EventsResellersFixture();
        $this->createOrTruncateTable($this->EventsResellers->getTable(), $eventResellerFixture);

        Configure::write(
            'Fixtures.Wrsft.EventsResellers',
            [
                ["event_id" => $topEvent->id,  "user_id" => $resellers[0]->id, "cost" => 365]
            ]);

        $eventResellerFixture->init();
        $eventResellerFixture->insert(ConnectionManager::get("test"));

        $resellers = $this->component->GetAllResellers();
    }

    private function preLoadFixtures(array $fixtures, $callable){

        $fixtureManager = $this->fixtureManager;
        $testObject = $this;
        $this->fixtures = $fixtures;

        $closure = \Closure::bind(
            function() use($fixtureManager, $testObject){
                call_user_func(array($fixtureManager, "_loadFixtures"), $testObject);
            },
            null,
            $fixtureManager
        );

        $closure();
        $callable();
    }

    private function provision_rolesUsers(){
        $usersConfig = Configure::read('Fixture.Wrsft.Users');

        Configure::write(
            'Fixture.Wrsft.UsersRoles', [
            ["user_id" => $usersConfig[0], "role_id" => 2]
        ]);

        $handle = $this;
//
        $this->preLoadFixtures(
            ['plugin.Wrsft.Users', 'plugin.Wrsft.Events', 'plugin.Wrsft.Roles', 'plugin.Wrsft.RolesUsers'],

            function() use($handle){
                $handle->loadFixtures( 'Users', 'Roles', 'RolesUsers','Events' );
            }
        );
    }

    private function createOrTruncateTable($tableName, TestFixture $fixture){

        $connectionInterface =   ConnectionManager::get("test");

        if($this->tableExist($tableName) === true){
            $fixture->truncate($connectionInterface);
        }
        else{
            $fixture->create($connectionInterface);
            $fixture->createConstraints($connectionInterface);
        }


    }

    private function dropTable($tableName, TestFixture $fixture){
        $connectionInterface =   ConnectionManager::get("test");

        if($this->tableExist($tableName) === true){
            $fixture->truncate($connectionInterface);
            $fixture->dropConstraints($connectionInterface);
            $fixture->drop($connectionInterface);
        }
    }

    private function tableExist($tableName){

        $connectionInterface =   ConnectionManager::get("test");
        $tables = $connectionInterface->schemaCollection()->listTables();
        $tableFound = in_array($tableName, $tables);
        return $tableFound;
    }

}