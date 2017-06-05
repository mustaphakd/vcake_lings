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
use Wrsft\Model\Entity\EventEntity;
use Wrsft\Model\Entity\UserEntity;

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

    public function registerUser(UserEntity $user, EventEntity $event, $transaction){
        //todo: dependence on transaction
    }

    public function validationDefault(Validator $validator)
    {
        $validator
            ->requirePresence(
                ["user_id", "event_id", "transaction_id"],
                __d(self::$domain, "{0} presence required", "user, event, and transaction"))
            ->uuid("user_id")->uuid("event_id")->uuid("transaction_id");

        return $validator;
    }

}