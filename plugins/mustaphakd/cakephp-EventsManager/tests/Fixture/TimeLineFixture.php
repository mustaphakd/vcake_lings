<?php
/**
 * Prjct: Vhealings
 * User: musta
 * Date: 5/24/2017
 * Time: 12:28 AM
 */

namespace Wrsft\Test\Fixture;


use Cake\TestSuite\Fixture\TestFixture;
use Cake\Utility\Text;
use Wrsft\Model\Table\TimeLinesTable;

class TimeLineFixture extends TestFixture
{
    public $fields = TimeLinesTable::SCHEMA;

    public function init()
    {
        parent::init();

        $this->records = [
            ["id" => Text::uuid(), "start" => "08:30 ", "end" => "09:15", "synopsys" => "brief description blah", "image" => 'ffadf\fadfa\fasdfa.png'],
            ["id" => Text::uuid(), "start" => "09:30 ", "end" => "10:15", "synopsys" => "brief description blah", "image" => 'ffadf\fadfa\fasdfa.png'],
            ["id" => Text::uuid(), "start" => "10:15 ", "end" => "12:00", "synopsys" => "brief description blah", "image" => 'ffadf\fadfa\fasdfa.png'],
            ["id" => Text::uuid(), "start" => "12:30 ", "end" => "14:15", "synopsys" => "brief description blah", "image" => 'ffadf\fadfa\fasdfa.png'],
            ["id" => Text::uuid(), "start" => "15:30 ", "end" => "18:15", "synopsys" => "brief description blah", "image" => 'ffadf\fadfa\fasdfa.png']

        ];
    }

}