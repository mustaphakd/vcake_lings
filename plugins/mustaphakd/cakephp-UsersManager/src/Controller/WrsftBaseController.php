<?php

/**
 * Created by PhpStorm.
 * User: musta
 * Date: 4/26/2017
 * Time: 11:29 PM
 */

namespace Wrsft\Controller ;

use App\Controller\AppController ;

class WrsftBaseController extends AppController
{

    public function initialize(){
        parent::initialize();

        $this->loadComponent(
            'Auth',
            [
                'className' => "mustaphakd.cakephp-UsersManager.WrsftAuth",
                'authorize' => ['controller'],
                'authenticate' => [
                    'finder' => 'auth'
                ]
            ]);
    }

    public function isAuthorized($user){

        if(isset($user) && isset($user['$roles']) && in_array('admin', $user['roles'])){
            return true;
        }

        return false;
    }

}