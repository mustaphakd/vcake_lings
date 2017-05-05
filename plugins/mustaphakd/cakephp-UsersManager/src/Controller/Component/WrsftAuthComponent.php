<?php

/**
 * Created by PhpStorm.
 * User: musta
 * Date: 4/26/2017
 * Time: 11:41 PM
 */

namespace Wrsft\Controller\Component ;

use Cake\Controller\Component\AuthComponent;
use Cake\Event\Event ;

class WrsftAuthComponent extends AuthComponent
{

    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setConfig([
            "authenticate" => [
                "Form" => [
                    'fields' => [
                        'username' => 'email',
                        'password' => 'password'
                    ],
                    'userModel' => 'Users',
                    'finder' => 'auth'
                ]
            ]
        ]);
    }

    /*
     * Call method with last param as $this->Auth->identify().
     * method assumes $user is not null
     * **/
    public function hasRole($roleName,$user = null){

        if(!isset($roleName) || $roleName == null)
        {
            return false;
        }

        $roles = $user['roles'];
        return in_array($roleName, $roles);

    }

    public function inRoles($roles){

        $user = $this->user();

        if(!isset($user) || $user == null)
        {
            return false;
        }

        if(isset($roles) && is_array($roles)){
            foreach($roles as $role){
                if($this->hasRole($role, $user)){
                    return true;
                }
            }
        }
        else{
            echo 'calling hasRole once';
            return $this->hasRole($roles, $user);
        }
        return false;
    }

    public function loginUser(){
        $user = $this->identify();

        if($user){
            $this->setUser($user);
            return true;
        }
        return false;
    }

}