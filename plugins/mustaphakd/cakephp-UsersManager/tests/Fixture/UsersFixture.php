<?php
/**
 * Prjct: Vhealings
 * User: musta
 * Date: 5/2/2017
 * Time: 1:18 AM
 */

namespace Wrsft\Test\Fixture;


use Cake\Auth\DefaultPasswordHasher;
use Cake\Core\Configure;
use Cake\I18n\Date;
use Cake\I18n\Time;
use Cake\TestSuite\Fixture\TestFixture;
use Cake\Utility\Text;

class UsersFixture extends  TestFixture
{
    public $fields = [
        'id' => ['type' => 'uuid'],
        'first_name' => ['type' => 'string', 'length' => 25, 'fixed' => false, 'null' => false ],
        'last_name' => ['type' => 'string', 'length' => 25, 'fixed' => false, 'null' => false ],
        'email' => ['type' => 'string', 'length' => 25, 'fixed' => false, 'null' => false ],
        'account_confirmation_hash' => ['type' => 'string', 'length' => 168],
        'confirmed' => ['type' => 'string', 'length' => 1, 'default' => 'F', 'fixed' => true],
        'disabled' => ['type' => 'string', 'length' => 1, 'default' => 'F', 'fixed' => true],
        'created' => ['type' => 'datetime'],
        'modified' => ['type' => 'datetime'],
        'password' => ['type' => 'string', 'length' => 255],
        'password_reset_hash' => ['type' => 'uuid', 'null' => true],
        'birth_date' => ['type' => 'date'],
        '_constraints' => [
            'unique' => [
                'type' => "unique",
                'columns' => ["email"]
            ],
            'primary_id' => [
                'type' => 'primary',
                'columns' => ["id"]
            ]
        ]
    ];

    public  function init()
    {
        parent::init(); // TODO: Add Gender

        $uids = [];
        $uids[] = Text::uuid();
        $uids[] = Text::uuid();
        $uids[] = Text::uuid();
        $uids[] = Text::uuid();
        $uids[] = Text::uuid();

        Configure::write('Fixture.Wrsft.Users', $uids);

        $hasher = (new DefaultPasswordHasher())->hash('password');

        $this->records = [
            ['id' => $uids[0], 'first_name' => "Audrey", 'last_name' => 'Sekongo', 'email' => 'audrey@wrsft.com', 'account_confirmation_hash' => Text::uuid(), 'confirmed' => 'T', 'disabled' => 'F', 'created' => Time::now(), 'modified' => Time::now(), 'password' => $hasher, 'password_reset_hash' => null, 'birth_date' => (new Date('1980-02-22'))->format('Y-m-d H:i:s') ],
            ['id' => $uids[1], 'first_name' => "Caroline", 'last_name' => 'Woriblou', 'email' => 'caroline@wrsft.com', 'account_confirmation_hash' => Text::uuid(), 'confirmed' => 'T', 'disabled' => 'F', 'created' => Time::now(), 'modified' => Time::now(), 'password' => $hasher, 'password_reset_hash' => null, 'birth_date' => (new Date('1945-02-22'))->format('Y-m-d H:i:s') ],
            ['id' => $uids[2], 'first_name' => "Mohammed", 'last_name' => 'Iniankebou', 'email' => 'mohammed@wrsft.com', 'account_confirmation_hash' => Text::uuid(), 'confirmed' => 'T', 'disabled' => 'F', 'created' => Time::now(), 'modified' => Time::now(), 'password' => $hasher, 'password_reset_hash' => (new DefaultPasswordHasher())->hash(Text::uuid()), 'birth_date' => (new Date('1990-02-22'))->format('Y-m-d H:i:s') ],
            ['id' => $uids[3], 'first_name' => "Tchedjan", 'last_name' => 'Djigbe', 'email' => 'tchedjan@wrsft.com', 'account_confirmation_hash' => Text::uuid(), 'confirmed' => 'F', 'disabled' => 'F', 'created' => Time::now(), 'modified' => Time::now(), 'password' => $hasher, 'password_reset_hash' => null, 'birth_date' => (new Date('2100-02-22'))->format('Y-m-d H:i:s') ],
            ['id' => $uids[4], 'first_name' => "Niamkey", 'last_name' => 'Firtahd', 'email' => 'niamkey@wrsft.com', 'account_confirmation_hash' => Text::uuid(), 'confirmed' => 'T', 'disabled' => 'F', 'created' => Time::now(), 'modified' => Time::now(), 'password' => $hasher, 'password_reset_hash' => null, 'birth_date' => (new Date('2200-02-22'))->format('Y-m-d H:i:s') ]
        ];
    }

}