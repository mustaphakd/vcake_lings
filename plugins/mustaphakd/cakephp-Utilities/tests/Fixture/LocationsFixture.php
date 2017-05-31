<?php
/**
 * Prjct: Vhealings
 * User: musta
 * Date: 5/23/2017
 * Time: 3:31 PM
 */

namespace Wrsft\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;
use Cake\Utility\Text;
use Wrsft\Database\Point;
use Wrsft\Model\Table\LocationsTable;

class LocationsFixture extends TestFixture
{
    public $fields = LocationsTable::SCHEMA;


    public function init()
    {
        parent::init();

        $this->records = [
            ["id" => Text::uuid(), "name" => "location one", "point" => Point::parse(["0.356", "5.6987"]), "country" => "Cote D'Ivoire", "city" => "Bouake", "address" => "Dar es salam"],
            ["id" => Text::uuid(), "name" => "location trois", "point" => '89.3641, 789.325', "country" => "Mali", "city" => "Nouakchott", "address" => "Kenyatta"],
            ["id" => Text::uuid(), "name" => "location six", "point" => "78.3789, 47.68984", "country" => "Sudan", "city" => "Accra", "address" => "Banjubura"]
        ];
    }

}