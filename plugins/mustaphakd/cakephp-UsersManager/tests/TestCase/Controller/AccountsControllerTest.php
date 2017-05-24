<?php
/**
 * Prjct: Vhealings
 * User: musta
 * Date: 5/8/2017
 * Time: 5:10 PM
 */

namespace Wrsft\Test\TestCase\Controller;

use App\Controller\ErrorController;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Cache\Cache;
use Cake\Collection\Collection;
use Cake\Controller\ComponentRegistry;
use Cake\Controller\Controller;
use Cake\Core\Configure;
use Cake\Core\StaticConfigTrait;
use Cake\Error\Middleware\ErrorHandlerMiddleware;
use Cake\Event\Event;
use Cake\Event\EventManager;
use Cake\Http\Response;
use Cake\Http\ServerRequest;
use Cake\Mailer\Email;
use Cake\ORM\TableRegistry;
use Cake\Routing\DispatcherFactory;
use Cake\Routing\Router;
use Cake\TestSuite\IntegrationTestCase;
use Cake\Utility\Text;
use Wrsft\Controller\AccountsController;
use Wrsft\Controller\Component\SslCryptorComponent;
use Wrsft\Test\TestCase\Controller\Component\MailTransportMock;

class AccountsControllerTest extends IntegrationTestCase
{
    use StaticConfigTrait;
    public $fixtures = ['plugin.Wrsft.Users', 'plugin.Wrsft.Roles'];
    public $autoFixtures = false;


    public function setUp()
    {
        parent::setUp();

        $fixtureManager = $this->fixtureManager;
        $testObj = $this;
        $this->fixtures[] = 'plugin.Wrsft.RolesUsers';
        $uids = Configure::read('Fixture.Wrsft.Users');

        Configure::write(
            'Fixture.Wrsft.UsersRoles',
            [
                ["user_id" => $uids[0], "role_id" => 1],
                ["user_id" => $uids[0], "role_id" => 2],
                ["user_id" => $uids[0], "role_id" => 5]
            ]);

        call_user_func(\Closure::bind(
            function() use ($fixtureManager, $testObj){
                call_user_func(array($fixtureManager, "_loadFixtures"), $testObj);
            },
            null,
            $fixtureManager
        ));

        $this->loadFixtures("Users", "Roles", "RolesUsers");
    }

    public function testAuthComponentLoaded_succeed(){

        $controller = new AccountsController(new ServerRequest(), new Response());
        $authComponent = $controller->components()->get("Auth");

        $this->assertInstanceOf(
            "Wrsft\Controller\Component\WrsftAuthComponent",
            $authComponent,
            "Wrsft auth component was not loaded");
    }

    public function test_registration_succeeds(){

        $newEmail = "finderew@wrsft.com";
        $pwd = "Password_*1";
        MailTransportMock::clearMessageLog();

        Configure::write("infoEmailSender", "test@wrsft.com");

        $users = null;
        $query = '';

        EventManager::instance()->on("Controller.shutdown", function( $event) use (&$query) {

            $controller = $event->getSubject();

            $closure = \Closure::bind(
                function ($controllerArg) use ($controller){

                    if(!($controllerArg instanceof AccountsController)) {
                        return null;
                    }

                    return $controller->Users;
                },
                null,
                $controller);

            $users = $closure($controller);

            if($users !== null)
                $query = $users->find()->contain(["Roles"])->toArray();
        });

        EventManager::instance()->on("Controller.initialize", function( $event){
            Email::dropTransport("default");
            Email::setConfigTransport("default", new MailTransportMock());
        });

        $serialized = serialize(["policier", "observer", "admin"]);

        $controllerMock = $this->getMockBuilder('\Cake\Controller\Controller')
            ->disableOriginalConstructor()
            ->disableArgumentCloning()
            ->disableOriginalClone()
            ->disallowMockingUnknownTypes()
            ->getMock();

        $componentMock = $this->createMock(ComponentRegistry::class);
        $componentMock->method("getController")
            ->willReturn($controllerMock);

        $controllerMock->method("components")->willReturn($componentMock);

        $encrypted = SslCryptorComponent::encrypt($controllerMock, $serialized, "encryptionKey") ;

        $this->post(
             "/users-manager/accounts/register",
            [
                "User" => [
                    "first_name" => "Alipoco",
                    "last_name" => "Bamba",
                    "email" => $newEmail,
                    "password" => $pwd,
                    "confirmPassword" => $pwd,
                    "birth_date" => "1987-06-15"
                ],
                "Roles" =>[
                    "key" => "encryptionKey",
                    "value" => $encrypted
                ]
            ]
        );

        $foundNewUser = false;
        $newUserRoles = [];

        if(is_array($query)){
            foreach ($query as $user){
                if(
                    (strcmp($user->first_name, "Alipoco" ) == 0) &&
                    (strcmp($user->last_name, "Bamba" ) == 0) &&
                    (strcmp($user->email, $newEmail ) == 0)
                ){
                    $newUserRoles = (new Collection($user->roles))->extract("name")->toArray();
                    $foundNewUser = true;
                }
            }
        }

        $this->assertTrue($foundNewUser, "New User not added to repository");
        $this->assertGreaterThan(0, count(MailTransportMock::getMessageLog()), "Email Message was not sent");
        $this->assertResponseContains("An email has been sent", "Emal sent message not shown to user");
        $this->assertResponseCode(200);
        $this->assertTrue(
            count(array_diff($newUserRoles, ["policier", "observer", "admin"])) == 0,
            "AccountCountrollerTest new User roles not valid");
    }

    public function testRegistration_emailExist_fails(){

        $newEmail = "audrey@wrsft.com";
        $pwd = "Password_*1";
        MailTransportMock::clearMessageLog();
        $users = null;
        $query = '';

        EventManager::instance()->on("Controller.shutdown", function( $event) use (&$query) {

            $controller = $event->getSubject();

            $closure = \Closure::bind(
                function ($controllerArg) use ($controller){

                    if(!($controllerArg instanceof AccountsController)) {
                        return null;
                    }

                    return $controller->Users;
                },
                null,
                $controller);

            $users = $closure($controller);

            if($users !== null)
                $query = $users->find()->toArray();
        });

        EventManager::instance()->on("Controller.initialize", function( $event){
            Email::dropTransport("default");
            Email::setConfigTransport("default", new MailTransportMock());
        });

        $this->post(
            "/users-manager/accounts/register",
            [
                "User" => [
                    "first_name" => "Alipoco",
                    "last_name" => "Bamba",
                    "email" => $newEmail,
                    "password" => $pwd,
                    "confirmPassword" => $pwd,
                    "birth_date" => "1987-06-15"
                ]
            ]
        );

        $foundNewUser = false;

        if(is_array($query)){
            foreach ($query as $user){
                if(
                    (strcmp($user->first_name, "Alipoco" ) == 0) &&
                    (strcmp($user->last_name, "Bamba" ) == 0) &&
                    (strcmp($user->email, $newEmail ) == 0)
                ){
                    $foundNewUser = true;
                }
            }
        }

        $this->assertFalse($foundNewUser, "New User was not supposed to be added to repository");
        $this->assertEquals(0, count(MailTransportMock::getMessageLog()), "Email Message was sent");
        $this->assertResponseContains("Email already present in our repository", "Email presence not detected");
        $this->assertResponseCode(200);
    }

    public function testRegistration_missingFields_fails(){

        $newEmail = "worason@wrsft.com";
        $pwd = "Password_*1";
        MailTransportMock::clearMessageLog();

        $users = null;
        $query = '';

        EventManager::instance()->on("Controller.shutdown", function( $event) use (&$query) {

            $controller = $event->getSubject();

            $closure = \Closure::bind(
                function ($controllerArg) use ($controller){

                    if(!($controllerArg instanceof AccountsController)) {
                        return null;
                    }

                    return $controller->Users;
                },
                null,
                $controller);

            $users = $closure($controller);

            if($users !== null)
                $query = $users->find()->toArray();
        });

        EventManager::instance()->on("Controller.initialize", function( $event){
            Email::dropTransport("default");
            Email::setConfigTransport("default", new MailTransportMock());
        });

        $this->post(
            "/users-manager/accounts/register",
            [
                "User" => [
                    "email" => $newEmail,
                    "password" => $pwd,
                    "confirmPassword" => $pwd,
                    "birth_date" => "1987-06-15"
                ]
            ]
        );

        $foundNewUser = false;

        if(is_array($query)){
            foreach ($query as $user){
                if(
                    (strcmp($user->first_name, "Alipoco" ) == 0) &&
                    (strcmp($user->last_name, "Bamba" ) == 0) &&
                    (strcmp($user->email, $newEmail ) == 0)
                ){
                    $foundNewUser = true;
                }
            }
        }

        $this->assertFalse($foundNewUser, "New User was not supposed to be added to repository");
        $this->assertEquals(0, count(MailTransportMock::getMessageLog()), "Email Message was sent");
        $this->assertResponseContains("required", "required presence not mentioned");
        $this->assertResponseCode(200);
    }

    public function testRegistration_passwordComplexity_fails(){

        $newEmail = "worason@wrsft.com";
        $pwd = "Password_1";
        MailTransportMock::clearMessageLog();

        $users = null;
        $query = '';

        EventManager::instance()->on("Controller.shutdown", function( $event) use (&$query) {

            $controller = $event->getSubject();

            $closure = \Closure::bind(
                function ($controllerArg) use ($controller){

                    if(!($controllerArg instanceof AccountsController)) {
                        return null;
                    }

                    return $controller->Users;
                },
                null,
                $controller);

            $users = $closure($controller);

            if($users !== null)
                $query = $users->find()->toArray();
        });

        EventManager::instance()->on("Controller.initialize", function( $event){
            Email::dropTransport("default");
            Email::setConfigTransport("default", new MailTransportMock());
        });

        $this->post(
            "/users-manager/accounts/register",
            [
                "User" => [
                    "email" => $newEmail,
                    "password" => $pwd,
                    "confirmPassword" => $pwd,
                    "birth_date" => "1987-06-15"
                ]
            ]
        );

        $foundNewUser = false;

        if(is_array($query)){
            foreach ($query as $user){
                if(
                    (strcmp($user->first_name, "Alipoco" ) == 0) &&
                    (strcmp($user->last_name, "Bamba" ) == 0) &&
                    (strcmp($user->email, $newEmail ) == 0)
                ){
                    $foundNewUser = true;
                }
            }
        }

        $this->assertFalse($foundNewUser, "New User was not supposed to be added to repository");
        $this->assertEquals(0, count(MailTransportMock::getMessageLog()), "Email Message was sent");
        $this->assertResponseContains("password must contain", "required presence not mentioned");
        $this->assertResponseCode(200);
    }

    public function testForgotPassword_emailExist_sendEmail_succeed(){

        $email = "audrey@wrsft.com";
        $this->arrangeForgotPasswordTests($email);

        $this->assertGreaterThan(0, count(MailTransportMock::getMessageLog()), "Email Message was not sent");
        $this->assertResponseContains("An email has been sent", "Emal sent message not shown to user");
        $this->assertResponseCode(200);
    }

    public function testForgotPassword_emailNotFound_sendEmail_fails(){

        $email = "nofoujnd@wrsft.com";

        $this->arrangeForgotPasswordTests($email);

        $this->assertEquals(0, count(MailTransportMock::getMessageLog()), "Email Message was not supposed to be sent");
        $this->assertResponseContains("does not exist", "Email not-existence message not shown to user");
        $this->assertResponseCode(200);
    }

    public function test_confirmAccount_succeed(){

        $email = "tchedjan@wrsft.com";
        $userTable = TableRegistry::get("Users", ["className" => 'Wrsft\Model\Table\UsersTable']);
        $initialUserParams = $userTable->find()->where(["email" => $email])->first();
        $initiallyConfirmed = $initialUserParams->confirmed;
        $confirmationStatus = 'F';
        $url = Router::url([
            "plugin" => "mustaphakd/cakephp-UsersManager",
            "controller" => "Accounts",
            "action" => "confirmAccount",
            "confirmationHash" => $initialUserParams->account_confirmation_hash
        ]);

        EventManager::instance()->on("Controller.shutdown", function ($event) use(&$confirmationStatus, $email){
            $controller = $event->getSubject();

            $closure = \Closure::bind(
                function($accountController) use($controller){

                    if(! ($accountController instanceof AccountsController)){
                        return null;
                    }

                    return $accountController->Users;
                },
                null,
                $controller);

            $usersReg = $closure($controller);

            if($usersReg !== null){
                $user = $usersReg->find()->where(["email" => $email])->first();
                $confirmationStatus = $user->confirmed;
            }
        });

        $this->get($url);

        $this->assertNotNull($initialUserParams, "Unexplaineable failure");
        $this->assertEquals('F', $initiallyConfirmed, "User should not be initially confirmed");
        $this->assertEquals('T', $confirmationStatus, "User should now have been confirmed");

    }

    public function test_resetPassword_succeed(){
        $email = "mohammed@wrsft.com";
        $newPassword = "Password_%90";
        $generatedHash = ' ';

        $registry = TableRegistry::get("Users", ["className" => 'Wrsft\Model\Table\UsersTable']);
        $hash = $registry->find()
            ->where(["email" => $email])
            ->first()->password_reset_hash;

        $url = Router::url([
            "plugin" => "mustaphakd/cakephp-UsersManager",
            "controller" => "Accounts",
            "action" => "resetPassword",
            "confirmationHash" => $hash
        ]);

        EventManager::instance()->on(
            "Controller.shutdown",
            function($event) use(&$generatedHash, $email){
                $controller = $event->getSubject();

                $closure = \Closure::bind(
                    function ($controllerArg) use($controller){
                        if(!($controllerArg instanceof AccountsController)){
                            return null;
                        }

                        return $controllerArg->Users;
                    },
                    null,
                    $controller
                );

                $userReg = $closure($controller);

                if($userReg === null)
                    return;

                $foundUser = $userReg->find()
                    ->where(["email" => $email])
                    ->first();
                $generatedHash = $foundUser->password;
            }
        );

        $this->post(
            $url,
            [
                "newPassword" => $newPassword,
                "confirmedPassword" => $newPassword
        ]);


        $this->assertNotEmpty($generatedHash);
        $match = (new DefaultPasswordHasher())->check($newPassword, $generatedHash);

        $this->assertResponseContains("Your password has been reset!", "Password was not reset");
        $this->assertTrue($match, "New password not properly hashed!");
    }

    public function test_resetPassword_hashNotFound_fails(){

        $hash = (new DefaultPasswordHasher())->hash(Text::uuid());

        $url = Router::url([
            "plugin" => 'mustaphakd/cakephp-UsersManager',
            "controller" => "Accounts",
            "action" => "resetPassword",
            "confirmationHash" => $hash
        ]);

        $this->post(
            $url,
            [
                "newPassword" => "wpod",
                "confirmedPassword" => "nonSense"
            ]);

        $this->assertResponseContains("Request for password reset not found", "Request for password reset should not exist");
    }

    public function test_login_succeed(){

        $url = Router::url([
            "plugin" => 'mustaphakd/cakephp-UsersManager',
            "controller" => "Accounts",
            "action" => "login"
        ]);

        $email = "audrey@wrsft.com";
        $password = "password";
        $isAuthenticated = false;

        EventManager::instance()->on(
            "Controller.shutdown",
            function($event) use(&$isAuthenticated){
                $controller = $event->getSubject();

                $auth = $controller->components()->Auth;

                if( ($auth) && $auth->isUserAlreadyAuthenticated()){
                    $isAuthenticated = true;
                }
            }
        );

        $this->post(
            $url,
            [
                "email" => $email,
                "password" => $password
            ]
        );

        $this->assertTrue($isAuthenticated, "User was not authenticated");
    }

    public function test_login_emailNotFound_fails(){

        $failureMessage = "Password or email incorrect";

        $url = Router::url([
            "plugin" => 'mustaphakd/cakephp-UsersManager',
            "controller" => "Accounts",
            "action" => "login"
        ]);

        $email = "audrp@wrsft.com";
        $password = "password";

        $this->post(
            $url,
            [
                "email" => $email,
                "password" => $password
            ]
        );

        $this->assertResponseContains($failureMessage, "Authentication Failure message expected");

    }

    public function test_login_passwordNotMatch_fails(){

        $failureMessage = "Password or email incorrect";

        $url = Router::url([
            "plugin" => 'mustaphakd/cakephp-UsersManager',
            "controller" => "Accounts",
            "action" => "login"
        ]);

        $email = "audrey@wrsft.com";
        $password = "passwordds";

        $this->post(
            $url,
            [
                "email" => $email,
                "password" => $password
            ]
        );

        $this->assertResponseContains($failureMessage, "Authentication Failure message expected");

    }

    public function test_login_accountNotActivated_fails(){

        $failureMessage = "Password or email incorrect";
        $url = Router::url([
            "plugin" => 'mustaphakd/cakephp-UsersManager',
            "controller" => "Accounts",
            "action" => "login"
        ]);

        $email = "tchedjan@wrsft.com";
        $password = "password";
        $isAuthenticated = false;

        EventManager::instance()->on(
            "Controller.shutdown",
            function($event) use(&$isAuthenticated){
                $controller = $event->getSubject();

                $auth = $controller->components()->Auth;

                if( ($auth) && $auth->isUserAlreadyAuthenticated()){
                    $isAuthenticated = true;
                }
            }
        );

        $this->post(
            $url,
            [
                "email" => $email,
                "password" => $password
            ]
        );

        $this->assertFalse($isAuthenticated, "User should not authenticated");
        $this->assertResponseContains($failureMessage, "Authentication Failure message expected");
    }


    public function removeRoles_belongsToUsers_fails(){

    }

    public function removeRoles_belongsToOne_succeeds(){

    }

    public function addRolesToUser_succeed(){

    }

    private function arrangeForgotPasswordTests($email){
        MailTransportMock::clearMessageLog();

        Configure::write("infoEmailSender", "contact@wrsft.com");
        Configure::write("companyName", "Worosoft.com");

        Configure::write("infoEmailSender", "test@wrsft.com");

        EventManager::instance()->on("Controller.initialize", function( $event){
            Email::dropTransport("default");
            Email::setConfigTransport("default", new MailTransportMock());
        });

        $this->post(
            "/users-manager/accounts/forgotPassword",
            [
              "email" => $email
            ]
        );
    }

}