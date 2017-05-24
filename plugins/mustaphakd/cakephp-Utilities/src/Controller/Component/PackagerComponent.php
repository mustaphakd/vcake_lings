<?php
/**
 * Prjct: Vhealings
 * User: musta
 * Date: 5/19/2017
 * Time: 11:16 PM
 */

namespace Wrsft\Controller\Component;


use Cake\Controller\Component;
use Cake\Utility\Security;

class PackagerComponent extends Component
{

    /**
     * The encryption makes use of the default Security::salt() as its key
     *@param array $arr the array to package into a secure B64 encoded string transmittable over wire.  The array must contain
     * primitives types only
     * @return string a B64 encoded string
     * @throws \Exception
     */
    public function package(array $arr){

        if(!isset($arr) || !is_array($arr)){
            throw new Exception("PackagerComponent parameter is not valid");
        }

        $salt = Security::salt(null);
        $seralized = serialize($arr);
        $b64Str = SslCryptorComponent::encrypt(
            $this->getController(),
            $seralized,
            $salt,
            SslCryptorComponent::FORMAT_B64 );

        return $b64Str;

    }

    /**The encryption makes use of the default Security::salt() as its key
     * @param string $b64Str
     * @return array|string
     */
    public function unPack($b64Str){

        if( ($b64Str === null) || isEmpty($b64Str)){
            return "";
        }

        $salt = Security::salt(null);
        $serialized = SslCryptorComponent::decrypt(
            $this->getController(),
            $b64Str,
            $salt,
            SslCryptorComponent::FORMAT_B64
        );

        $arr = (array)unserialize($serialized);
        return $arr;
    }

}