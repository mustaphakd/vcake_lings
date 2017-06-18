<?php
/**
 * Prjct: Vhealings
 * User: musta
 * Date: 5/23/2017
 * Time: 10:16 PM
 */

namespace Wrsft\Model\Table;


use Cake\Chronos\Date;
use Cake\Database\Schema\TableSchema;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use Cake\Validation\Validator;
use Symfony\Component\Finder\Comparator\DateComparator;
use Wrsft\Database\Point;
use Wrsft\Model\Entity\EventEntity;

class EventsTable extends Table
{
    const SCHEMA = [
        "id" => ["type" => "uuid"],
        "title" => ["type" => "string", "fixed" => false, "null" => false, "length" => 15],
        "sub_header" => ["type" => "string", "fixed" => false, "null" => false, "length" => 25],
        "description" => ["type" => "text", "length" => "medium"],
        "start_date" => ["type" => "date", "null" => false],
        "end_date" => ["type" => "date", "null" => false],
        "default_cost" => ["type" => "decimal", "unsigned" => true], //as seen by non affiliated
        "min_cost" => ["type" => "decimal", "unsigned" => true], // mandated by the affiliated. upper lower bound
        "max_participants" => ["type" => "integer", "unsigned" => true],
        "currency" => ["type" => "string", "fixed" => false, "length" => 5],
        "video_path" => ["type" => "string", "fixed" => false, "length" => 2200],
        "status" => ["type" => "string", "fixed" => false, "length" => 6], //open | closed | soon
        "location_id" => ["type" => "uuid"],
        "visible" => ["type" => "string", "default" => "F", "fixed" => true, "length" => 1],
        "_constraints" => [
            "prim" => [
                "type" => "primary",
                "columns" => ["id"]
            ],
            "unique_flds" => [
                "type" => TableSchema::CONSTRAINT_UNIQUE,
                "columns" => ["title", "start_date"]
            ]
        ]
    ];

    const EVENT_STATUS_OPEN =   "open";
    const EVENT_STATUS_CLOSED =   "closed";
    const EVENT_STATUS_SOON =   "soon";

    private static $domain = 'Wrsft\Events';

    public function initialize(array $config)
    {
        $this->setDisplayField("title");
        $this->setEntityClass('Wrsft\Model\Entity\EventEntity');

        $this->setTable("events");
        $this->setSchema(self::SCHEMA);
        $this->getSchema()->addIndex(
            "title_idx",
            [
                "type" => TableSchema::INDEX_INDEX,
                "columns" => ["title"]
            ]
        );

        $this->hasMany(
            "EventsResellers",
            [
                "className" => '\Wrsft\Model\Table\EventsResellersTable',
                "foreignKey" => 'event_id',
                "cascade" => false
            ]
        );

        $this->belongsToMany(
            "Resellers",
            [
                "className" => '\Wrsft\Model\Table\UsersTable',
                'through' => new EventsResellersTable(),
                "foreignKey" => 'event_id',
                "targetForeignKey" => "user_id",
                "cascade" => false
            ]
        );

        $this->belongsToMany(
            "Timelines",
            [
                "className" => "\Wrsft\Model\Table\TimeLinesTable",
                "through" => '\Wrsft\Model\Table\EventsTimeLinesTable',
                "foreignKey" => "event_id",
                "targetForeignKey" => "time_line_id",
                "cascade" => false
            ]
        );

        $this->hasMany(
            "Registrations",
            [
                "className" => '\Wrsft\Model\Table\EventRegistrationsTable',
                "foreignKey" => "event_id",
                "cascade" => false
            ]
        );
    }

    public function getLocation(EventEntity $event){

        if(empty($event->location_id))
            return null;

        $locations = TableRegistry::get(
            "Locations",
            [
                "className" => 'Wrsft\Model\Table\LocationsTable'
            ]);

        return $locations->get($event->location_id);
    }

    public function validationDefault(Validator $validator)
    {
        //validate date start and end make sure end greater than start and duration is not more than one month
        $validator
            ->requirePresence(
                ["title", "sub_header", "description", "start_date", "end_date", "default_cost", "min_cost", "status"],
                true,
                __d(self::$domain, "title, sub header, description, start and end dates, min and default cost, as well as status are required"))
            ->lengthBetween("title",[1, 15],__d(self::$domain, "{0} length must be between 1 and {1} characters", "title", 15))
            ->lengthBetween("sub_header",[1, 25],__d(self::$domain, "{0} length must be between 1 and {1} characters", "sub header", 25))
            ->lengthBetween("currency",[1, 15],__d(self::$domain, "{0} length must be between 1 and {1} characters", "currency", 5))
            ->lengthBetween("status",[1, 15],__d(self::$domain, "{0} length must be between 1 and {1} characters", "status", 6))
            ->lengthBetween("video_path",[1, 2200],__d(self::$domain, "{0} length must be between 1 and {1} characters", "title", 2200))
            ->add(
                "start_date",
                [
                    "date_comparison" => [
                        "rule" => function ($value, $context){

                            if (empty($value) || !isset($context["data"]["end_date"]) || empty($context["data"]["end_date"])){
                                return false;
                            }

                            $starting_date = Date::parse($value);
                            $ending_date = Date::parse($context["data"]["end_date"]);


                            if(($ending_date->gt($starting_date))){
                                return true;
                            }
                            return false;
                         },
                        __d(self::$domain, "starting date must be less than ending date")
                    ]
                ])
            ->uuid("location_id", __d(self::$domain, "valid {0} reference required", "location"))
            ->add(
                "visible",
                [
                    "visible_validation" => [
                        "rule" => function($value, $context){

                            if(empty($value))
                                return false;

                            if(
                                $value === 'T' || $value === 't' ||
                                $value === 'F' || $value === 'f'){
                                return true;
                            }

                            return false;


                        },
                        __d(self::$domain, "visibility must be set to either T or F")
                    ]
                ]);

        return $validator;
    }

}