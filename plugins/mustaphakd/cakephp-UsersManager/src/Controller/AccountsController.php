<?php
/**
 * Prjct: Vhealings
 * User: musta
 * Date: 4/27/2017
 * Time: 9:54 AM
 */

namespace Wrsft\Controller;

use Cake\Auth\DefaultPasswordHasher;
use Cake\Core\Configure;
use Cake\Core\Exception\Exception;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;
use Cake\Routing\Router;
use Cake\Utility\Text;
use Psr\Log\LogLevel;
use Wrsft\Controller\Component\EmailComponent;
use Wrsft\Controller\Component\PackagerComponent;
use Wrsft\Controller\Component\SslCryptorComponent;
use Wrsft\Model\Entity\UserEntity;


/**
 * Class AccountsController
 * @package Wrsft\Controller
 *
 * By default all users are registered as patron
 *
 * Registration can expect a pckg querystring packaged with \Wrsft\Controller\Component\PackagerComponent.
 * package can include "context" => [[]] and|or "Roles" => [role1, role2, etc...] roles expected from your Roles table registry and|or
 * a handler class name that has an invoke method to be initialized and invoked. parameters passed on are newly created \Wrsft\Model\Entity\UserEntity,
 * an arrray $context object passed on and the \cake\http\ServerRequest request object
 *
 * $handler should have invoke method that returns false on failure, true other wise and a message property for reporting errors.
 *
 * Register method also raises 'Wrsft.Users.Created' event
 */
class AccountsController extends WrsftBaseController
{
    /**
     * Users table registry
     * @var \Wrsft\Model\Table\UsersTable
     */
    protected $Users;

    public $modelClass = null;

    /**
     * Roles table registry
     * @var \Wrsft\Model\Table\RolesTable
     */
    protected $Roles;

    public function initialize()
    {
        parent::initialize();

       $this->Roles = TableRegistry::get(
            "Roles",
            [
                "className" => 'Wrsft\Model\Table\RolesTable'
            ]);

        $this->Users = TableRegistry::get(
            "Users",
            [
                "className" => 'Wrsft\Model\Table\UsersTable'
            ]);
        $this->Auth->allow(['register', 'login', 'confirmAccount', 'forgotPassword', 'resetPassword']);
    }

    public function register(){

        $user = $this->Users->newEntity();

        if($this->request->is('post')){

            $userData = (array)$this->request->getData("User");
            $rolesData = $this->request->getData("Roles");

            $user = $this->Users->patchEntity($user, $userData);
            if($this->Users->userExist($user->email)){
                $this->Flash->error(__d("Wrsft\\Accounts",'Email already present in our repository'));
                $user->setError("email", "Email already present in our repository");
                return;
            }

            $userErrors = $user->getErrors();
            if( isset($userErrors) && is_array($user->getErrors()) && (count($userErrors) > 0)){
                $this->Flash->error( $this->constructErrorsMessage($userErrors));
                return;
            }

            $savedUser = $this->Users->save($user);

            if($savedUser !== false){

                $patronAdded = false;

                if($rolesData !== null){

                    if(!isset($rolesData["key"]) || empty($rolesData["key"]))
                    {
                        throw new Exception("Accounts roles secure key missing");
                    }

                    if(!isset($rolesData["value"]) || empty($rolesData["value"]))
                    {
                        throw new Exception("Accounts roles secure value missing");
                    }


                    $key = $rolesData["key"];
                    $data = $rolesData["value"];

                    $serializedData = SslCryptorComponent::decrypt($this, $data, $key);
                    $arr = unserialize($serializedData);

                    try{
                        if(!in_array("patron", $arr)) {
                            array_push($arr, "patron");
                            $patronAdded = true;
                        }
                    }
                    catch (\Exception $e){
                        $this->log("Could not Add to list of roles default patron role", LogLevel::WARNING, $arr);
                    }

                    $rolesArr = $this->Users->Roles->find()->where(["Roles.name IN" => $arr])->toArray();
                    $this->Users->Roles->link($savedUser, $rolesArr);

                    $savedUser = $this->Users->save($savedUser);
                }

                if($patronAdded === false){
                    try{
                        $rolesArr = $this->Users->Roles->find()->where(["Roles.name IN" => ["patron"]])->toArray();

                        if(
                            ($rolesArr !== null) &&
                            isset($rolesArr) &&
                            is_array($rolesArr) &&
                            !empty($rolesArr)
                        ) {

                            $this->Users->Roles->link($savedUser, $rolesArr);
                            $savedUser = $this->Users->save($savedUser);
                        }
                    }
                    catch (\Exception $e){
                        $this->log("Could not retrieve default patron role and add it to user roles", LogLevel::WARNING, $e->getMessage());
                    }
                }

                $this->processQueryPackage($savedUser);

                $infoEmailSender = Configure::read("infoEmailSender");

                $this->eventManager()->dispatch(
                    new Event(
                        'Wrsft.Users.Created',
                        $this,
                        [
                            $savedUser,
                            $this->request->getData("User"),
                            $this->request->getData("Roles")
                        ]
                    )
                );

                if($infoEmailSender) {
                    $webApp = Configure::read("companyName");
                    $emailComponent = new EmailComponent($this->_components);

                    $url = Router::url(
                         [
                             '_full'=> true,
                             'action' => "confirmAccount",
                             "confirmationHash" =>  $user->account_confirmation_hash
                         ],
                         true);

                   $email_message = "Please click on the link provided to activate your account <a href=\"".
                         $url ."\">Confirm your account</a>";

                   $emailComponent->sendEmail(
                         $infoEmailSender,
                         __d("Wrsft\\User", "Account confirmation from $webApp"),
                         $user->email,
                         $email_message
                     );

                    $confirmation_Message = __d(
                        "Wrsft/Users",
                        "An email has been sent to {0} await confirmation ",
                        $user->email);

                    $this->set("message", $confirmation_Message);

                    $this->viewBuilder()->setTemplate("message");
                }
            }
            else{

                $this->Flash->error(__d("Wrsft\\Accounts",'your registration data is invalid'));
            }
        }
        $this->set('user', $user);
    }

    public function login(){

        if($this->Auth->isUserAlreadyAuthenticated()){
            $this->redirect("/");
        }

        if($this->request->is('post')){
            if($this->Auth->loginUser()){
                $this->redirect($this->referer());
            }

            $this->Flash->error(__d("Wrsft\\Accounts", "Could not authenticate you.  Password or email incorrect."));
        }
    }

    public function confirmAccount(){

        $hash = $this->request->getQuery('confirmationHash');

        $foundUser = $this->Users->find()
            ->where(["account_confirmation_hash" => $hash])
            ->first();

        if($foundUser == null){
            $message = __d("Wrsft\\Users", "Account confirmation request not found!");
            $this->set("message", $message);
            $this->viewBuilder()->setTemplate("message");
            return;
        }

        $foundUser->set([
            "account_confirmation_hash" => " ",
            "confirmed" => 'T'
        ]);

        if($this->Users->save($foundUser, ['associated' => false])){
            $message = __d("Wrsft\\Users", "Your account has been confirmed.  You may now log in");
        }
        else{
            $message = __d("Wrsft\\Users", "Your account could not be confirmed.  Please try again later!");
        }

        $this->set("message", $message);
        $this->viewBuilder()->setTemplate("message");
        return;
    }

    public function forgotPassword(){

        if($this->request->is('post')){

            $email = trim($this->request->getData('email'));
            if(!isset($email) || empty($email))
            {
                $this->Flash->error('please provide a valid email');
                return;
            }

            if(!$this->Users->userExist($email)){
                $this->Flash->error(
                    __d("Wrsft\\Accounts", 'please provide a valid email.  Provide email does not exist in our repository'));
                return;
            }

            $foundUser = $this->Users->findByEmail($email)->first();
            $confirmationHash = (new DefaultPasswordHasher())->hash(Text::uuid());

            $foundUser->set('confirmation_hash', $confirmationHash);

            if($this->Users->save($foundUser, ['associated' => false])){

                $emailler = $this->loadComponent('Email', ['className' => '\Wrsft\Controller\Component\EmailComponent']);
                $from = Configure::read("infoEmailSender");
                $webApp = Configure::read("companyName");
                $url = Router::url([
                    "plugin" => 'mustaphakd/cakephp-UsersManager',
                    'controller' => 'Accounts',
                    'action' => 'resetPassword',
                    'confirmationHash' => $confirmationHash
                ]);

                $emailler->sendPasswordResetRequest($from, $webApp, $email, $url);

                $this->Flash->success("password reset request send to $email");
                $this->set("message", "An email has been sent");
                $this->viewBuilder()->setTemplate("message");
            }
        }
    }

    public function resetPassword(){

        $hash = $this->request->getQuery('confirmationHash');

        $foundUser = $this->Users->find()
            ->where(["password_reset_hash" => $hash])
            ->first();

        if(!$foundUser){
            $message = __d("Wrsft\\Accounts", "Request for password reset not found");
            $this->set("message", $message);
            $this->viewBuilder()->setTemplate("message");
            return;
        }

        if($this->request->is('post')){

            $newPassword = $this->request->getData("newPassword");
            $confirmedPassword = $this->request->getData("confirmedPassword");

            if(strcmp($newPassword, $confirmedPassword) !== 0){
                $this->Flash->error(__d("Wrsft\\Accounts", "Passwords do not match"));
                return;
            }


            $foundUser = $this->Users->patchEntity(
                $foundUser,
                [
                    "password" => $newPassword,
                    "password_reset_hash" => " "
                ]
            );

            if(!empty($foundUser->getErrors())){
                $this->Flash->error($this->constructErrorsMessage($foundUser->getErrors()));
                return;
            }

            $foundUser->hashPassword();

            if($this->Users->save($foundUser, ['associated' => false])){
                $this->Flash->success(__d("Wrsft\\Accounts", "Your password has been reset!"));
                $this->viewBuilder()->setTemplate("message");
            }

            $this->Flash->error(__d("Wrsft\\Accounts", "Your password could not be reset!"));

        }
    }

    private function processQueryPackage(UserEntity $newUser){

        $pckg = $this->request->getQuery("pckg");

        if(($pckg === null) || empty($pckg)){
            return;
        }

        $packager = new PackagerComponent($this->components());
        $pckg = $packager->unPack($pckg);

        if(
            isset($pckg["roles"]) &&
            is_array($pckg["roles"]) &&
            !empty($pckg["roles"])
        ){
            try{
                $rolesArr = $this->Users->Roles->find()->where(["Roles.name IN" => $pckg["roles"]])->toArray();

                if(
                    ($rolesArr !== null) &&
                    isset($rolesArr) &&
                    is_array($rolesArr) &&
                    !empty($rolesArr)
                ) {

                    $this->Users->Roles->link($newUser, $rolesArr);
                    $savedUser = $this->Users->save($newUser);
                }
            }
            catch (\Exception $e){
                $roles = implode(" ", $pckg["roles"]);
                $this->log("Could not add $roles to user list of roles", LogLevel::WARNING, $e->getMessage());
            }
        }

        if(
            isset($pckg["handler"]) &&
            !empty($pckg["handler"])
        ){

            $context = [];
            $handlerClassName = $pckg["handler"];

            if(
                isset($pckg["context"]) &&
                !empty($pckg["context"])
            ){
                $context = $pckg["context"];
            }

            $reflectionClass = new \ReflectionClass($handlerClassName);
            $handler = $reflectionClass->newInstance();
             if( ! $handler->invoke($newUser, $context, $this->request))
             {
                 $this->Flash->error($handler->Message);
             }
        }
    }

    public function isAuthorized($user)
    {

        echo "\n *********************************************************************************************Heloo isAuthorized";
        //return true;
        $action = $this->request->getParam('action') ;

        if( in_array($action, ['register', 'login', 'confirmAccount', 'forgotPassword', 'resetPassword'])){
            return true;
        }


        return parent::isAuthorized($user);
    }

}