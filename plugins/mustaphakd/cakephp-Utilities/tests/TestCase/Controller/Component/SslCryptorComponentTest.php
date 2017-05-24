<?php
/**
 * Prjct: Vhealings
 * User: musta
 * Date: 5/17/2017
 * Time: 10:35 PM
 */

namespace Wrsft\Test\TestCase\Controller\Component;


use Cake\Controller\ComponentRegistry;
use Cake\Http\Response;
use Cake\Http\ServerRequest;
use Cake\TestSuite\TestCase;
use Wrsft\Controller\Component\SslCryptorComponent;

class SslCryptorComponentTest extends TestCase
{
    /**
     *@property /Wrsft/Controller/Component/SslCryptorComponent $component
     */
    private $component;
    private static $data = "Bonjour mes amis, how are U?";
    private static $key = "salt&pepper_8*8";

    public function setUp()
    {
        parent::setUp();

        $request = new ServerRequest();
        $response = new Response();

        $controller = $this->getMockBuilder('\Cake\Controller\Controller')
            ->setConstructorArgs([$request, $response])
            ->setMethods(null)
            ->getMock();

        $this->component = new SslCryptorComponent(new ComponentRegistry($controller));

    }

    public function test_encryption_decryption_roundTrip_success(){

        $encryptedData = $this->component->m_encrypt(self::$data, self::$key);
        $decryptedData = $this->component->m_decrypt($encryptedData, self::$key);

        $this->assertEquals(self::$data, $decryptedData, "SslCryptor encryption decryption roundtrip failed.");

    }

}