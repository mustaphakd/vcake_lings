<?php
/**
 * Prjct: Vhealings
 * User: musta
 * Date: 5/26/2017
 * Time: 1:05 AM
 */

namespace Wrsft\Database;


class Point
{

    protected $_lat;
    protected  $_long;

    public static function parse($value){

        if(empty($value)){
            return null;
        }

        if(!is_array($value) && (is_string($value) && mb_strpos($value, ',') !== false))
        {
            $value = explode(',', $value);
        }

        return new static($value[0], $value[1]);

    }

    public function __construct($lat, $long)
    {
        $this->_lat = $lat;
        $this->_long = $long;
    }

    /**
     * @return mixed
     */
    public function getLat()
    {
        return $this->_lat;
    }

    /**
     * @return mixed
     */
    public function getLong()
    {
        return $this->_long;
    }

    public function __toString()
    {
        return "$this->_lat, $this->_long";
    }

}