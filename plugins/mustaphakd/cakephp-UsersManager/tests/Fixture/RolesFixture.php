<?php
/**
 * Prjct: Vhealings
 * User: musta
 * Date: 5/2/2017
 * Time: 1:19 AM
 */

namespace Wrsft\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

class RolesFixture extends TestFixture
{
    public $fields = [
        'id' =>['type' => 'integer', 'null' => false ],
        'name' => ['type' => 'string', 'length' => '25', 'fixed' => false, 'null' => false],
        '_constraints' =>[
            'unique' => [
                'type' => 'unique',
                'columns' => ['name']
            ],
            'primary' => [
                'type' => 'primary',
                'columns' => ['id']
            ]
        ]
    ];

    public $records = [
        ['id' => 1, 'name' => 'policier'],
        ['id' => 2, 'name' => 'citoyen'],
        ['id' => 3, 'name' => 'bandit'],
        ['id' => 4, 'name' => 'observer'],
        ['id' => 5, 'name' => 'boulanger'],
        ['id' => 6, 'name' => 'admin'],
    ];
}