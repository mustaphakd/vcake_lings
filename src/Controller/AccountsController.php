<?php
namespace App\Controller;

use Cake\Core\Configure;
use Cake\Network\Exception\ForbiddenException;
use Cake\Network\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;
use Wrsft\Controller\WrsftBaseController;


class AccountsController extends WrsftBaseController
{

    /*
     * Login
     * **/
    public function index()
    {
    }

    /*
     * Registration
     *
     *
     * **/
    public function register($registrationToken = null, $partnerToken = null){

    }

    public  function validate(){

    }

    public function resetPassword(){

    }
}
