<?php
/**
 * Prjct: Vhealings
 * User: musta
 * Date: 5/23/2017
 * Time: 3:30 PM
 */

namespace Wrsft\Test\Fixture;


use Cake\TestSuite\Fixture\TestFixture;

class ImagesFixture extends TestFixture
{
    public $fields = [
        "id" => ["type" => "uuid"],
        "name" => ["type" => "string", "fixed" => false, "null" => false, "length" => 20],
        "path" => ["type" => "string", "fixed" => false, "null" => false, "length" => 1000],
        "extension" => ["type" => "string", "fixed" => false, "null" => false, "length" => 5],
        "created" => ["type" => "datetime"],
        "modified" => ["type" => "datetime"],
        "_constraints" => [
            "prim" => [
                "type" => "primary",
                "columns" => ["id"]
            ]
        ]
    ];

}