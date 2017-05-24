<?php

/**
 * Created by PhpStorm.
 * User: musta
 * Date: 4/26/2017
 * Time: 11:29 PM
 */

namespace Wrsft\Controller ;

use App\Controller\AppController ;
use Cake\Controller\Component\AuthComponent;
use Cake\Controller\ComponentRegistry;
use Wrsft\Controller\Component\WrsftAuthComponent;

/**
 *
 * @property \Wrsft\Controller\Component\WrsftAuthComponent $Auth
 */
class WrsftBaseController extends AppController
{
    public function initialize(){
        parent::initialize();

        $this->loadComponent(
            'Auth',
            [
                'className' => "Wrsft\Controller\Component\WrsftAuthComponent",

            ]);
    }

    public function isAuthorized($user){
        if(isset($user) && isset($user['$roles']) && in_array('admin', $user['roles'])){
            return true;
        }
        return false;
    }

    protected function constructErrorsMessage($errorArr){

        $output = " ";
        if(isset($errorArr) && is_array($errorArr)){
            $cache = [];
            foreach ($errorArr as $field => $messageArr){

                if(is_array($messageArr)){
                    foreach ($messageArr as $key => $value){
                        if(!is_array($value) && !in_array($value, $cache)){
                            array_push($cache, $value);
                        }
                    }
                }
                else{
                    if(!in_array($messageArr, $cache)){
                        array_push($cache, $messageArr);
                    }
                }
            }
            $output = implode('<br />', $cache);
        }
        return $output;
    }

}