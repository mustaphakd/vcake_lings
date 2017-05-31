<?php
/**
 * Prjct: Vhealings
 * User: musta
 * Date: 5/23/2017
 * Time: 3:30 PM
 */

namespace Wrsft\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;
use Cake\Utility\Text;
use Wrsft\Model\Table\ImagesTable;

class ImagesFixture extends TestFixture
{
    public $fields = ImagesTable::SCHEMA;



    public function init()
    {
        parent::init();

        $this->records = [
            ["id" => Text::uuid(), "name" => "img1", "path" => "tests/slider", "extension" => "jpg"],
            ["id" => Text::uuid(), "name" => "img2", "path" => "tests/slider", "extension" => "jpg"],
            ["id" => Text::uuid(), "name" => "img3", "path" => "tests/slider", "extension" => "png"]
        ];
    }

}