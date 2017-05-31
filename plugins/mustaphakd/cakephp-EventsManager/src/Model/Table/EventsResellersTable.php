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
            "user_fk" => [
                "type" => "foreign",
                "columns" => "user_id",
                "references" => ["users", "id"]
            ],
            "event_fk" => [
                "type" => "foreign",
                "columns" => ["event_id"],
                "references" => ["events", "id"]
            ]
        ]
    ];

    public function initialize(array $config)
    {
        $this->setEntityClass('Wrsft\Model\Entity\EventResellerEntity');
        parent::initialize($config);

        $this->setSchema(self::SCHEMA);
    }

    public function addEventToReseller(UserEntity $user, EventEntity $event){

    }

    public function validationDefault(Validator $validator)
    {
    }

}