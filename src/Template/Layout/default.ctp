<?php
/**
 * Copyright (c) Worosoft. (http://worosoft.com)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Worosoft.com. (http://worosoft.com)
 */

$cakeDescription = 'Vegan Healings for all your natural vegan healings information and events';
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?= $this->Html->meta(
        'keywords',
        'vegan, healings, natural, World, Africa, energy, positive'
    );
    ?>
    <meta name="description" content="<?= $cakeDescription ?>">
    <meta name="author" content="Vhealings">



    <?= $this->Html->meta('icon') ?>
    <!-- Bootstrap core CSS -->
    <?= $this->Html->css('/vendor/bootstrap/css/bootstrap.min.css') ?>

    <!-- Custom fonts for this theme -->
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Raleway:400,100,200,300,600,500,700,800,900' rel='stylesheet' type='text/css'>

    <!-- Plugin CSS -->
    <?= $this->Html->css('/vendor/font-awesome/css/font-awesome.min.css') ?>

    <?= $this->Html->css('/vendor/owl-carousel/assets/owl.carousel.css') ?>
    <?= $this->Html->css('/vendor/owl-carousel/assets/owl.theme.css') ?>
    <?= $this->Html->css('/vendor/owl-carousel/owl.transitions.css') ?>

    <?= $this->Html->css('/vendor/magnific-popup/magnific-popup.css') ?>
    <?= $this->Html->css('/vendor/animate.css/animate.min.css') ?>
    <?= $this->Html->css('/device-mockups/device-mockups.min.css') ?>

    <?= $this->Html->css('vitality-green.css') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>

    <!-- Temporary navbar container fix -->
    <style>
        .navbar-toggler {
            z-index: 1;
        }

        @media (max-width: 576px) {
            nav > .container {
                width: 100%;
            }
        }
    </style>

</head>

<body id="page-top">

<!-- Navigation -->
<nav class="navbar fixed-top navbar-toggleable-md navbar-inverse navbar-expanded" id="mainNav">
    <div class="container">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            Menu <i class="fa fa-bars"></i>
        </button>
        <a class="navbar-brand page-scroll" href="#page-top">
            <!-- <img class="img-fluid" src="img/agency/logo.svg" alt="">-->
            <?= $this->Html->image('agency/logo.svg', ["class" => "img-fluid"] ) ?>
        </a>

        <div class="collapse navbar-collapse " id="headerNavbarResponsive">
        <?php if (isset($submenues)): ?>
            <ul class="navbar-nav ml-auto">
        <?php else: ?>
            <ul class="navbar-nav offset-md-2">
        <?php endif; ?>
                <li class="nav-item">
                    <a class="nav-link <?php echo (!isset($mainActive) || strtolower($mainActive) === "home")?  "main-active" : ""  ?>" href="#home">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo (isset($mainActive) && strtolower($mainActive) === "events")?  "main-active" : ""  ?> " href="#events">Event</a>
                </li>
                <!--<li class="nav-item">
                    <a class="nav-link < ?php echo (isset($mainActive) && strtolower($mainActive) === "boutique")?  "main-active" : ""  ?> " href="#boutique">Store</a>
                </li> -->
            </ul>
        </div>

        <?php if (isset($submenues)): ?>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <?php foreach ($submenues as $val => $display): ?>
                <li class="nav-item">
                    <a class="nav-link page-scroll" href="#<?= $val ?>"><?= $display ?></a>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <?php endif; ?>
    </div>
</nav>

<?= $this->Flash->render() ?>

 <?= $this->fetch('content') ?>
<!-- //'/vendor/owl-carousel/owl.carousel', -->
<!-- Plugin JavaScript -->


<?php if ($this->fetch('jquery')): ?>
    <?= $this->fetch('jquery') ?>
<?php else: ?>
    <?= $this->Html->script('/vendor/jquery/jquery_3_2_1.min') ?>
<?php endif ?>


<?= $this->Html->script([
    '/vendor/tether/tether.min',
    '/vendor/bootstrap/js/bootstrap.min',
    '/vendor/jquery.easing/jquery.easing.min',

    '/vendor/magnific-popup/jquery.magnific-popup.min',
    '/vendor/vide/jquery.vide.min',
    '/vendor/mixitup/mixitup.min',
    '/vendor/wowjs/wow.min' ])
?>
<!-- Contact form JavaScript -->
<?= $this->Html->script([
    'contact_me',
    'jqBootstrapValidation' ])
?>

<!-- Custom scripts for this theme -->
<?= $this->Html->script([
    'vitality' ])
?>

<?= $this->fetch('scriptBottom') ?>
<!-- build:remove:dist -->

<script>
    // Analytics Tracking - DEMO ONLY!
    /*(function(i, s, o, g, r, a, m) {
        i['GoogleAnalyticsObject'] = r;
        i[r] = i[r] || function() {
                (i[r].q = i[r].q || []).push(arguments)
            }, i[r].l = 1 * new Date();
        a = s.createElement(o),
            m = s.getElementsByTagName(o)[0];
        a.async = 1;
        a.src = g;
        m.parentNode.insertBefore(a, m)
    })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');
    ga('create', 'UA-38417733-23', 'auto');
    ga('send', 'pageview');*/
</script>


</body>

</html>
