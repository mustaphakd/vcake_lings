<?php
/**
 * Prjct: Vhealings
 * User: musta
 * Date: 5/23/2017
 * Time: 5:32 PM
 */

namespace Wrsft\Test\Fixture;


use Cake\TestSuite\Fixture\TestFixture;
use Cake\Utility\Text;
use Wrsft\Model\Table\TagsTable;

class TagsFixture extends TestFixture
{
    public $fields = TagsTable::SCHEMA;


    public function init()
    {
        parent::init();

        $this->records = [
            ["id" => Text::uuid(), "name" => "compound", "created" => "2017-05-23 05:41:33"],
            ["id" => Text::uuid(), "name" => "vehicule", "created" => "2017-05-23 05:41:33"],
            ["id" => Text::uuid(), "name" => "smile", "created" => "2017-05-23 05:41:33"],
            ["id" => Text::uuid(), "name" => "news", "created" => "2017-05-23 05:41:33"],
            ["id" => Text::uuid(), "name" => "science", "created" => "2017-05-23 05:41:33"],
            ["id" => Text::uuid(), "name" => "algorithm", "created" => "2017-05-23 05:41:33"]
        ];
    }

}