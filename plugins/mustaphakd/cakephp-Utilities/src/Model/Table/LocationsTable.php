<?php
/**
 * Prjct: Vhealings
 * User: musta
 * Date: 5/23/2017
 * Time: 3:44 PM
 */

namespace Wrsft\Model\Table;


use Cake\Database\Schema\TableSchema;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Wrsft\Database\Type\PointType;

class LocationsTable extends Table
{
    private static $domain = 'Wrsft\Locations';

    const SCHEMA = [
        "id" => ["type" => "uuid"],
        "name" => ["type" => "string", "null" => false, "fixed" => false, "length" => 20],
        "point" => ["type" => "string", "null" => false],
        "country" => ["type" => "string", "null" => false, "fixed" => false, "length" => 20],
        "city" => ["type" => "string", "null" => false, "fixed" => false, "length" => 20],
        "address" => ["type" => "string", "null" => false, "fixed" => false, "length" => 100],
        "description" => ["type" => "string", "length" => 255, "fixed" => false],
        "_constraints" => [
            "prim" =>[
                "type" => "primary",
                "columns" => ["id"]
            ]
        ]
    ];

    public function initialize(array $config)
    {
        $this->setDisplayField("name");
        $this->setEntityClass('Wrsft\Model\Entity\LocationEntity');

        $this->setSchema(self::SCHEMA);
        $this->_schema->columnType("point", "point");
    }

    /**
     * called when schema is being loaded from db
     * @param TableSchema $schema
     * @return TableSchema
     */
    public function _initializeSchema(TableSchema $schema)
    {
        pr($schema);
        $schema->columnType("point", "point");
        return $schema;
    }

    public function validationDefault(Validator $validator)
    {
        $validator
            ->requirePresence(
                ["name", "point", "country", "city", "description", "address"],
                true,
                __d(self::$domain, "name, point, country, city, and description required"))
            ->lengthBetween("name", [ 1, 20], __d(self::$domain, "string range must be between {0} and {1}",[1, 20]))
            ->lengthBetween("country", [ 1, 20], __d(self::$domain, "string range must be between {0} and {1}",[1, 20]))
            ->lengthBetween("city", [ 1, 20], __d(self::$domain, "string range must be between {0} and {1}",[1, 20]))
            ->lengthBetween("address", [ 1, 20], __d(self::$domain, "string range must be between {0} and {1}",[1, 100]))
            ->add(
                "point",
                [
                    "point_validation" => [
                        "being passed around",
                        "rule" => function($value, $context){

                            if($value instanceof PointType)
                                return true;

                            if(is_array($value) && (count($value) < 2))
                                return false;

                            return true;
                        },
                        "message" => __d(self::$domain, "point is invalid")
                    ]
                ]);

        return $validator;
    }

}