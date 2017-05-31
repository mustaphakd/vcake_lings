<?php
/**
 * Prjct: Vhealings
 * User: musta
 * Date: 5/23/2017
 * Time: 10:20 PM
 */

namespace Wrsft\Model\Table;


use Cake\ORM\Table;
use Cake\Validation\Validator;

class TimeLinesTable extends Table
{
    const SCHEMA = [
        "id" => ["type" => "uuid"],
        "start" => ["type" => "time", "null" => false],
        "end" => ["type" => "time", "null" => false],
        "synopsys" => ["type" => "text", "length" => "tiny"],
        "image" => ["type" => "string"]
    ];

    private static $domain = 'Wrsft\TimeLines';

    public function initialize(array $config)
    {
        $this->setDisplayField("start");
        $this->setEntityClass('Wrst\Model\Entity\TimeLineEntity');

        $this->setSchema(self::SCHEMA);
    }

    public function validationDefault(Validator $validator)
    {
    }


}