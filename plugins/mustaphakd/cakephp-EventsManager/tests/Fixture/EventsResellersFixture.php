<?php
/**
 * Prjct: Vhealings
 * User: musta
 * Date: 5/24/2017
 * Time: 12:26 AM
 */

namespace Wrsft\Test\Fixture;


use Cake\Core\Configure;
use Cake\TestSuite\Fixture\TestFixture;
use Cake\Utility\Text;
use Wrsft\Model\Table\EventsResellersTable;

class EventsResellersFixture extends TestFixture
{
    public $fields = EventsResellersTable::SCHEMA;

    public function init()
    {
        $this->table = "events_resellers";
        parent::init();

        if(Configure::check('Fixtures.Wrsft.EventsResellers')){
            $arr = Configure::read('Fixtures.Wrsft.EventsResellers');
            $this->records = [];

            foreach ($arr as $entity){
                $entity["id"] = Text::uuid();
                array_push($this->records, $entity);
            }
            unset($entity);
        }
    }

}