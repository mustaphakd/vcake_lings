<?php
/**
 * Prjct: Vhealings
 * User: musta
 * Date: 5/23/2017
 * Time: 5:32 PM
 */

namespace Wrsft\Model\Table;


use Cake\Database\Connection;
use Cake\Event\Event;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class TagsTable extends Table
{
    private static $domain = 'Wrsft\Tags';

    const SCHEMA = [
        "id" => ["type" => "uuid"],
        "name" => ["type" => "string", "fixed" => false, "null" => false, "length" => 30],
        "created" => ["type" => "datetime"],
        "_constraints" => [
            "prim" => [
                "type" => "primary",
                "columns" => ["id"]
            ],
            "unique_name" => [
                "type" => "unique",
                "columns" => ["name"]
            ]
        ]
    ];

    public function initialize(array $config)
    {
        $this->setDisplayField("name");
        $this->setEntityClass('Wrsft\Model\Entity\TagEntity');

        $this->setSchema(self::SCHEMA);
    }

    public function updateName($oldName, $newName){
        $first = $this->find()->where(["name" => $oldName])->first();
        $first = $this->patchEntity($first, ["name" => $newName]);

        return $this->saveOrFail($first);
    }

    public function beforeSave( Event $event, $subject, $options){
        $subject->name = strtolower($subject->name);
        if($subject->isNew()){
            $subject->created = (new \DateTimeImmutable())->format("Y-m-d H:i:s");
        }
        return $subject;
    }

    public function saveMultiple($names){

        $foundNames = $this->find()->where(["name IN" => $names])->extract("name")->toArray();

        $arrDiff = array_diff($names, $foundNames);

        $arrDiff = array_map(
            function ($item){
                return ["name" => $item];
            },
            $arrDiff);

        $newEntities = $this->newEntities($arrDiff);

        return $this->saveMany($newEntities);
    }

    public function validationDefault(Validator $validator)
    {
        $validator
            ->requirePresence("name", true, __d(self::$domain,"name is required"))
            ->lengthBetween("name", [1, 30], __d(self::$domain, "name must have length between 1 - 30"));
        return $validator;
    }

}