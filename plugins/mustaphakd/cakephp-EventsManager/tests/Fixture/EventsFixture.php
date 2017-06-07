<?php
/**
 * Prjct: Vhealings
 * User: musta
 * Date: 5/24/2017
 * Time: 12:25 AM
 */

namespace Wrsft\Test\Fixture;


use Cake\TestSuite\Fixture\TestFixture;
use Cake\Utility\Text;
use Wrsft\Model\Table\EventsTable;
use Cake\Core\Configure;

class EventsFixture extends TestFixture
{
    public $fields = EventsTable::SCHEMA;

    public function init()
    {
        parent::init();

        if(Configure::check('Fixture.Wrsft.EventsLocationIds')){

            $arr = Configure::read('Fixture.Wrsft.EventsLocationIds');
            $this->records = [];

            $events = self::getEvents();
            $count = count($events);

            for($i = 0; $i < $count; $i++){
                $events[$i]["location_id"] = $arr[$i];
                array_push($this->records, $events[$i]);
            }
        }
    }

    public static function getEvents(){
        return [
            [
                "id" => Text::uuid(),
                "title" => "premier",
                "sub_header" => "sub premier",
                "description" => " holoas fadaewre",
                "start_date" => "2017-09-25",
                "end_date" => "2017-09-30",
                "default_cost" => 254,
                "currency" => "USD",
                "video_path" => "http://youtupe.com",
                "status" => "open"
            ],
            [
                "id" => Text::uuid(),
                "title" => "Deuxieme",
                "sub_header" => "sub Deuxieme",
                "description" => " holoas Deuxieme Deuxieme Deuxieme fadaewre",
                "start_date" => "2018-10-10",
                "end_date" => "2018-10-20",
                "default_cost" => 2344,
                "currency" => "USD",
                "video_path" => "http://youtupe.com",
                "status" => "open"
            ],
            [
                "id" => Text::uuid(),
                "title" => "Troixiemd",
                "sub_header" => "sub Troixiemd",
                "description" => " holoas Troixiemd Troixiemd fadaewre Troixiemd",
                "start_date" => "2017-11-05",
                "end_date" => "2017-11-18",
                "default_cost" => 500,
                "currency" => "USD",
                "video_path" => "http://youtupe.com",
                "status" => "soon"
            ]
        ];
    }
}