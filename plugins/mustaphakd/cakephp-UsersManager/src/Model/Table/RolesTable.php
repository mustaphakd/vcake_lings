<?php

/**
 * Prjct: Vhealings
 * User: musta
 * Date: 4/27/2017
 * Time: 9:55 AM
 */

namespace Wrsft\Model\Table ;

use Cake\ORM\Table ;
use Cake\Validation\Validator;

class RolesTable extends Table
{

    private static $domain = "Wrsft\User";

    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->belongsToMany(
            "Users",
            [
                "className" => "Wrsft\Model\Table\UsersTable",
                "through" => "Wrsft\Model\Table\RolesUsersTable",
                "targetForeignKey" => "user_id",
                "foreignKey" => "role_id"
            ]);
    }

    public function validationDefault(Validator $validator)
    {
        $validator
            ->add(
                "id",
                [
                   "isNumeric" => [
                       "rule" => "numeric",
                       "message" => __d(self::$domain, "id must be a valid numeric value"),
                       "on" => "update"
                   ],
                    "required" => [
                        "rule" => "notBlank",
                        "message" => __d(self::$domain, "id is required"),
                        "on" => "update"
                    ]
                ]
            )
            ->add(
                "name",
                [
                    "notEmpty" => [
                        "rule" => "notBlank",
                        "message" => __d(self::$domain, "Name is empty")
                    ],
                    "properLength" => [
                        "rule" => ["lengthBetween", 1, 25],
                        "message" => __d(self::$domain, "Name length needs to be between 1 and 25 characters")
                    ]

                ]
            );

        return $validator;
    }
}