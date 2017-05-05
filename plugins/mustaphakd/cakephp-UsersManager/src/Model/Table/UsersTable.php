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

class UsersTable extends Table
{
    public function initialize(array $config)
    {
        $this->setDisplayField('email');
        $this->setEntityClass('Wrsft\Model\Entity\UserEntity');

        $this->belongsToMany(
            "Roles",
            [
                "className" => "Wrsft\Model\Table\RolesTable",
                "trough" => "Wrsft\Model\Table\RolesUsersTable",
                "targetForeignKey" => "id"
            ]);
        parent::initialize($config);
    }

    public function findAuth(Query $query, array $options){
        $query
            ->select(["id", "email", "first_name", "last_name"])
           // ->contain("Roles")
            ->where(["Users.confirmed" => 'Y', "Users.disabled" => 'F']);
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

}