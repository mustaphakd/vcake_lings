<?php
/**
 * Prjct: Vhealings
 * User: musta
 * Date: 5/26/2017
 * Time: 2:19 AM
 */

namespace Wrsft\Test\TestCase\Model\Table;


use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Wrsft\Database\Point;
use Wrsft\Model\Entity\LocationEntity;

class LocationsTableTest extends TestCase
{
    public $fixtures = ["plugin.Wrsft.Locations"];
    public $autoFixtures = true;

    /**
     * @var \Wrsft\Model\Table\LocationsTable Locations
     *
     */
    public $Locations;

    public function setUp()
    {
        parent::setUp();

        $this->Locations = TableRegistry::get(
            "Locations",
            [
                "className" => 'Wrsft\Model\Table\LocationsTable',
                "table" => "locations"
            ]);

    }

    public function test_fetch_nd_properCasting_succeed(){

        $found = $this->Locations->find()->toArray();
        $count = count($found);

        $this->assertEquals(3, $count);

        $isProperType = true;

        foreach ($found as $item){
            if(! ($item instanceof LocationEntity)){
                $isProperType = false;
                break;
            }

            if(! ($item->point instanceof Point)){
                $isProperType = false;
                break;
            }
        }

        $this->assertTrue($isProperType, "All entities point property was not well hydrated");
    }

    public function test_insert_succeed(){

        $data = [
            ["name" => "testing one", "point" => ["45.36","16.87"], "country" => "Cote D'Ivoire", "city" => "Bouake", "address" => "Kennedy", "description" => "caco"],
            ["name" => "testing two", "point" => ["45.36","486.87"], "country" => "Cote D'Ivoire", "city" => "Bouake", "address" => "Kennedy", "description" => "caco"],
            ["name" => "Bambie", "point" => ["44.36","446.87"], "country" => "Cote D'Ivoire", "city" => "Bouake", "address" => "Kennedy", "description" => "caco"]
        ];

        $newEntites = $this->Locations->newEntities($data);

        $hasError = false;
        foreach ($newEntites as $entry){
            if (!empty($entry->getErrors())){
                $hasError = true;
                break;
            }
        }

        $this->assertFalse($hasError, "Error generated creating new location data");

        $this->Locations->saveMany($newEntites);

        $this->assertCount(
            6,
            $this->Locations->find()->enableHydration(false)->toArray(),
            "Error saving new entities to locations"
        );
    }

    public function test_invalidPoint_fail(){
        $data = ["name" => "testing one", "point" => ["45.36"], "country" => "Cote D'Ivoire", "city" => "Bouake", "address" => "Kennedy", "description" => "caco"];

        $entity = $this->Locations->newEntity($data);

        $this->assertNotEmpty($entity->getErrors(), "Errors should have been generated");
    }

    public function test_updateValidPoint_succeed(){

        $foundEntity = $this->Locations->find()->toArray()[2];

        $foundEntity->point = Point::parse(["4.23", "4.44"]);
        $foundEntity->isDirty = true;

        $this->Locations->save($foundEntity);


        $newFoundEntity = $this->Locations->find()->where(["name" => $foundEntity->name])->first();


        $this->assertEquals($foundEntity->point->getLat(), $newFoundEntity->point->getLat(), "Changes were not saved");
        $this->assertEquals($foundEntity->point->getLong(), $newFoundEntity->point->getLong(), "Changes were not saved");

    }

}