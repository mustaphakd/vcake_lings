<?php
/**
 * Prjct: Vhealings
 * User: musta
 * Date: 5/23/2017
 * Time: 3:35 PM
 */

namespace Wrsft\Test\Fixture;


use Cake\Core\Configure;
use Cake\TestSuite\Fixture\TestFixture;
use Cake\Utility\Text;
use Wrsft\Model\Table\TableMappersTable;

class TableMappersFixture extends TestFixture
{
    public $fields = TableMappersTable::SCHEMA;


    public function init()
    {
        parent::init();

        if(Configure::check('Fixture.Wrsft.TableMappers')){
            $arr = Configure::read('Fixture.Wrsft.TableMappers');
            $this->records = [];
            foreach ($arr as $ele){
                $this->records[] = [
                    'src_id' => $ele['src_id'],
                    'dest_id' => $ele['dest_id'],
                    'dest_type' => $ele['dest_id'],
                    'created' => (new \DateTime("now"))->format("Y-m-d H:i:s")];
            }
        }
        else{
            $commonSrc = Text::uuid();
            Configure::write("Fixture.Wrsft.TableMappers.CommonSoure", $commonSrc);
            $this->records = [
              [
                  "id" => Text::uuid(),
                  "src_id" => Text::uuid(),
                  "dest_id" => Text::uuid(),
                  "dest_type" => "unclassified",
                  "created" => (new \DateTime())->format("Y-m-d H:i:s")],
                [
                    "id" => Text::uuid(),
                    "src_id" => $commonSrc,
                    "dest_id" => Text::uuid(),
                    "dest_type" => "peg",
                    "created" => (new \DateTime())->format("Y-m-d H:i:s")],
                [
                    "id" => Text::uuid(),
                    "src_id" => $commonSrc,
                    "dest_id" => Text::uuid(),
                    "dest_type" => "peg",
                    "created" => (new \DateTime())->format("Y-m-d H:i:s")],
                [
                    "id" => Text::uuid(),
                    "src_id" => $commonSrc,
                    "dest_id" => Text::uuid(),
                    "dest_type" => "image",
                    "created" => (new \DateTime())->format("Y-m-d H:i:s")],
                [
                    "id" => Text::uuid(),
                    "src_id" => $commonSrc,
                    "dest_id" => Text::uuid(),
                    "dest_type" => "image",
                    "created" => (new \DateTime())->format("Y-m-d H:i:s")],
                [
                    "id" => Text::uuid(),
                    "src_id" => $commonSrc,
                    "dest_id" => Text::uuid(),
                    "dest_type" => "unclassified",
                    "created" => (new \DateTime())->format("Y-m-d H:i:s")]
            ];
        }
    }
}