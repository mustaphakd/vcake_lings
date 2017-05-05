<?php
/**
 * Prjct: Vhealings
 * User: musta
 * Date: 5/5/2017
 * Time: 2:37 AM
 */

namespace Wrsft\Model\Table;

use Cake\ORM\Table;

class RolesUsersTable extends  Table
{
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->belongsTo("Users", [
            "className" => "Wrsft\Model\Table\UsersTable"
        ])
            ->setForeignKey("userId")
        ;

        $this->belongsTo("Roles", [
            "className" => "Wrsft\Model\Table\RolesTable"
        ])
            ->setForeignKey("roleId")
        ;
    }
}