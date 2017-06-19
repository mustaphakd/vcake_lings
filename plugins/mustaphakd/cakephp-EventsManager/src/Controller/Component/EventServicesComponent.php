<?php
/**
 * Prjct: Vhealings
 * User: musta
 * Date: 5/24/2017
 * Time: 12:20 AM
 */

namespace Wrsft\Controller\Component;


use Cake\Controller\Component;
use Cake\Event\Event;
use Cake\Event\EventManager;
use Cake\ORM\Entity;
use Cake\ORM\TableRegistry;
use Wrsft\Model\Entity\EventEntity;
use Wrsft\Model\Entity\UserEntity;

class EventServicesComponent extends Component
{

    const domain = 'Wrsft\event_service';
    const EVENT_CREATED = "Event.created";
    const EVENT_UPDATED = "Event.updated";
    const ROLE_RESELLER = "reseller";

    /**
     * @var \Wrsft\Model\Table\EventsTable $Events;
     */
    public $Events;

    /**
     * @var \Wrsft\Model\Table\LocationsTable $Locations
     */
    public $Locations;

    /**
     * @var \Wrsft\Model\Table\RolesTable $Roles.
     */
    public $Roles;

    /**
     * @var \Wrsft\Model\Table\UsersTable $Users.
     */
    public $Users;


    /**
     * @var \Wrsft\Model\Table\EventsResellersTable.
     */
    public $EventsResellers;

    public function initialize(array $config)
    {
        $this->Events = TableRegistry::get(
            "Events",
            [
              'className' => '\Wrsft\Model\Table\EventsTable'
            ]
        );

        $this->Locations = TableRegistry::get(
            "Locations",
            [
                'className' => '\Wrsft\Model\Table\LocationsTable'
            ]
        );

        $this->Roles = TableRegistry::get(
            "Roles",
            [
                "className" => '\Wrsft\Model\Table\RolesTable'
            ]
        );

        $this->Users = TableRegistry::get(
            "Users",
            [
                "className" => '\Wrsft\Model\Table\UsersTable'
            ]
        );

        $this->EventsResellers = TableRegistry::get(
            "EventsResellers",
            [
                "className" => '\Wrsft\Model\Table\EventsResellersTable'
            ]
        );
    }


    /**
     * @param bool $visibles. Default is true to retrieve only Events witht their visibility set to true. if false, \
     * all events are returned
     * @param array|null $options. clause for where statement
     * @return array
     */
    public function retrieveEvents($visibles = true, array $options = null){

        if($options === null){
            $options = [];
        }

        if($visibles)
            $options["visible"] = 'T';

        return $this->Events->find()->where($options)->toArray();
    }

    public function getLocation($locaitonId){

        return $this->Locations->get($locaitonId);
    }

    public function insert_events(array $events, array $timelines = [], array $images = [], array $tags = []){

        if(empty($events))
        {
            return $this->insertionResult([
                "entities" => [],
                "message" => __d(self::domain, "events were not created")
            ]);
        }

        $events = $this->Events->newEntities($events);
        $errorMessages = $this->getEntitiesErrorMessage($events);

        if( $errorMessages != false){
            return $this->insertionResult(
                [
                    "message" => $errorMessages
                ]
            );
        }

        $newEvents = $this->Events->saveMany($events);

        if($newEvents === false){
            return $this->insertionResult();
        }

        EventManager::instance()->dispatch(
            new Event(
                self::EVENT_CREATED,
                $this,
                [$newEvents]));

        $timelinesMessages = [];
        $imagesMessages = [];
        $tagsMessages = [];

        foreach ($newEvents as $event) {
            $current_timelines = null;
            $current_images = null;
            $current_tags = null;

            if(!empty($timelines)){
                $current_timelines = array_slice($timelines, 0, 1);
                $timelines = array_slice($timelines, 0);
            }

            $timelinesMessages[] = $this->insert_timelines($current_timelines, $event);

            if(!empty($images)){
                $current_images = array_slice($images, 0, 1);
                $images = array_slice($images, 0);
            }

            $imagesMessages[] = $this->insert_images($current_images, $event);

            if(!empty($tags)){
                $current_tags = array_slice($tags, 0, 1);
                $tags = array_slice($tags, 0);
            }
            $tagsMessages[] = $this->insert_tags($current_tags, $event);
        }

        $response = $this->insertionResult(
            [
                "entities" => $events,
                "message" => __d(self::domain, "{0}{1} were created", count($events), "events")
            ],
            $timelinesMessages,
            $imagesMessages,
            $tagsMessages);

        $this->notifyResellers($newEvents, true);

        return $response;
    }

    public function update_event(array $event, array $timelines = [], array $images = [], array $tags = []){

        if(empty($event))
        {
            return $this->insertionResult([
                "entities" => false,
                "message" => __d(self::domain, "events were not updated")
            ]);
        }

        $foundEvent = $this->Events->get($event["id"]);
        unset($event["id"]);

        $event = $this->Events->patchEntity($foundEvent, $event, []);
        $errorMessages = $event->getErrors();

        if( $errorMessages != false){
            return $this->insertionResult(
                [
                    "message" => $errorMessages
                ]
            );
        }

        $newEvent = $this->Events->save($event);

        if($newEvent === false){
            return $this->insertionResult();
        }

        EventManager::instance()->dispatch(
            new Event(
                self::EVENT_UPDATED,
                $this,
                [$newEvent]));

        $timelinesMessages = $this->insert_timelines($timelines, $event);
        $imagesMessages = $this->insert_images($images, $event);
        $tagsMessages = $this->insert_tags($tags, $event);

        $response = $this->insertionResult(
            [
                "entities" => $event,
                "message" => __d(self::domain, "{0} {1} {3} created", 1, "event", "was")
            ],
            $timelinesMessages,
            $imagesMessages,
            $tagsMessages);

        $this->notifyResellers([$newEvent], false);

        return $response;
    }

    public  function __call($name, $arguments)
    {
        //echo "\n method $name called. \n";
        return [];
    }

    private function notifyResellers(array $eventEntities, $isNew = false){

        $resellers = $this->GetAllResellers();

        if(empty($resellers))
            return false;

        foreach ($resellers as $reseller){
            $this->notifyReseller($reseller, $eventEntities, $isNew);
        }
        return $resellers;
    }

    private function notifyReseller(UserEntity $reseller, array $eventEntities, $isNew = false){

        foreach ($eventEntities as $event){
            $this->EventsResellers->addEventToReseller(
                $reseller,
                $event,
                $isNew);
        }
    }

    private function getEntitiesErrorMessage(array $entities){

        $errorMessage = false;

        foreach ( $entities as $entity) {
            if(! empty($entity->getErrors())){
                $errorMessage = $entity->getErrors();
                return $errorMessage;
            }
        }

        return $errorMessage;
    }

    private function insertionResult(array $eventResponse = [], array $timelinesResponse = [], array $imagesResponse = [], array $tagsResponse = []){

        $eventResponse += [
            "entities" => [],
            "message" => __d(self::domain, "{0} were not created", "events")
        ];



        $timelinesResponse = array_replace_recursive(
            [
                "entities" => [],
                "message" => __d(self::domain, "{0} were not created", "timelines")
            ],
            $timelinesResponse);

        $imagesResponse = array_replace_recursive(
            [
                "entities" => [],
                "message" => __d(self::domain, "{0} were not created", "images")
            ],
            $imagesResponse);

        $tagsResponse = array_replace_recursive(
            [
                "entities" => [],
                "message" => __d(self::domain, "{0} were not created", "tags")
            ],
            $tagsResponse);

        return [
            "events" => $eventResponse,
            "images" => $imagesResponse,
            "tags" => $tagsResponse,
            "timelines" => $timelinesResponse
        ];
    }

    /**
     * @return array of Resellers
     */
    public function GetAllResellers()
    {
        $query = $this->Users->find()
            ->where([
                "confirmed" => 'T',
                "disabled" => 'F'
            ])
            ->innerJoinWith(
                "Roles",
                function ($q) {
                    return $q->where(["name" => "reseller"]);
                });

        $resellers = $query->toArray();
        return $resellers;
    }

}