<?php
/**
 * Prjct: Vhealings
 * User: musta
 * Date: 5/26/2017
 * Time: 2:18 AM
 */

namespace Wrsft\Test\TestCase\Model\Table;


use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

class ImagesTableTest extends TestCase
{
    public $fixtures = ["plugin.Wrsft.Images"];

    /**
     * @var \Wrsft\Model\Table\ImagesTable $Images
     */
    protected $Images;


    public function setUp()
    {
        parent::setUp();

        $this->Images = TableRegistry::get(
            "Images",
            [
                "className" => 'Wrsft\Model\Table\ImagesTable',
                "table" => "images"
            ]
        );

    }

    public function test_fetchall_succeed(){

        $foundImages = $this->Images->find()->all();

        $this->assertCount(3, $foundImages);
    }

    public function test_pathDeconstruction_succeed(){

        list($name, $path, $ext) = $this->Images->imageRequestCharacteristics("\\aeaddsad\\sdafadfa\\fad.jpg");

        $this->assertTextEquals("fad", $name, "deconstruction failed");
        $this->assertTextEquals('aeaddsad/sdafadfa', $path, "deconstruction failed");
        $this->assertTextEquals("jpg", $ext, "deconstruction failed");

        $arr = $this->Images->imageRequestCharacteristics([
            "\\aeaddsad\\sdafadfa\\fad.jpg"
        ]);

        list($name, $path, $ext) = $arr[0];

        $this->assertTextEquals("fad", $name, "deconstruction failed");
        $this->assertTextEquals("aeaddsad/sdafadfa", $path, "deconstruction failed");
        $this->assertTextEquals("jpg", $ext, "deconstruction failed");
    }

    public function test_delete_succeed(){

        $initialImages = $this->Images->find()->toArray();

        $this->Images->delete($initialImages[1]);

        $foundImages = $this->Images->find()->all();

        $this->assertCount(3, $initialImages);
        $this->assertCount(2, $foundImages);
    }

    public function test_deconstructedInsert_succeed(){

        list($name, $path, $ext) = $this->Images->imageRequestCharacteristics("\\aeaddsad\\sdafadfa\\fad.jpg");

        $newEntity = $this->Images->newEntity(["name" => $name, "path" => $path, "extension" => $ext]);
        $this->Images->save($newEntity);

        $this->assertCount(4, $this->Images->find()->toArray());

    }
}