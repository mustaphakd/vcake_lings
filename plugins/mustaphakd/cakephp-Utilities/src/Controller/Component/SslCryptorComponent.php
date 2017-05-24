<?php
/**
 * Prjct: Vhealings
 * User: musta
 * Date: 5/17/2017
 * Time: 4:26 PM
 */

namespace Wrsft\Controller\Component;


use Cake\Controller\Component;
use Cake\Controller\Controller;
use Cake\Core\Exception\Exception;

class SslCryptorComponent extends Component
{

    const FORMAT_RAW = 0;
    const FORMAT_B64 = 1;
    const FORMAT_HEX = 2;

    private $cipher_algo = "aes-256-ctr";
    private $digest_algo = "sha256";
    private $format = SslCryptorComponent::FORMAT_B64;
    private $iv_numBytes;

    public function initialize(array $config)
    {
        parent::initialize($config);

        if(isset($config["cipher_algo"])){
            $this->cipher_algo = $config["cipher_algo"];
        }

        if(isset($config["digest_algo"])){
            $this->digest_algo = $config["digest_algo"];
        }

        if(isset($config["format"]) && !empty($config["format"])){
            $this->format = $config["format"];
        }

        if(!in_array($this->cipher_algo, openssl_get_cipher_methods(true))){
            throw new Exception("SslCryptorComponent unrecognized ciper algo $this->cipher_algo");
        }

        if(! in_array($this->digest_algo, openssl_get_md_methods(true))){
            throw new Exception("SslCryptorComponent unrecognized digest algo $this->digest_algo");
        }

        if(!in_array($this->format, [SslCryptorComponent::FORMAT_B64, SslCryptorComponent::FORMAT_HEX, SslCryptorComponent::FORMAT_RAW])){
            throw new Exception("SslCryptorComponent unrecognized format $this->format");
        }

        $this->iv_numBytes = openssl_cipher_iv_length($this->cipher_algo);

    }


    /**
     * @param string $data. string to be encrypted
     * @param string $key used during encryption procedure.
     * @param  string|null $format affects the returned encrypted data. Valid
     * values are SslCryptorComponent::Format_B64| SslCryptorComponent::Format_HEX | SslCryptorComponent::Format_RAW
     *
     * @return string encrypted data in the format special during construction
     */
    public function m_encrypt($data, $key, $format = null){

        if($format !== null){
            $this->format = $format;
        }

        $iv = mcrypt_create_iv($this->iv_numBytes, MCRYPT_DEV_URANDOM);

        if(!$iv){
            throw new Exception("SslCryptorComponent unable to generate Initialization vector");
        }

        $keyHash = openssl_digest($key, $this->digest_algo, true);

        if(!$keyHash){
            throw new Exception("SslCryptorComponent key digest failed: " . openssl_error_string());
        }

        $opt = OPENSSL_RAW_DATA;
        $encryptedData = openssl_encrypt($data, $this->cipher_algo, $keyHash, $opt, $iv);

        if(!$encryptedData){
            throw new Exception("SslCryptorComponent encrytion failed. " . openssl_error_string());
        }

        $result = $iv . $encryptedData;

        if($this->format === SslCryptorComponent::FORMAT_B64){
            $result = base64_encode($result);
        }
        elseif($this->format === SslCryptorComponent::FORMAT_HEX){
            $result = unpack("H*", $result);
        }

        return $result;
    }

    /**
     * @param string $data. encoded string to be decrypted
     * @param string $key used decryption procedure.
     * @param string|null $format encrypted data format.Valid
     * values are SslCryptorComponent::Format_B64| SslCryptorComponent::Format_HEX | SslCryptorComponent::Format_RAW
     *
     * @return string decrypted data in the original format
     **/
    public function m_decrypt($data, $key, $format = null){

        if($format !== null){
            $this->format = $format;
        }

        if($this->format === SslCryptorComponent::FORMAT_B64){
            $data = base64_decode($data);
        }

        if($this->format === SslCryptorComponent::FORMAT_HEX){
            $data = pack("H*", $data);
        }

        if(strlen($data) <= $this->iv_numBytes){
            throw new Exception("SslCryptorComponent data size is less than " . $this->iv_numBytes);
        }

        $keyHash = openssl_digest($key, $this->digest_algo, true);

        $iv = substr($data, 0, $this->iv_numBytes);
        $encryptedData = substr($data, $this->iv_numBytes);

        $opt = OPENSSL_RAW_DATA;
        $decryptedData = openssl_decrypt($encryptedData, $this->cipher_algo, $keyHash, $opt, $iv);

        if(!$decryptedData){
            throw new Exception("SslCryptorComponent unable to decrypt data " . openssl_error_string());
        }

        return $decryptedData;

    }


    /**
     * @param App/Controller/Controller $controller provides componentRegistry for this SslCryptorComponent component instance
     * @param string $inString data to be encrypted
     * @param string $keyString key used during encryption
     * @param  string $format affects the returned encrypted data. Valid
     * values are SslCryptorComponent::Format_B64| SslCryptorComponent::Format_HEX | SslCryptorComponent::Format_RAW
     *
     *
     *@return string encrypted data in the format specified
     */
    public static function encrypt(Controller $controler, $inString, $keyString, $format = SslCryptorComponent::FORMAT_B64){

        $cryptor = new SslCryptorComponent($controler->components(), ["format" => $format]);
        return $cryptor->m_encrypt($inString, $keyString, $format);
    }

    /**
     * @param App/Controller/Controller $controller provides componentRegistry for this SslCryptorComponent component instance
     * @param string $inString data to be decrypted
     * @param string $keyString key used during decryption
     * @param  string $format of the encrypted $inString. Valid
     * values are SslCryptorComponent::Format_B64| SslCryptorComponent::Format_HEX | SslCryptorComponent::Format_RAW
     *
     *
     *@return string encrypted data in the format specified
     */
    public static function decrypt(Controller $controller, $inString, $keyString, $format = SslCryptorComponent::FORMAT_B64){

        $cryptor = new SslCryptorComponent($controller->components(), ["format" => $format]);
        return $cryptor->m_decrypt($inString, $keyString, $format);
    }

}