<?php

/**
 * Prjct: Vhealings
 * User: musta
 * Date: 4/27/2017
 * Time: 12:06 AM
 */

namespace Wrsft\Model\Table ;

use Cake\Auth\DefaultPasswordHasher ;
use Cake\Core\App;
use Cake\Event\Event ;
use Cake\ORM\Query;
use Cake\ORM\Table ;
use Cake\Utility\Text;
use Cake\Validation\Validator;
use Wrsft\Model\Entity\UserEntity;

class UsersTable extends Table
{
    private static $domain = 'Wrsft\User';
    public function initialize(array $config)
    {
        $this->setTable("users");
        $this->setDisplayField('email');
        $this->setEntityClass('Wrsft\Model\Entity\UserEntity');

        $this->belongsToMany(
            "Roles",
            [
                "className" => 'Wrsft\Model\Table\RolesTable',
                "trough" => new RolesUsersTable(),
                "targetForeignKey" => "role_id",
                "foreignKey" => "user_id"
            ]);
        parent::initialize($config);
    }

    public function validationDefault(Validator $validator)
    {
        $modelObj = $this;
        $validator
            ->add(
                "id",
                [
                    "notEmpty" => [
                        "rule" => "notBlank",
                        "on" => "update",
                        "message" => __d(self::$domain, "id  is required for updates")
                    ],
                    "isUiid" => [
                        "rule" => "uuid",
                        "on" => "update",
                        "message" => __d(self::$domain, "A valid Id is required")
                    ]
                ])
            ->requirePresence(
                "id",
                "update",
                __d(self::$domain, "A valid Id is required")
            )
            ->add(
                "email",
                [
                    "notEmpty" => [
                        "rule" => "notBlank",
                        "message" => __d(self::$domain, "Email is empty!")
                    ],
                    "isEmail" => [
                        "rule" => "email",
                        "message" => __d(self::$domain, "email format is invalid")
                    ]
                ]
            )
            ->add(
                "first_name",
                [
                    "notEmpty" => [
                        "rule" => "notBlank",
                        "message" => __d(self::$domain, "First name is empty")
                    ],
                    "properLength" => [
                        "rule" => ["lengthBetween", 1, 25],
                        "message" => __d(self::$domain, "first name length needs to be between 1 and 25 characters")
                    ]

                ]
            )
            ->add(
                "last_name",
                [
                    "notEmpty" => [
                        "rule" => "notBlank",
                        "message" => __d(self::$domain, "Last name is empty")
                    ],
                    "properLength" => [
                        "rule" => ["lengthBetween", 1, 25],
                        "message" => __d(self::$domain, "last name length needs to be between 1 and 25 characters")
                    ]
                ]
            )
            ->add(
                "password",
                [
                    "notEmpty" => [
                        "rule" => "notBlank",
                        "message" => __d(self::$domain, "password is empty")
                    ],
                    "properLength" => [
                        "rule" => ["minLength", 8]
                    ],
                    "complexPassword" => [
                        "rule" => function ($value, $context){
                            $pattern = '$\S*(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])(?=\S*[\W])\S*$';

                            if(strlen($value)>= 8){
                                $result = preg_match_all($pattern, $value);
                                if($result)
                                    return true;
                            }
                            return false;
                        },
                        "message" => __d(self::$domain, "password must contain numbers, letters and at least one non alphanumeric character"),

                    ],
                    "passwordMatch" =>[
                        "rule" => function($value, $context) use ($modelObj){
                            if($context["newRecord"] === 1){
                                return strcmp($context["data"]["password"],$context["data"]["confirmPassword"]);
                            }

                            return true;
                        },
                        "message" => __d(self::$domain, "password and its confirmation do not match")
                    ]

                ]
            )
            ->add(
                "birth_date",
                [
                    "notEmpty" => [
                        "rule" => "notBlank",
                        "message" => __d(self::$domain, "Birth date is empty")
                    ],
                    "date" => [
                        "rule" => "date",
                        "message" => __d(self::$domain, "Proper date format required {ymd}")
                    ]

                ]
            )
            ->requirePresence(
                [
                    "email",
                    "first_name",
                    "last_name",
                    "password",
                    "birth_date"
                ],
                "create",
                __d(self::$domain, "fields::  email, first name, last name, password, birth date are required")
            )
        ;
        return $validator;
    }

    public function findAuth(Query $query, array $options){
        $query
            ->select(["id", "email", "first_name", "last_name", "password"])
            ->contain("Roles")
            ->where(["Users.confirmed" => 'T', "Users.disabled" => 'F']);
        return $query;
    }

    /**
     *
     * @param $ids array. An array of id representing the user to fetch
     * @return array of User.
     */
    public function getUsers($ids){
        return $this->find()
            ->where(["id IN " =>  $ids]);
    }

    public function beforeFind(Event $event, Query $query, \ArrayObject $array, $primary){

    }

    public function userExist($email)
    {
        return $this->findByEmail($email)->first() !== null;
    }

    public function beforeSave(Event $event, UserEntity $entity){
        if ($entity->isNew()){
            $entity->set("account_confirmation_hash", (new DefaultPasswordHasher())->hash(Text::uuid()));
            $entity->set("password", (new DefaultPasswordHasher())->hash($entity->password));
            $entity->set("created", (new \DateTimeImmutable())->format("ymd"));
        }
        $entity->set("modified", (new \DateTimeImmutable())->format("ymd"));
    }
}