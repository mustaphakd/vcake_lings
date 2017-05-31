<?php
/**
 * Prjct: Vhealings
 * User: musta
 * Date: 5/23/2017
 * Time: 3:44 PM
 */

namespace Wrsft\Model\Table;


use Cake\ORM\Table;
use Cake\Validation\Validator;

class ImagesTable extends Table
{
    private static $domain = 'Wrsft\Images';

    const SCHEMA = [
        "id" => ["type" => "uuid"],
        "name" => ["type" => "string", "fixed" => false, "null" => false, "length" => 20],
        "path" => ["type" => "string", "fixed" => false, "null" => false, "length" => 1000],
        "extension" => ["type" => "string", "fixed" => false, "null" => false, "length" => 5],
        "created" => ["type" => "datetime"],
        "modified" => ["type" => "datetime"],
        "_constraints" => [
            "prim" => [
                "type" => "primary",
                "columns" => ["id"]
            ]
        ]
    ];

    public function initialize(array $config)
    {
        $this->setDisplayField("path");
        $this->setEntityClass('Wrsft\Model\Entity\ImageEntity');

        $this->setSchema(self::SCHEMA);
    }

    public function validationDefault(Validator $validator)
    {
        $validator
            ->uuid("id", __d(self::$domain, "not Referenced", "update"))
            ->requirePresence(["name", "path", "extension"], "create", __d(self::$domain, "name, path, and extension are required"))
            ->requirePresence(["name", "path", "extension"], "update", __d(self::$domain, "id, name, path, and extension are required"))
            ->lengthBetween("name", [1, 20], __d(self::$domain, "name length must be between 1 - 20"))
            ->lengthBetween("path", [1, 1000], __d(self::$domain, "path length must be between 1 - 1000"))
            ->lengthBetween("extension", [1, 5], __d(self::$domain, "extenstion length must be between 1 - 5"));

        return $validator;
    }

    private static function deconstructImageRequestData($imageRequestData){
        $imageRequestData = trim($imageRequestData, "\\/");
        $imageRequestData = str_replace('\\', '/', $imageRequestData);

        $tokens = explode('/', $imageRequestData);
        $count = count($tokens);

        list($name, $ext) = explode('.', $tokens[$count - 1 ], 2);
        array_pop($tokens);
        $path = implode('/', $tokens);

        return [$name, $path, $ext];
    }

    /**
     * @param array | string $imageRequestData the image paht string representation to decompose
     * @return array
     */
    public function imageRequestCharacteristics($imageRequestData){

        if(!is_array($imageRequestData)) {
            return list($name, $path, $extension) = self::deconstructImageRequestData($imageRequestData);
        }

        $result = [];
        foreach ($imageRequestData as $child){
            $result[] = self::deconstructImageRequestData($child);
        }

        return $result;
    }

}