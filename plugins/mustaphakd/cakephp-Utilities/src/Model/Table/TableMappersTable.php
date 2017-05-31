<?php
/**
 * Prjct: Vhealings
 * User: musta
 * Date: 5/23/2017
 * Time: 3:45 PM
 */

namespace Wrsft\Model\Table;


use Cake\ORM\Table;
use Cake\Validation\Validator;

class TableMappersTable extends Table
{
    private static $domain = 'Wrsft\TableMappers';

    const SCHEMA = [
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

    public function initialize(array $config)
    {
        $this->setDisplayField("type");
        $this->setEntityClass('Wrsft\Model\Entity\TableMapperEntity');

        $this->setSchema(self::SCHEMA);
    }

    public function validationDefault(Validator $validator)
    {
        return $validator;
    }


}