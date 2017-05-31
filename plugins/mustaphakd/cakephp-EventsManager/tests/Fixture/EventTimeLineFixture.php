<?php
/**
 * Prjct: Vhealings
 * User: musta
 * Date: 5/29/2017
 * Time: 6:32 PM
 */

namespace Wrsft\Test\Fixture;


use Cake\TestSuite\Fixture\TestFixture;
use Cake\Utility\Text;
use Wrsft\Model\Table\EventsTimeLinesTable;
use Cake\Core\Configure;

class EventTimeLineFixture extends TestFixture
{
    public $fields = EventsTimeLinesTable::SCHEMA;

    public function init()
    {
        parent::init();

        if(Configure::check('Fixtures.Wrsft.EventsTimeLines')){
            $arr = Configure::read('Fixtures.Wrsft.EventsTimeLines');
            $this->records = [];

            foreach ($arr as $entity){
                $entity->id = Text::uuid();
                array_push($this->records, $entity);
            }
        }
    }

}