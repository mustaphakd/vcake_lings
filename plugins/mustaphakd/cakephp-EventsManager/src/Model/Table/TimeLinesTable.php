<?php
/**
 * Prjct: Vhealings
 * User: musta
 * Date: 5/23/2017
 * Time: 10:20 PM
 */

namespace Wrsft\Model\Table;


use Cake\Database\Schema\TableSchema;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class TimeLinesTable extends Table
{
    const SCHEMA = [
        "id" => ["type" => "uuid"],
        "start" => ["type" => "time", "null" => false],
        "end" => ["type" => "time", "null" => false],
        "synopsys" => ["type" => "text", "length" => "tiny"],
        "image" => ["type" => "string", "fixed" => false, "length" => 100],
        "_constraints" =>
        [
            "prim" => [
                "type" => "primary",
                "columns" => ["id"]
            ],
            "unique_flds" => [
                "type" => TableSchema::CONSTRAINT_UNIQUE,
                "columns" => ["start", "end"]
            ]
        ]
    ];

    private static $domain = 'Wrsft\TimeLines';

    public function initialize(array $config)
    {
        $this->setTable("time_line");
        $this->setDisplayField("start");
        $this->setEntityClass('Wrst\Model\Entity\TimeLineEntity');

        $this->setSchema(self::SCHEMA);

        $this->belongsToMany(
            "Events",
            [
                "className" => "\Wrsft\Model\Table\EventsTable",
                "through" =>  new EventsTimeLinesTable(),
                "foreignKey" => "time_line_id",
                "targetForeignKey" => "event_id",
                "cascade" => false
            ]
        );
    }

    public function validationDefault(Validator $validator)
    {
        $validator
            ->requirePresence(
                ["start", "end", "synopsys"],
                true,
                __d(self::$domain, '{0} presence required', "start and end time, synopsys")
            )
            ->uuid("id")
            ->time("start", __d(self::$domain, "time format required for {0}", "start"))
            ->time("end", __d(self::$domain, "time format required for {0}", "end"))
            ->lengthBetween("synopsys", [1, TableSchema::LENGTH_TINY])
            ->maxLength(
                "image",
                100,
                __d(self::$domain, "Maximum allowed characters for image is 100"));

        return $validator;

    }


}