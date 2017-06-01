<?php
/**
 * Prjct: Vhealings
 * User: musta
 * Date: 5/23/2017
 * Time: 3:45 PM
 */

namespace Wrsft\Model\Table;


use Cake\Database\Schema\TableSchema;
use Cake\ORM\Query;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class TableMappersTable extends Table
{
    private static $domain = 'Wrsft\TableMappers';
    const TYPES_IMAGE = "image";
    const TYPES_TAG = "tag";
    const TYPES_LOCATION = "location";
    const TYPES_USER = "user";

    const SCHEMA = [
        "id" => ["type" => "uuid"],
        "src_id" => [ "type" => "uuid", "null" => false],
        "dest_id" => ["type" => "uuid", "null" => false],
        "dest_type" => ["type" => "string", "null" => false, "fixed" => false, "length" => 50],
        "created" => ["type" => "datetime"],
        "_constraints" =>[
            "prim" => [
                "type" => "primary",
                "columns" => ["id"]
            ]
        ]
    ];

    public function initialize(array $config)
    {
        $this->setDisplayField("dest_type");
        $this->setEntityClass('Wrsft\Model\Entity\TableMapperEntity');
        $this->setTable("table_mappers");

        $this->setSchema(self::SCHEMA);
        $this->getSchema()->addIndex(
            "unique_idx",
            [
                "type" => TableSchema::INDEX_INDEX,
                "columns" => ["src_id", "dest_id", "dest_type"]
            ]);
    }

    public function validationDefault(Validator $validator)
    {
        $validator
            ->requirePresence(["src_id", "dest_id", "dest_type"], true, __d(self::$domain, "required presence"));
        return $validator;
    }


    /**
     * @param string $source_id
     * @param array $options . One Level array of strings
     * @return Query
     */
    public function findBySource($source_id, Array $options = null){
        $opt = ["src_id" => $source_id];

        if(!empty($options)){
            $opt += [
              "dest_type IN" => $options
            ];
        }

        return $this->find()->where($opt);
    }


}