<?php
/**
 * Prjct: Vhealings
 * User: musta
 * Date: 5/23/2017
 * Time: 3:35 PM
 */

namespace Wrsft\Test\Fixture;


use Cake\TestSuite\Fixture\TestFixture;

class TableMapperFixture extends TestFixture
{
    public $field = [
        "src_id" => [ "type" => "uuid", "null" => false],
        "dest_id" => ["type" => "uuid", "null" => false],
        "dest_type" => ["type" => "string", "null" => false, "fixed" => false, "length" => 50],
        "created" => ["type" => "datetime"],
        "_constraints" =>[
            "prim" => [
                "type" => "primary",
                "columns" => ["src_id", "dest_id", "dest_type"]
            ]
        ]
    ];


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
    }
}