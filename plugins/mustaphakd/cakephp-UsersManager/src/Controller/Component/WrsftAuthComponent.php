<?php

/**
 * Created by PhpStorm.
 * User: musta
 * Date: 4/26/2017
 * Time: 11:41 PM
 */

namespace Wrsft\Controller\Component ;

use Cake\Collection\Collection;
use Cake\Controller\Component\AuthComponent;

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
                    'userModel' => 'Wrsft.Users',
                    'finder' => 'auth'
                ]
            ],
            'authorize' => 'Controller'
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

        $roles = (array)$user['roles'];
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
            $roles = $user["roles"];
            unset($user["roles"]);
            $user["roles"] = (new Collection($roles))->extract("name")->toArray();
            $this->setUser($user);
            return true;
        }
        return false;
    }

    public function isUserAlreadyAuthenticated(){
        return $this->user() !== null;
    }

    public function initAllowActions($actions = []){

        array_push($this->allowedActions, $actions);
    }

}