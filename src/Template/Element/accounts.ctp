
<?php $this->assign('title', 'Login  to vHealings') ?>


<?= $this->Html->css(
    '//fonts.googleapis.com/css?family=Open+Sans:400,300,700&amp;subset=cyrillic,latin',
    ['block' => true]) ?>

<?= $this->Html->css('/vendor/bootstrap/css/bootstrap_v2.min.css', ['block' => true]) ?>
<?= $this->Html->css('accounts/style.css', ['block' => true]) ?>

<!-- CSS Implementing Plugins
<link rel="stylesheet" href="assets/plugins/animate.css">-->

<?= $this->Html->css('accounts/line-icons.css', ['block' => true]) ?>
<?= $this->Html->css('brand-buttons.css', ['block' => true]) ?>

<!-- CSS Page Style -->
<?= $this->Html->css('accounts/page_log_reg_v4.css', ['block' => true]) ?>

<!-- CSS Theme -->
<?= $this->Html->css('accounts/blue.css', ['block' => true]) ?>

<?php
$this->Html->scriptStart(['block' => true]);
echo '
            window.vhealings = window.vhealings || 
            {exitVitalityEarly: true};
        ';

$this->Html->scriptEnd();
?>


<!--=== Content Part ===-->
<div class="container-fluid">
    <div class="row equal-height-columns">
        <div class="col-md-6 col-sm-6 hidden-xs image-block equal-height-column"></div>

        <div class="col-md-6 col-sm-6 form-block equal-height-column">
            <a href="<?= \Cake\Routing\Router::url(['controller' => 'home', 'action' => 'index', 'prefix' => false])?>">
                <?= $this->Html->image('accounts/logo1-blue.png', ['alt' => ' ']) ?>
            </a>
            <h2 class="margin-bottom-30">Login To Your Account</h2>
            <form action="#">
                <div class="login-block">
                    <div class="input-group margin-bottom-20">
                        <span class="input-group-addon rounded-left"><i class="icon-user color-blue"></i></span>
                        <input type="text" class="form-control rounded-right" placeholder="User" style="display: none">
                        <input type="text" class="form-control rounded-right" placeholder="Username">
                    </div>

                    <div class="input-group margin-bottom-20">
                        <span class="input-group-addon rounded-left"><i class="icon-lock color-blue"></i></span>
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
                            <button type="submit" class="btn-u btn-u-blue btn-block rounded">Sign In</button>
                        </div>
                    </div>

                    <div class="social-login text-center">
                        <div class="or rounded-x">
                            <p>Don't have an account? <a href="page_registration2.html">Create New</a></p>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div><!--/container-->
<!--=== End Content Part ===-->
<?= $this->fetch('content') ?>
<!--=== Sticky Footer ===-->
<div class="container sticky-footer">
    <ul class="list-unstyled list-inline social-links margin-bottom-20">
        <li><a href="#"><i class="icon-custom icon rounded-x icon-bg-blue fa fa-facebook"></i></a></li>
        <li><a href="#"><i class="icon-custom icon rounded-x icon-bg-blue fa fa-twitter"></i></a></li>
        <li><a href="#"><i class="icon-custom icon rounded-x icon-bg-blue fa fa-google-plus"></i></a></li>
    </ul>
    <p class="copyright-space">
        <?= date("Y") ?> &copy; All Rights Reserved. vHealings by <a href="#">worosoft.com</a>
    </p>
</div>
<!--=== End Sticky Footer ===-->

<!-- JS Global Compulsory -->
<?= $this->Html->script('/vendor/jquery/jquery_1_11_3.min', ['block' => 'jquery']) ?>

<!-- JS Implementing Plugins -->

<?= $this->Html->script([
    'back-to-top',
    '/vendor/backstretch/jquery.backstretchv2_1_15.min',
    'accounts/app.js'
],
    ['block' => "scriptBottom", "defer" => false])
?>

<?php $this->Html->scriptStart(['block' => 'scriptBottom', 'defer' => true]);
echo 'jQuery(document).ready(function() {
        App.init();
    });
    $(".image-block").backstretch([
        "' . $this->Url->image('accounts/img11.jpg') .'",
        "' . $this->Url->image('accounts/img5.jpg') .'",
    ], {
        fade: 1000,
        duration: 7000
    });';
$this->Html->scriptEnd();
?>
