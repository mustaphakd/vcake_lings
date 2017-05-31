<?php
/**
 * Prjct: Vhealings
 * User: musta
 * Date: 5/26/2017
 * Time: 1:20 AM
 */

namespace Wrsft\Database\Type;


use Cake\Database\Driver;
use Cake\Database\Expression\FunctionExpression;
use Cake\Database\Type as BaseType;
use Cake\Database\Type\ExpressionTypeInterface;
use Wrsft\Database\Point;

class PointType extends BaseType implements ExpressionTypeInterface
{

    public function toPHP($value, Driver $driver)
    {
        return Point::parse($value);
    }

    public function marshal($value)
    {
        if(is_string($value)){
            $value = explode(',', $value);
        }

        if(is_array($value))
        {
            if(count($value) < 2)
                return null;

            return new Point($value[0], $value[1]);
        }

        return null;

    }


    public function toExpression($value)
    {

        if($value instanceof Point){
            return new FunctionExpression(
                "",
                [
                    $value->__toString()
                ]);
        }


        return new FunctionExpression(
            "",
            [Point::parse($value)->__toString()]);

        if($value instanceof Point){
            return new FunctionExpression(
                "POINT",
                [
                    $value->getLat(),
                    $value->getLong()
                ]);
        }

        if(is_string($value)){
            $value = explode(',', $value, 2);
        }

        if(is_array($value)){
            return new FunctionExpression(
                'POINT',
                [
                    $value[0],
                    $value[1]
                ]
            );
        }
    }
}