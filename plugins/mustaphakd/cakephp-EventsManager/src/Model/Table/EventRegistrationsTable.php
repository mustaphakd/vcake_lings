<?php
/**
 * Prjct: Vhealings
 * User: musta
 * Date: 5/23/2017
 * Time: 10:17 PM
 */

namespace Wrsft\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class EventRegistrationsTable extends Table
{
    //TODO: Add transaction foreign key reference
    private static $domain = 'Wrsft\EventRegistrations';

    const SCHEMA = [
        "id" => ["type" => "uuid"],
        "user_id" => ["type" => "uuid", "null" => false],
        "event_id" => ["type" => "uuid", "null" => false],
        "created" => ["type" => "datetime"],
        "transaction_id" => ["type" => "uuid"],
        "_constraints" => [
            "prim" => [
                "type" => "primary",
                "colums" => ["id"]
            ],
            "event_fk" => [
                "type" => "foreign",
                "columns" => ["event_id"],
                "reference" => ["events", "id"]
            ],
            "user_event_transact_index" => [
                "type" => TableSchema::INDEX_INDEX,
                "columns" => ["user_id", "event_id", "transaction_id"]
            ]
        ]
    ];

    public function initialize(array $config)
    {
        $this->setEntityClass('Wrsft\Model\Entity\EventRegistrationEntity');
        parent::initialize($config);

        $this->setSchema(self::SCHEMA);
    }

    public function validationDefault(Validator $validator)
    {
    }

}