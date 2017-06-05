<?php
/**
 * Prjct: Vhealings
 * User: musta
 * Date: 5/23/2017
 * Time: 10:21 PM
 */

namespace Wrsft\Model\Table;


use Cake\ORM\Table;
use Cake\Validation\Validator;

class EventsTimeLinesTable extends Table
{
    const SCHEMA = [
        "id" => ["type"=> "uuid"],
        "event_id" => ["type" => "uuid", "null" => false],
        "time_line_id" => ["type" => "uuid", "null" => false],
        "date_heading" => ["type" => "string", "null" => false, "fixed" => false, "length" =>  20],
        "_constraints" => [
            "prim" => [
                "type" => "primary",
                "columns" => ["id"]
            ],
            "event_fk" => [
                "type" => "foreign",
                "columns" => ["event_id"],
                "references" => ["events", "id"]
            ],
            "time_line_fk" => [
                "type" => "foreign",
                "columns" => ["time_line_id"],
                "references" => ["time_line", "id"]
            ]
        ]
    ];

    private static $domain = 'Wrsft\EventsTimeLines';

    public function initialize(array $config)
    {
        $this->setTable("events_time_line");
        $this->setDisplayField("date_heading");
        $this->setSchema(self::SCHEMA);

        $this->belongsTo(
            "Events",
            [
                "className" => '\Wrsft\Model\Table\EventsTable',
                "foreignKey" => "event_id"
            ]
        );

        $this->belongsTo(
            "Timelines",
            [
                "className" => '\Wrsft\Model\Table\TimeLinesTable',
                "foreignKey" => "time_line_id"
            ]
        );
    }

    public function validationDefault(Validator $validator)
    {
        $validator
            ->requirePresence(
                ["event_id", "time_line_id", "date_heading"],
                true,
                __d(self::$domain, "{0} presence required", "event, time line and date headings")
            )
            ->uuid("event_id")->uuid("time_line_id")->uuid("date_heading");

        return $validator;
    }

}