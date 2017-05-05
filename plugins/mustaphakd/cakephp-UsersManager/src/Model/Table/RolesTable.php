<?php

/**
 * Prjct: Vhealings
 * User: musta
 * Date: 4/27/2017
 * Time: 9:55 AM
 */

namespace Wrsft\Model\Table ;

use Cake\Auth\DefaultPasswordHasher ;
use Cake\Event\Event ;
use Cake\ORM\Table ;

class RolesTable extends Table
{

    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->belongsToMany(
            "Users",
            [
                "className" => "Wrsft\Model\Table\UsersTable",
                "through" => "Wrsft\Model\Table\RolesUsersTable",
                "targetForeignKey" => "id"
            ]);
    }
}