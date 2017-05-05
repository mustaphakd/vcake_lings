<?php
/**
 * Prjct: Vhealings
 * User: musta
 * Date: 4/28/2017
 * Time: 11:55 AM
 */

namespace Wrsft\Test\TestCase\Controller\Component;

use Cake\Core\Configure;
use Wrsft\Controller\Component\EmailComponent;
use Cake\Controller\ComponentRegistry;
use Cake\Network\Request;
use Cake\Network\Response;
use Cake\TestSuite\TestCase;

class EmailComponentTest extends TestCase
{
    public $controller;
    public $component;

    /**
     * @return array
     */
    private static function GenerateParameters()
    {
        $from = "from@wrsft.com";
        $to = "to@wrsft.com";
        $subject = "mail subject";

        $body = "bonjour medames et mensieur";
        return array($from, $to, $subject, $body);
    }

    public function setUp()
    {
        parent::setUp();

        $request = new Request();
        $response = new Response();

        $this->controller = $this->getMockBuilder('Cake\Controller\Controller')
            ->setConstructorArgs([$request, $response])
            ->setMethods(null)
            ->getMock();

        $registry = new ComponentRegistry($this->controller);

        $this->component = new EmailComponent($registry);

        $debugTransport = new MailTransportMock();
        $this->component->emailer->setTransport($debugTransport);
    }

    public function testSendingSingleEmail()
    {
        list($from, $to, $subject, $body) = self::GenerateParameters();

        $this->component->sendEmail($from, $subject,$to, $body);

        $transport = $this->component->emailer->transport();
        $headers = $transport->sentMessage[0]['headers'];
        $message = $transport->sentMessage[0]['message'];

        $this->AssertMail($from, $headers, $to, $subject, $body, $message);

    }

    public function testSendingEmails()
    {
        list($from, $to, $subject, $body) = self::GenerateParameters();
        $to = [$to];
        $to[] = "encore@wrsft.com";
        $to[] = "encore2@wrsft.com";
        $this->component->sendEmail($from, $subject,$to, $body);

        $transport = $this->component->emailer->transport();
        $headers = $transport->sentMessage[0]['headers'];
        $message = $transport->sentMessage[0]['message'];

        $this->AssertMail($from, $headers, $to[0], $subject, $body, $message);
        $this->assertTextContains($to[1], $transport->sentMessage[1]['headers'], "destination header does not match");
        $this->assertTextContains($to[2], $transport->sentMessage[2]['headers'], "destination header does not match");
    }

    public function testSendSingleEmailOnBehalf(){

        list($from, $to, $subject, $body) = self::GenerateParameters();

        Configure::write("emailSender", "contactus@wrsft.com");

        $this->component->sendEmailOnBehalf($from, $subject,$to, $body);

        $transport = $this->component->emailer->transport();
        $headers = $transport->sentMessage[0]['headers'];
        $message = $transport->sentMessage[0]['message'];

        $this->AssertMail($from, $headers, $to, $subject, $body, $message);
        //var_dump($headers);
        $this->assertTextContains("contactus@wrsft.com", $headers, "sender on envelop header does not match");
    }

    /**
     * @param $from
     * @param $headers
     * @param $to
     * @param $subject
     * @param $body
     * @param $message
     */
    private function AssertMail($from, $headers, $to, $subject, $body, $message)
    {
        $this->assertTextContains($from, $headers, "from header does not match");
        $this->assertTextContains($to, $headers, "To header does not match");
        $this->assertTextContains($subject, $headers, "Subject header does not match");

        $this->assertTextEquals(trim($body), trim($message));
    }

}