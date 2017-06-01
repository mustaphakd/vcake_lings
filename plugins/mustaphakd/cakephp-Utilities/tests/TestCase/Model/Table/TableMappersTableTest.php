<?php
/**
 * Prjct: Vhealings
 * User: musta
 * Date: 5/26/2017
 * Time: 2:20 AM
 */

namespace Wrsft\Test\TestCase\Model\Table;


use Cake\Core\Configure;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Cake\Utility\Text;
use Wrsft\Model\Entity\TableMapperEntity;

class TableMappersTableTest extends TestCase
{

    public $fixtures = ['plugin.Wrsft.TableMappers'];
    public $autoFixtures = true;

    /**
     * @var \Wrsft\Model\Table\TableMappersTable $TableMappers
     */
    public $TableMappers;

    public function setUp()
    {
        parent::setUp();

        $this->TableMappers = TableRegistry::get(
            "TableMappers",
            [
                "className" => '\Wrsft\Model\Table\TableMappersTable'
            ]);
    }

    public  function test_getAll_succeed(){

        $countArr = $this->TableMappers->find()->toArray();

        $this->assertCount(6,$countArr, "Count mismatch");

        return $countArr;

    }

    public function test_retrieve_specific_src_nullDestType_succeed(){

        $src_id = Configure::read("Fixture.Wrsft.TableMappers.CommonSoure");

        $result = $this->TableMappers->findBySource($src_id, null)->toArray();

        $this->assertCount(5, $result);

    }

    public function test_retrieve_specific_src_specifiedDestType_succeed(){

        $src_id = Configure::read("Fixture.Wrsft.TableMappers.CommonSoure");

        $result = $this->TableMappers->findBySource($src_id, ["peg", "image"])->toArray();

        $this->assertCount(4, $result);

    }


    /**
     * @depends test_getAll_succeed
     */
    public function test_update_succeed(array $mappers){
        $selectedMapper = $mappers[3];

        $old_dest_id = $selectedMapper->dest_it;

        $selectedMapper->dest_it = Text::uuid();
        $selectedMapper->setDirty("dest_id", true);

        $this->TableMappers->save($selectedMapper);

        $updatedMapper = $this->TableMappers->get("$selectedMapper->id");

        $this->assertInstanceOf(TableMapperEntity::class, $updatedMapper);

        $this->assertNotEquals($old_dest_id, $updatedMapper->id, "updated mapper id not changed");
    }

}