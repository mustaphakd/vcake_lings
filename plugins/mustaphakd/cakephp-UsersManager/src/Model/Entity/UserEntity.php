<?php
/**
 * Prjct: Vhealings
 * User: musta
 * Date: 5/5/2017
 * Time: 2:30 AM
 */

namespace Wrsft\Model\Entity;


use Cake\ORM\Entity;

class UserEntity extends Entity
{
    public $_accessible = [
        "*" => true,
        "id" => "false"
    ];

}