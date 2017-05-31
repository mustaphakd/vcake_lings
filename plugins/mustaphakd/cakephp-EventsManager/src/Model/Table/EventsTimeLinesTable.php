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
        "id" => [],
        "event_id" => [],
        "time_line_id" => [],
        "date_heading" => [],
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

        $this->setDisplayField("date_heading");

        $this->setSchema(self::SCHEMA);
    }

    public function validationDefault(Validator $validator)
    {
    }

}