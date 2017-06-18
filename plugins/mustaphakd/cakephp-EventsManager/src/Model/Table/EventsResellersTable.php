<?php
/**
 * Prjct: Vhealings
 * User: musta
 * Date: 5/23/2017
 * Time: 10:18 PM
 */

namespace Wrsft\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;
use Wrsft\Model\Entity\EventEntity;
use Wrsft\Model\Entity\UserEntity;


class EventsResellersTable extends Table
{
    private static $domain = 'Wrsft\EventResellers';
/*
 *
 * */
    const SCHEMA = [
        "id" => ["type" => "uuid"],
        "user_id" => ["type" => "uuid", "null" => false],
        "event_id" => ["type" => "uuid", "null" => false],
        "cost" => ["type" => "decimal", "null" => false],
        "created" => ["type" => "datetime"],
        "modified" => ["type" => "datetime"],
        "auto_update" => ["type" => "string", "default" => 'T', "length" => 1],
        "_constraints" => [
            "prim" => [
                "type" => "primary",
                "columns" => ["id"]
            ],
            "eventreseller_user_fk" => [
                "type" => "foreign",
                "columns" => ["user_id"],
                "references" => ["users", "id"]
            ],
            "eventreseller_event_fk" => [
                "type" => "foreign",
                "columns" => ["event_id"],
                "references" => ["events", "id"]
            ]
        ]
    ];

    public function initialize(array $config)
    {
        $this->setTable("events_resellers");
        $this->setEntityClass('Wrsft\Model\Entity\EventResellerEntity');
        parent::initialize($config);

        $this->setSchema(self::SCHEMA);

        $this->belongsTo(
            "Events",
            [
                "className" => '\Wrsft\Model\Table\EventsTable',
                "foreignKey" => "event_id"
            ]
        );

        $this->belongsTo(
            "Users",
            [
                "className" => '\Wrsft\Model\Table\UsersTable',
                "foreignKey" => "user_id"
            ]
        );
    }

    public function addEventToReseller(UserEntity $user, EventEntity $event, $isNew = false){

        $data = [
            "user_id" => $user->id,
            "event_id" => $event->id,
            "cost" => $event->min_cost,
            "auto_update" => 'T'
        ];

        if($isNew){
            $entity = $this->newEntity($data);
            if($entity->getErrors()){
                throw new \Exception("Error creating Event-Reseller entry");
            }

            $this->save($entity);
            return;
        }

        unset($data["cost"]);
        unset($data["auto_update"]);
        debug("before calle");
        $existingEntity = $this->find()->where($data)->firstOrFail();
        debug("after calle");
        $dirty = false;

        if($existingEntity->cost > $event->default_cost){

            $existingEntity->cost = $event->default_cost;
            $existingEntity->setDirty("cost", true);
            $dirty = true;

        }
        elseif ($existingEntity->cost < $event->min_cost){

            $existingEntity->cost = $event->min_cost;
            $existingEntity->setDirty("cost", true);
            $dirty = true;
        }
        elseif ($existingEntity->auto_update === 'T'){

            $existingEntity->cost = $event->min_cost;
            $existingEntity->setDirty("cost", true);
            $dirty = true;
        }

        if($dirty){
            $this->save($existingEntity);
        }

        return;
    }

    public function validationDefault(Validator $validator)
    {
        $validator
            ->requirePresence(
                ["user_id", "event_id", "cost"],
                true,
                __d(self::$domain, "{0} presence required", "user, event, cost"))
            ->uuid("user_id")->uuid("event_id")
            ->decimal("cost");

        return $validator;
    }

}