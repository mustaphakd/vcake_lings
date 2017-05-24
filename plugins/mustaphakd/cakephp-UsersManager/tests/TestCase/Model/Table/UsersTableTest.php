<?php
/**
 * Prjct: Vhealings
 * User: musta
 * Date: 5/5/2017
 * Time: 2:13 AM
 */

namespace Wrsft\Test\TestCase\Model\Table;

use Cake\Controller\ComponentRegistry;
use Cake\Core\App;
use Cake\Core\Configure;
use Cake\Core\Plugin;
use Cake\Http\ServerRequest;
use Cake\ORM\TableRegistry;
use Wrsft\Model\Table\UsersTable ;
use Cake\TestSuite\TestCase;
use Cake\Network\Response;

class UsersTableTest extends TestCase
{
    public $users;
    public $fixtures = ['plugin.Wrsft.Users', 'plugin.Wrsft.Roles'];
    public $autoFixtures = false;

    public function setUp()
    {
        parent::setUp();

        $this->users = TableRegistry::get(
            'Users',
            [
                "className" => "Wrsft\Model\Table\UsersTable",
                "table" => 'users'
            ]);

        $this->fixtures[] = 'plugin.Wrsft.RolesUsers';

        $fixtureManager = $this->fixtureManager;
        $testObj = $this;

        $uids = Configure::read('Fixture.Wrsft.Users');

        Configure::write(
            'Fixture.Wrsft.UsersRoles',
            [
                ["user_id" =>$uids[0], "role_id" => 1],
                ["user_id" =>$uids[0], "role_id" => 2],
                ["user_id" =>$uids[0], "role_id" => 5]
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

    public function testEntityClassSet(){
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertTextEquals("Wrsft\Model\Entity\UserEntity", $this->users->getEntityClass());

    }

    public function testGetUsers(){
        $uids = Configure::read('Fixture.Wrsft.Users');

        $query = $this->users->getUsers([$uids[0], $uids[1], $uids[2]]);
        $result = $query->toArray();

        $user = $this->users->get($result[0]->id);
        $names = $query->map(function($row){
            return $row['first_name'];
        })->toArray();

        $this->assertCount(3, $result, "UserTableTest::testGetUsers() Users not properly retrieved");
        $this->assertTextEquals($user->first_name, $result[0]->first_name, "UserTableTest::testGetUsers() Wrong row retried");
        $this->assertCount(3, array_intersect($names, ["Audrey", "Caroline", "Mohammed"]));
        //pr($names);
    }

    public function testFindAuthsucceed(){

        $request = new ServerRequest([
            'post' => [

                    "email" => "audrey@wrsft.com",
                    "password" => "password"

            ],
            'environment' => ['REQUEST_METHOD' => "POST"]
        ]);

        $controller = $this->getMockBuilder("\Cake\Controller\Controller")
            ->setConstructorArgs([$request, new Response()])
            ->setMethods(null)
            ->getMock();

        $componentRegistry = new ComponentRegistry($controller);

        $authComponent = $componentRegistry->load("Auth", [
            "className" => "Wrsft\Controller\Component\WrsftAuthComponent"
        ]);

        $identifiedUser = $authComponent->identify();

        $this->assertTrue(
            is_array($identifiedUser),
            "UserTableTest::testFindAuthsucceed Expected type not returned");

        $this->assertFalse($identifiedUser === false , "user could not be identified");
    }

    public function testFindAuthFails(){

        $request = new ServerRequest([
            'post' => [

                "email" => "audrey@wrsft.com",
                "password" => "bonjour"

            ],
            'environment' => ['REQUEST_METHOD' => "POST"]
        ]);

        $controller = $this->getMockBuilder("\Cake\Controller\Controller")
            ->setConstructorArgs([$request, new Response()])
            ->setMethods(null)
            ->getMock();

        $componentRegistry = new ComponentRegistry($controller);

        $authComponent = $componentRegistry->load("Auth", [
            "className" => "Wrsft\Controller\Component\WrsftAuthComponent"
        ]);

        $identifiedUser = $authComponent->identify();

        $this->assertFalse(
            is_array($identifiedUser),
            "UserTableTest::testFindAuthsucceed Expected type not returned");

        $this->assertTrue($identifiedUser === false , "user was identified");
    }

}