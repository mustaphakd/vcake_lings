
    <?php

        $this->assign('title', 'Login  to vHealings') ;



        $view_data =  '<h2 class="margin-bottom-30">Login To Your Account</h2>
                        <form action="#">
                <div class="login-block">
                    <div class="input-group margin-bottom-20">
                        <span class="input-group-addon rounded-left"><i class="icon-user color-green"></i></span>
                        <input type="text" class="form-control rounded-right" placeholder="User" style="display: none">
                        <input type="text" class="form-control rounded-right" placeholder="Username">
                    </div>

                    <div class="input-group margin-bottom-20">
                        <span class="input-group-addon rounded-left"><i class="icon-lock color-green"></i></span>
                        <input type="password" class="form-control rounded-right" placeholder="Password" style="display: none">
                        <input type="password" class="form-control rounded-right" placeholder="Password">
                    </div>

                    <div class="checkbox">
                        <ul class="list-inline">
                            <li>
                                <label>
                                    <input type="checkbox"> Remember me
                                </label>
                            </li>

                            <li class="pull-right">
                                <a href="#">Forgot password?</a>
                            </li>
                        </ul>
                    </div>

                    <div class="row margin-bottom-70">
                        <div class="col-md-12">
                            <button type="submit" class="btn-u btn-u btn-block rounded">Sign In</button>
                        </div>
                    </div>

                    <div class="social-login text-center">
                        <div class="or rounded-x">
                            <p>Don\'t have an account? <a href="page_registration2.html">Create New</a></p>
                        </div>
                    </div>
                </div>
            </form>';

     echo $this->element('accounts', ['view_data' => $view_data]);



