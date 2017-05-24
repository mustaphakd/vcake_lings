<?php
/**
 * Prjct: Vhealings
 * User: musta
 * Date: 4/28/2017
 * Time: 12:39 PM
 */



namespace Wrsft\Test\TestCase\Controller\Component;

use Cake\Mailer\Transport;
use Cake\Mailer\AbstractTransport;
use Cake\Mailer\Email;

/**
 * Debug Transport class, useful for emulating the email sending process and inspecting
 * the resultant email message before actually sending it during development
 */
class MailTransportMock extends AbstractTransport
{

    public $sentMessage;

    public static $glSentMessages = [];

    public function send(Email $email)
    {
        $headers = $email->getHeaders(['from', 'sender', 'replyTo', 'readReceipt', 'returnPath', 'to', 'cc', 'subject']);
        $headers = $this->_headersToString($headers);
        $message = implode("\r\n", (array)$email->message());

        $this->sentMessage[] = ['headers' => $headers, 'message' => $message];
        static::setMessageLog( ['headers' => $headers, 'message' => $message]);
    }

    public static function getMessageLog(){
        return MailTransportMock::$glSentMessages;
    }

    public static function setMessageLog($value){
        MailTransportMock::$glSentMessages[] = $value;
    }

    public static function clearMessageLog()
    {
        MailTransportMock::$glSentMessages = [];
    }

}
