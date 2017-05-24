<?php
/**
 * Prjct: Vhealings
 * User: musta
 * Date: 5/23/2017
 * Time: 5:32 PM
 */

namespace Wrsft\Test\Fixture;


use Cake\TestSuite\Fixture\TestFixture;

class TagsFixture extends TestFixture
{
    public $fields = [
        //"id" => [],
        "name" => [],
        "created" => [],
        "_constraints" => [
            "prim" => [
                "type" => "primary",
                "columns" => ["name"]
            ]
        ]
    ];

    public $records = [
        ["name" => "compound", "created" => "2017-05-23 05:41:33"],
        ["name" => "vehicule", "created" => "2017-05-23 05:41:33"],
        ["name" => "smile", "created" => "2017-05-23 05:41:33"],
        ["name" => "news", "created" => "2017-05-23 05:41:33"],
        ["name" => "science", "created" => "2017-05-23 05:41:33"],
        ["name" => "algorithm", "created" => "2017-05-23 05:41:33"]
    ];

}