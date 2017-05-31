<?php
/**
 * Prjct: Vhealings
 * User: musta
 * Date: 5/23/2017
 * Time: 10:16 PM
 */

namespace Wrsft\Model\Table;


use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use Cake\Validation\Validator;
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
        "default_cost" => ["type" => "decimal", "unsigned" => true],
        "min_cost" => ["type" => "decimal", "unsigned" => true],
        "max_participant" => ["type" => "integer", "unsigned" => true],
        "currency" => ["type" => "string", "fixed" => false, "length" => 5],
        "video_path" => ["type" => "string", "fixed" => false, "length" => 2200],
        "status" => ["type" => "string", "fixed" => false, "length" => 6], //open | closed | soon
        "location_id" => ["type" => "uuid"]
    ];

    private static $domain = 'Wrsft\Events';

    public function initialize(array $config)
    {
        $this->setDisplayField("title");
        $this->setEntityClass('Wrsft\Model\Entity\EventEntity');

        $this->setSchema(self::SCHEMA);
    }

    public function getLocation(EventEntity $event){
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
    }

}