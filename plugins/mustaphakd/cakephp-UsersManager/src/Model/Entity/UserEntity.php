<?php
/**
 * Prjct: Vhealings
 * User: musta
 * Date: 5/5/2017
 * Time: 2:30 AM
 */

namespace Wrsft\Model\Entity;


use Cake\Auth\DefaultPasswordHasher;
use Cake\Core\Exception\Exception;
use Cake\ORM\Entity;

class UserEntity extends Entity
{
    public $_accessible = [
        "*" => true,
        "id" => "false"
    ];

    public $_hidden = [
        "id",
        "password"
    ];

    public function hashPassword(){
        $this->password = (new DefaultPasswordHasher())->hash($this->password);
        $this->setDirty("password", true);
    }

   /* public function __getConfirmPassword()
    {
        if(isset($this->_properties["confirm_password"])){
            return $this->get("confirm_password");
        }

        return null;
    }

    public function __setConfirmPassword($value)
    {
        if(!is_string((string)$value))
            throw new Exception("Confirmation password must be string and not null");
        $this->_properties["confirm_password"] = $value;
    }*/

}