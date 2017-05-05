
    <?php

        $this->assign('title', 'Login  to vHealings') ;



        $view_data =  '<h2 class="margin-bottom-30">Forgot Password</h2>
                        <form action="#">
                <div class="login-block">
                    <div class="input-group margin-bottom-20">
                        <span class="input-group-addon rounded-left"><i class="icon-user color-green"></i></span>
                        <input type="email" class="form-control rounded-right" placeholder="User" style="display: none">
                        <input type="email" class="form-control rounded-right" placeholder="Enter your email">
                    </div>

                   

                    <div class="row margin-bottom-70">
                        <div class="col-md-12">
                            <button type="submit" class="btn-u btn-u btn-block rounded">Send Email</button>
                        </div>
                    </div>
                </div>
            </form>';

     echo $this->element('accounts', ['view_data' => $view_data]);



