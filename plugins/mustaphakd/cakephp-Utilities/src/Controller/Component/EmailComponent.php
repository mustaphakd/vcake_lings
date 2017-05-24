<?php

/**
 * Prjct: Vhealings
 * User: musta
 * Date: 4/27/2017
 * Time: 10:53 AM
 */

namespace Wrsft\Controller\Component ;

use Cake\Core\Configure;
use Cake\Mailer\Email;
use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\Network\Exception\InternalErrorException ;
use Exception ;

/**
 * you can configure the default email profile inside your app config file
 *
 */
class EmailComponent extends Component
{
    public $emailer;

    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->emailer = new Email('default');
    }

    /**
     * Sends email in envelop
     *
     * @param string | ['email' => 'label'] $from Identifies source of email.
     * @param string|array $to Identifies recipients of email.
     * @param  string $body Email content.
     * @param string $template to use for email.
     * @param  string $layout.
     * @return void
     */
    public function sendEmailOnBehalf($from, $subject, $to, $body, $template = null, $layout = null){

        $this->configureProfile($from, $subject, $template, $layout);
        $sender = Configure::read('emailSender');
        $this->emailer->setSender($sender);

       $this->send($to, $body);
    }

    /**
     * Sends email without envelop
     *
     * @param string $from Identifies source of email.
     * @param string|array $to Identifies recipients of email.
     * @param  string $body Email content.
     * @param string $template to use for email.
     * @param  string $layout.
     * @return void
     */
    public function sendEmail($from, $subject, $to, $body, $template = null, $layout = null){
        $this->configureProfile($from, $subject, $template, $layout);
        $this->send($to, $body);
    }

    public function sendPasswordResetRequest($from, $wepApp, $email, $url){

        $message = __d("Wrsft\Email", "Click link below to rest password \n\r {0}", $url);
        $this->sendEmail($from, __d("Wrsft\Email", "Your password reset request from {0}", $wepApp), $email, $message);
    }

    protected function configureProfile($from, $subject, $template, $layout){
        $this->emailer->setProfile(['from' => $from]);

        if(isset($template) && !empty($template)){
            $this->emailer->setTempplate($template);
        }

        if(isset($layout) && !empty($layout)){
            $this->emailer->setLayout($layout);
        }

        $this->emailer->setSubject($subject);
    }

    protected function Send($to, $body){

        if(is_array($to)){
            foreach ($to as $dest){
                $this->emailer->setTo($dest);
                $this->emailer->send($body);
            }
        }
        else{
            $this->emailer->setTo($to);
            $this->emailer->send($body);
        }
    }

}