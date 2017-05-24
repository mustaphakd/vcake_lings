
    <?php

        $this->assign('title', 'Reset vHealings password') ;



        $view_data =  '<h2 class="margin-bottom-30">Reset your password</h2>
                        <form action="#">
                <div class="login-block">

                    <div class="input-group margin-bottom-20">
                        <span class="input-group-addon rounded-left"><i class="icon-lock color-green"></i></span>
                        <input type="password" class="form-control rounded-right" placeholder="Password" style="display: none">
                        <input type="password" class="form-control rounded-right" placeholder="Enter new password">
                    </div>
                    
                    <div class="input-group margin-bottom-20">
                        <span class="input-group-addon rounded-left"><i class="icon-lock color-green"></i></span>
                        <input type="password" class="form-control rounded-right" placeholder="Password" style="display: none">
                        <input type="password" class="form-control rounded-right" placeholder="Re-enter new password">
                    </div>                   

                    <div class="row margin-bottom-70">
                        <div class="col-md-12">
                            <button type="submit" class="btn-u btn-u btn-block rounded">Reset Password</button>
                        </div>
                    </div>
                    
                </div>
            </form>';

     echo $this->element('accounts', ['view_data' => $view_data]);



