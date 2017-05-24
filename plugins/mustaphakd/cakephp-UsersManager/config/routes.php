<?php
/**
 * Prjct: Vhealings
 * User: musta
 * Date: 5/9/2017
 * Time: 6:34 PM
 */

use Cake\Core\App;
use Cake\Routing\Route\DashedRoute;
use Cake\Routing\Router;
use Wrsft\Routing\Route\WyswygtRoute;

Router::plugin(
    'mustaphakd/cakephp-UsersManager',
    ['path' => '/users-manager'],
    function ($routes) {
        $routes->connect(
            '/:controller/:action',
            ["plugin" => "mustaphakd/cakephp-UsersManager", "controller" => 'Accounts', "action" => "register", "namespace" => "Wrsft"],
            ['routeClass' => WyswygtRoute::class ] );
    }
);