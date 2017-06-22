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
use Cake\I18n\Time;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\Fixture\TestFixture;
use Cake\TestSuite\TestCase;
use Cake\Utility\Text;
use Wrsft\Controller\Component\EventServicesComponent;
use Wrsft\Test\Fixture\EventsResellersFixture;
use Wrsft\Test\Fixture\EventTimeLineFixture;

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

    /**
     * @var \Wrsft\Model\Table\TimeLinesTable $TimeLines;
     */
    public $TimeLines;

    /**
     * @var \Wrsft\Model\Table\EventsTimeLinesTable $EventsTimeLines;
     */
    public $EventsTimeLines;

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

        if( $this->EventsTimeLines !== null) {
            $this->dropTable(
                $this->EventsTimeLines->getTable(),
                new EventTimeLineFixture());
        }

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

        $eventRaised = false;

        EventManager::instance()->on(
            EventServicesComponent::EVENT_UPDATED,
            function($event) use(&$eventRaised){
                $eventRaised = true;
            }
        );

        $this->provisionResellers();
        $topEvent = $this->Events->find()->firstOrFail();
        $this->addPatronsToEvent($topEvent);

        $oldCost = $topEvent->default_cost;
        $topEvent->default_cost = 700;

        $this->component->update_event($topEvent->toArray());

        $foundEvent = $this->Events->get($topEvent->id);

        $this->assertNotNull($foundEvent, "Weird! existing event should have been found");
        $this->assertEquals($oldCost, $foundEvent->default_cost, "Event cost shouldn't change when there are existing patrons");
        $this->assertFalse($eventRaised, "event.updated should not have been raised");
    }

    //should only be able to update or delete non-visible -with no registered users

    public function test_register_user_4_event_succeed(){
    //todo: patron event registration
    }

    public function test_register_user_4_event_fail(){

    }

    public function test_update_event_with_registeredUsers_fail(){

    }

    public function test_create_simple_timeLine_succeed(){

        $this->provisionTimeLines();
        $data = [
            ["start" => "08:30 ", "end" => "09:15", "synopsys" => "brief description blah", "image" => 'ffadf\fadfa\fasdfa.png'],
            ["start" => "08:30 ", "end" => "09:30", "synopsys" => "brief description blah", "image" => 'ffadf\fadfa\fasdfa.png']
        ];

        $newEntities = $this->TimeLines->newEntities($data);

        $hasErrors = false;

        foreach ($newEntities as $newEntity){
            if($newEntity->getErrors()){
                $hasErrors = true;
                break;
            }
        }

        $this->assertFalse($hasErrors, "data has errors! || constrains/Sql issues");

        $this->TimeLines->save($newEntities);

        $foundEntities = $this->TimeLines->find()->toArray();

        $this->assertCount(7, $foundEntities);
    }

    public function test_update_simple_timeLine_succeed(){

        $this->provisionTimeLines();
        $timeLine = $this->TimeLines->find()->firstOrFail();

        $this->assertNotNull($timeLine, "TimelineFixture not created");


        debug($timeLine->start);

        $editTime = Time::parseTime($timeLine->start);

        $editTime->addHours(2);
        $editTime->addMinute();
        $editTime = $editTime->format("H:mm:ss");

        debug($editTime);

        $update = $this->TimeLines->patchEntity($timeLine, ["start" => $editTime]);

        $this->assertFalse($update->getErrors(), "Errors should not have been present");

        $this->TimeLines->save($update);

        $foundEntity = $this->TimeLines->get($timeLine->id);

        $foundEntityTime = Time::parseTime($foundEntity->start);
        $foundEntityFormattedTime = $foundEntityTime->format("H:mm:ss");

        $this->assertEquals($editTime, $foundEntityFormattedTime, "Formatted time do not match");
    }

    public function test_update_simple_timeLine_startGtEnd_fails(){

        $this->provisionTimeLines();
        $timeLine = $this->TimeLines->find()->firstOrFail();

        $this->assertNotNull($timeLine, "TimelineFixture not created");


        debug($timeLine->start);
        debug($timeLine->end);

        $editStartTime = Time::parseTime($timeLine->start);
        $editEndTime = Time::parseTime($timeLine->end);

        $tempFormattedTimeStart = $editStartTime->format("H:mm:ss");
        $editStartTime = $editEndTime->format("H:mm:ss");
        $editEndTime = $tempFormattedTimeStart;

        $newPatchedEntity = $this->TimeLines->patchEntity(
            $timeLine,
            [
                "start" => $editStartTime,
                "end" => $editEndTime
            ]);

        $this->assertNotFalse($newPatchedEntity->getErrors(), "GetErrors returned false");
    }

    public function test_delete_unused_timeLine_succeed(){

        $this->provisionTimeLines();
        $timeLine = $this->TimeLines->find()->firstOrFail();

        $this->assertNotNull($timeLine, "TimelineFixture not created");

        $this->component->deleteTimeLine($timeLine->id);

        $foundTimeLine = $this->TimeLines->get($timeLine->id);

        $this->assertNull($foundTimeLine, "TimeLine should have been deleted");

    }

    public function test_delete_used_timeLine_fail(){

        $this->provisionTimeLines();
        $timeLine = $this->TimeLines->find()->firstOrFail();

        $event = $this->Events->find()->firstOrFail();

        $this->assertNotNull($timeLine, "TimelineFixture not created");
        $this->assertNotNull($event, "EventsFixture not created");

        $newEntity = $this->EventsTimeLines->newEntity([
            "event_id" => $event->id,
            "time_line_id" => $timeLine->id
        ]);

        $this->EventsTimeLines->save($newEntity);

        $this->assertCount(1, $this->EventsTimeLines->find()->toArray());

        $success = $this->TimeLines->delete($this->TimeLines->get($timeLine->id));

        $this->assertFalse($success, "TimeLine should not have been deleted");
    }

    public function test_create_event_with_new_timeLine_succeed(){

        $this->provisionTimeLines();

        $newEvent = self::$ecowas_event;
        $newTimeLines = self::$creation_timeLines;

        $insertionResult = $this->component->insert_events([$newEvent], $newTimeLines);

        $createdEvent = $insertionResult["events"]["entities"][0];
        $createdTimeLines = $insertionResult["timelines"]["entities"];

        $this->assertEquals($newEvent["title"], $createdEvent->title);
        $this->assertEquals($newEvent["min_cost"], $createdEvent->min_cost);
        $this->assertEquals($newEvent["end_date"], $createdEvent->end_date->format("yyyy-mm-dd"));

        $this->assertCount(2, $createdTimeLines);

        $foundEvent = $this->Events->get($createdEvent->id, ['contains' => "TimeLines"]);
        $foundTimeLines = $foundEvent->TimeLines->toArray();
        $foundCount = 0;

        $this->assertCount(2, $foundTimeLines);

        foreach ($foundTimeLines as $foundTimeLine){
            foreach ($createdTimeLines as $createdTimeLine){
                if($foundTimeLine->id === $createdTimeLine->id){
                    $foundCount += 1;
                    break;
                }
            }
        }

        $this->assertEquals(2, $foundCount, "EventServicesComponent failed to create all records");
    }

    /**
     * @depends test_create_event_with_new_timeLine_succeed
     */
    public function test_create_event_with_newAndExisting_timeLine_succeed(){
        //$this->provisionResellers();  //to be enabled if eventResellerTable does not exist
        $this->provisionTimeLines();
        $this->TimeLines->newEntities(self::$creation_timeLines);

        $existingTimelines = $this->TimeLines->find()->toArray();
        $firstExistingTimeLine = $existingTimelines[0];
        $secondExistingTimeLine  = $existingTimelines[1];

        $newTimeline = ["start" => "13:30 ", "end" => "15:30", "synopsys" => "brief description blah", "image" => 'ffadf\fadfa\ttydfa.png'];

        $insertionResult = $this->component->insert_events(
            [self::$ecowas_event],
            [
                ["id" => $firstExistingTimeLine->id],
                ["id" => $secondExistingTimeLine->id],
                $newTimeline
            ]);

        $eventNotNull = $insertionResult["events"]["entities"][0];
        $eventTimelines = $insertionResult["timelines"]["entities"];

        $this->assertNull($eventNotNull);
        $this->assertCount(3, $eventTimelines);

        $foundEvent = $this->Events->get($eventNotNull->id, ["contains" => ["Timelines"]]);

        $this->assertCount(3, $foundEvent->timelines);
    }

    /**
     * @depends test_create_event_with_new_timeLine_succeed
     */
    public function test_create_event_with_existingEdited_timeLine_suceed(){
        //$this->provisionResellers();  //to be enabled if eventResellerTable does not exist
        $this->provisionTimeLines();
        $this->TimeLines->newEntities(self::$creation_timeLines);

        $existingTimelines = $this->TimeLines->find()->toArray();
        $firstExistingTimeLine = $existingTimelines[0];
        $secondExistingTimeLine  = $existingTimelines[1];

        $secondTimelineTime = Time::parseTime($secondExistingTimeLine->start);
        $secondTimelineTime->addMinute(13);
        $editedSecondTimelineTime = $secondTimelineTime->format("H:mm:ss");

        $insertionResult = $this->component->insert_events(
            [self::$ecowas_event],
            [
                ["id" => $firstExistingTimeLine->id],
                ["id" => $secondExistingTimeLine->id, "start" => $editedSecondTimelineTime]
            ]);

        $eventNotNull = $insertionResult["events"]["entities"][0];
        $eventTimelines = $insertionResult["timelines"]["entities"];

        $foundUpdatedTimeline = $this->TimeLines->get($secondTimelineTime->id);

        $foundUpdatedTimelineProperlyUpdated = false;

        if (
            $foundUpdatedTimeline->id === $secondTimelineTime->id &&
            $foundUpdatedTimeline->end === $secondTimelineTime->end &&
            $foundUpdatedTimeline->synopsys === $secondTimelineTime->synopsys &&
            $foundUpdatedTimeline->image === $secondTimelineTime->image &&
            $foundUpdatedTimeline->start !== $secondTimelineTime->start
        ){
            $foundUpdatedTimelineProperlyUpdated = true;
        }

        $this->assertNull($eventNotNull);
        $this->assertCount(2, $eventTimelines);

        $foundEvent = $this->Events->get($eventNotNull->id, ["contains" => ["Timelines"]]);

        $this->assertCount(2, $foundEvent->timelines);
        $this->assertTrue($foundUpdatedTimelineProperlyUpdated, "Mishap existing timeline start property not updated");
    }

    public function test_create_event_with_newAndExisting_images_succeed(){

    }

    public function test_update_event_with_newAndExisting_removingMissingIds_images_succeed(){

    }

    public function test_create_event_with_newAndExisting_tags_succeed(){

    }

    public function test_update_event_with_newAndExisting_removingMissingIds_tags_succeed(){

    }

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

    private static $creation_timeLines = [
        [
            "start" => "08:30 ",
            "end" => "09:15",
            "synopsys" => "brief description blah",
            "image" => 'ffadf\fadfa\fasdfa.png',
            "date_heading" => "day one"
        ],
        [
            "start" => "09:30 ",
            "end" => "11:00",
            "synopsys" => "deuxieme description blah",
            "image" => 'ffadf\fadfa\fasdfa2.png'
        ]
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

        $events = $this->Events->find()->toArray();
        $resellers = $this->component->GetAllResellers();

        $eventResellerFixture = new EventsResellersFixture();
        $this->createOrTruncateTable($this->EventsResellers->getTable(), $eventResellerFixture);

        $eventResellers = [];

        foreach($events as $event){
            foreach ($resellers as $reseller){
                $eventResellers[] = ["event_id" => $event->id,  "user_id" => $reseller->id, "cost" => 365] ;
            }
        }

        Configure::write(
            'Fixtures.Wrsft.EventsResellers',
            $eventResellers);

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

    private function provisionTimeLines(){
        $handle = $this;
        $this->preLoadFixtures(
            [
                'plugin.Wrsft.Events',
                'plugin.Wrsft.Users',
                'plugin.Wrsft.Roles',
                'plugin.Wrsft.Roles',
                'plugin.Wrsft.RolesUsers',
                'plugin.Wrsft.TimeLine'
            ],

            function() use($handle){
                $handle->loadFixtures('Events', 'Users', 'Roles', 'RolesUsers', 'TimeLine');
            }
        );

        $this->TimeLines = TableRegistry::get(
            "TimeLines",
            [
                "className" => '\Wrsft\Model\Table\TimeLinesTable'
            ]
        );
        $this->EventsTimeLines = TableRegistry::get(
            "EventsTimeLines",
            [
                "className" => '\Wrsft\Model\Table\EventsTimeLinesTable'
            ]
        );

        $eventTimeLineFixture = new EventTimeLineFixture();
        $this->createOrTruncateTable($this->EventsTimeLines->getTable(), $eventTimeLineFixture);
    }

}