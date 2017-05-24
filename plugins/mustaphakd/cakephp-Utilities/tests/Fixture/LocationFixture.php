<?php
/**
 * Prjct: Vhealings
 * User: musta
 * Date: 5/23/2017
 * Time: 3:31 PM
 */

namespace Wrsft\Test\Fixture;


use Cake\TestSuite\Fixture\TestFixture;

class LocationFixture extends TestFixture
{
    public $fields = [
        "id" => ["type" => "uuid"],
        "name" => ["type" => "string", "null" => false, "fixed" => false, "length" => 20],
        "point" => [],
        "country" => ["type" => "string", "null" => false, "fixed" => false, "length" => 20],
        "city" => ["type" => "string", "null" => false, "fixed" => false, "length" => 20],
        "address" => ["type" => "string", "null" => false, "fixed" => false, "length" => 100],
        "description" => ["type" => "string", "null" => false, "fixed" => false, "length" => 200],
        "_contraints" => [
            "prim" =>[
                "type" => "primary",
                "columns" => ["id"]
            ]
        ]
    ];

    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->records = [
            ["id" => Text::uuid(), "name" => "location one", "point" => [], "country" => "Cote D'Ivoire", "city" => "Bouake", "address" => "Dar es salam"],
            ["id" => Text::uuid(), "name" => "location trois", "point" => [], "country" => "Mali", "city" => "Nouakchott", "address" => "Kenyatta"],
            ["id" => Text::uuid(), "name" => "location six", "point" => [], "country" => "Sudan", "city" => "Accra", "address" => "Banjubura"]
        ];
    }

}