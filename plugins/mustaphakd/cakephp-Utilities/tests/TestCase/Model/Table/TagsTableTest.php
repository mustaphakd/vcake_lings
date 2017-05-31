<?php
/**
 * Prjct: Vhealings
 * User: musta
 * Date: 5/26/2017
 * Time: 2:19 AM
 */

namespace Wrsft\Test\TestCase\Model\Table;

use Cake\Collection\Collection;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

class TagsTableTest extends TestCase
{
    public $fixtures = ["plugin.Wrsft.Tags"];

    /**
     * @var \Wrsft\Model\Table\TagsTable $Tag
     *
     */
    public $Tags;

    public function setUp()
    {
        parent::setUp();

        $this->Tags = TableRegistry::get(
            "Tags",
            [
                "className" => 'Wrsft\Model\Table\TagsTable',
                "table" => "tags"
            ]);

    }

    public function test_tagsGet_succeed(){

        $result = $this->Tags->find()->toArray();

        $this->assertNotEmpty($result, "Rows could not be fetch");
        $this->assertCount(6, $result, "Count mismatch");
    }

    public function test_tagsUpdate_succeed(){

        $result = $this->Tags->find()->toArray();

        //pr($result);
        $ithRow = $result[3];

        $this->Tags->updateName($ithRow["name"], "Bounbopun");

        $result = $this->Tags->find()->toArray();

        //pr($newResult);

        $nameArr = (new Collection($result))->extract("name")->toArray();

        $found = in_array($ithRow["name"], $nameArr);

        $this->assertFalse($found, "should be false");

    }

    public function test_tagsInsert_succeed(){

        $newEntity = $this->Tags->newEntity([
            "name" => "Yasmine"
        ]);

        $this->Tags->saveOrFail($newEntity);
        $newEntity = $this->Tags->find()->where(["name" => "yasmine"])->first();

        $this->assertNotNull($newEntity);
        $this->assertNotFalse($newEntity);
        $this->assertNotEmpty($newEntity->created);
    }

    public function test_tagsInsert_duplicate_fail(){

        $newEntity = $this->Tags->newEntity([
            "name" => "news"
        ]);
        $failure = false;

        try{
            $newEntity = $this->Tags->save($newEntity);

            if($newEntity === false){
                $failure = true;
            }
        }
        catch (\Exception $e){
            $failure = true;
        }

        if(!empty($newEntity->getErrors())){
            $failure = true;
        }

        $this->assertTrue($failure);

    }

    public function test_delete_succeed(){

        $found = $this->Tags->find()->where(["name" => "news"])->first();

        $this->Tags->delete($found);

        $count = $this->Tags->find()->count();

        $this->assertEquals(5, $count, "tag not deleted");
    }

    public function test_multipleNewtagsSaving_succeed(){

        $arr = [
            "news",
            "science",
            "smile",
            "buffet",
            "sport",
            "soccer",
            "algorithm",
            "sun"
        ];

        $this->Tags->saveMultiple($arr);

        $count = $this->Tags->find()->count();

        $this->assertEquals(10, $count , "not all tags were added");
    }

}