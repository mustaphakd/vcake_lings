<?php
/**
 * Prjct: Vhealings
 * User: musta
 * Date: 5/24/2017
 * Time: 12:25 AM
 */

namespace Wrsft\Test\Fixture;

use Cake\Core\Configure;
use Cake\Database\Schema\TableSchema;
use Cake\TestSuite\Fixture\TestFixture;
use Cake\Utility\Text;
use Wrsft\Model\Table\EventRegistrationsTable;

class EventRegistrationFixture extends TestFixture
{

    public $fields = EventRegistrationsTable::SCHEMA;

    public function init()
    {
        parent::init();

        if (Configure::check('Fixtures.Wrsft.EventRegistrations')){
            $arr = Configure::read('Fixture.Wrsft.EventRegistrations');
            $this->records = [];

            foreach ($arr as $entity){
                $entity->id = Text::uuid();
                array_push($this->records, $entity);
            }
        }
    }

}