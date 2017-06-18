<?php
/**
 * Prjct: Vhealings
 * User: musta
 * Date: 5/2/2017
 * Time: 1:19 AM
 */

namespace Wrsft\Test\Fixture;


use Cake\Core\Configure;
use Cake\TestSuite\Fixture\TestFixture;

class RolesUsersFixture extends TestFixture
{
    public $fields = [
        'id' => ['type' => 'integer'],
        'user_id' => ['type' => 'uuid'],
        'role_id' => ['type' => 'integer'],
        '_constraints' => [
            'primary' => [
                'type' => 'primary',
                'columns' => ['id']
            ],
            'users_fk' => [
                'type' => 'foreign',
                'columns' => ['user_id'],
                'references' => ['users', 'id']
            ],
            'roles_fk' => [
                'type' => 'foreign',
                'columns' => ['role_id'],
                'references' => ['roles', 'id']
            ]
        ]
    ];

    public function init()
    {
        parent::init();

        if(Configure::check('Fixture.Wrsft.UsersRoles')){
            $arr = Configure::read('Fixture.Wrsft.UsersRoles');
            $this->records = $this->records || [];
            $counter = count($this->records);
            foreach ($arr as $ele){
                $this->records[] = ['id' => $counter++, 'user_id' => $ele['user_id'], 'role_id' => $ele['role_id']];
            }
        }
    }

}