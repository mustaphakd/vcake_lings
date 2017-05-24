
    <?php

        $this->assign('title', 'Login  to vHealings') ;

        $msg = isset($message)? $message : '';


        $view_data =  '<h2 class="margin-bottom-30">Message</h2>
                        <form action="#">
                <div class="login-block">  '.
            $msg
                    .'<div class="social-login text-center">
                        <div class="or rounded-x">
                        </div>
                    </div>
                </div>
            </form>';

     echo $this->element('accounts', ['view_data' => $view_data]);



