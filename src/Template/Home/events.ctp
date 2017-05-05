
<?php

$this->set(
    'submenues',
    [
        'page-top' => "Home",
        "schedule" => "Schedule",
        "about" => "About",
        "guests" => "Guests",
        "gallery" => "Gallery",
        "posts" => "Latest Posts",
        "pricing" => "Pricing",
        "contact" => "Contact"
    ]);

$this->set('mainActive', "events");

?>

    <!-- Web Fonts -->
    <?= $this->Html->css('//fonts.googleapis.com/css?family=Open+Sans:400,300,600,700', ['block' => true]) ?>

    <!-- CSS Global Compulsory -->
    <?= $this->Html->css('/vendor/bootstrap/css/bootstrap_v2.min.css', ['block' => true]) ?>
    <?= $this->Html->css('app.css', ['block' => true]) ?>
    <?= $this->Html->css('blocks.css', ['block' => true]) ?>
    <?= $this->Html->css('one.style.css', ['block' => true]) ?>


    <!-- CSS Implementing Plugins -->
    <?= $this->Html->css('/vendor/animate.css/animate.css', ['block' => true]) ?>
    <?= $this->Html->css('/vendor/line-icons/line-icons.css', ['block' => true]) ?>
    <?= $this->Html->css('/vendor/owl-carousel/assets/owl.carousel.css') ?>
    <?= $this->Html->css('/vendor/slick/slick.css', ['block' => true]) ?>
    <?= $this->Html->css('/vendor/fancybox/jquery.fancybox.css', ['block' => true]) ?>

    <!-- CSS Theme -->
    <?= $this->Html->css('event.style.css', ['block' => true]) ?>

    <?php
        $this->Html->scriptStart(['block' => true]);
        echo '
            window.vhealings = window.vhealings || 
            {exitVitalityEarly: true};
        ';

        $this->Html->scriptEnd();
    ?>

<div class="wrapper">

    <!-- Promo Section -->
    <section class="promo-block">
        <div class="g-container--sm g-pt-150 g-pb-250">
            <!-- Countdown -->
            <div class="clearfix">
                <div id="defaultCountdown"></div>
            </div>
            <!-- End Countdown -->
            <div class="text-center g-pt-70 g-pb-70">
                <h1 class="promo-block-title g-color-white">UI &amp; UX Design 2017</h1>
            </div>

            <div class="row g-mb-20">
                <div class="col-sm-4 g-md-mb-30">
                    <div class="media">
                        <div class="media-left">
                            <span class="promo-block-media-icon fa fa-calendar g-mr-10"></span>
                        </div>
                        <div class="media-body">
                            <span class="text-uppercase promo-block-media-subtitle">When</span>
                            <h2 class="text-uppercase promo-block-media-title">18:30, 12 Jul, 2017</h2>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 g-md-mb-30">
                    <div class="media">
                        <div class="media-left">
                            <span class="promo-block-media-icon fa fa-map-marker g-mr-10"></span>
                        </div>
                        <div class="media-body">
                            <span class="text-uppercase promo-block-media-subtitle">Where</span>
                            <h2 class="text-uppercase promo-block-media-title">Concert Hall, Los Angeles, USA</h2>
                        </div>
                    </div>
                </div>

                <div class="col-sm-2 page-scroll">
                    <a class="btn-u btn-u--white btn-u-md btn-u-upper" href="#pricing">Register Now</a>
                </div>
            </div>
        </div>
    </section>
    <!-- /Promo Section -->

    <!-- Ablut Slick Slider -->
    <div class="container g-position-o about-slider">
        <div class="row row-no-space slick-v1-wrap">
            <div class="col-md-6 g-position-r">
                <div class="slick-v1">
                    <div class="item slick-v1__img g-height-50vh" style="background-image: url(<?= $this->Url->image('slider/img3.jpg', ['fullBase' => true]) ?>)">
                        <!-- <img class="img-responsive full-width equal-height-column" src="assets/img-temp/slider/img3.jpg" alt="Image"> -->
                    </div>
                    <div class="item slick-v1__img g-height-50vh" style="background-image: url(<?= $this->Url->image('slider/img2.jpg', ['fullBase' => true]) ?>)">
                        <!-- <img class="img-responsive full-width equal-height-column" src="assets/img-temp/slider/img2.jpg" alt="Image"> -->
                    </div>
                </div>
            </div>
            <div class="col-md-6 slick-v1-info-bg g-height-50vh">
                <div class="slick-v1-info g-block-middle">
                    <h2 class="g-color-default g-mb-10">About The Event</h2>
                    <span class="text-uppercase g-dp-block g-color-white g-mb-20">Fusce pretium augue quis sem consectetur</span>
                    <div class="slick-v1-text">
                        <p>Sed feugiat porttitor nunc, non dignissim ipsum vestibulum in. Donec in blandit dolor. Vivamus a fringilla lorem, vel faucibus ante.</p>
                        <p>Nunc ullamcorper, justo a iaculis elementum, enim orci viverra eros, fringilla porttitor lorem eros vel odio. In rutrum tellus vitae blandit lacinia. Phasellus eget sapien odio. Phasellus eget sapien odio. Vivamus at risus quis leo tincidunt. </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Ablut Slick Slider -->

    <!-- Schedule -->
    <section id="schedule" class="container g-pt-100 g-pb-100">
        <!-- Heading -->
        <div class="text-center g-mb-70">
            <div class="g-mb-30">
                <h2>Event <span class="ver-divider ver-divider-dark"></span> <span class="g-color-default">Schedule</span></h2>
            </div>
            <p class="g-page-title">Nam sed erat aliquet libero aliquet commodo. Donec euismod augue non quam finibus, nec iaculis tellus gravida. Integer <br> efficitur eros ut dui laoreet, ut blandit turpis tincidunt.</p>
        </div>
        <!-- End Heading -->

        <!-- Tab -->
        <div class="tab-v7">
            <!-- Nav tabs -->
            <ul class="tab-v7-nav" role="tablist">
                <li role="presentation" class="active"><a href="#day1" aria-controls="day1" role="tab" data-toggle="tab">Day 1</a></li>
                <li role="presentation"><a href="#day2" aria-controls="day2" role="tab" data-toggle="tab">Day 2</a></li>
                <li role="presentation"><a href="#day3" aria-controls="day3" role="tab" data-toggle="tab">Day 3</a></li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active fade in" id="day1">
                    <!-- Event List -->
                    <ul class="event-schedule">
                        <!-- Event List Item -->
                        <li class="clearfix g-pb-50">
                            <a href="#" class="event-schedule-item">
                                <div class="event-schedule-center-wrap">
                                    <div class="event-schedule-info event-schedule-center">
                                        <span class="event-schedule-info-data">15:30 - 17:30</span>
                                    </div>
                                    <div class="event-schedule-media-wrap event-schedule-center">
                                        <div class="event-schedule-media">
                                            <?= $this->Html->image('schedule/img1.jpg', ['fullBase' => true, 'class' => 'event-schedule-media-img', 'alt' => 'image']) ?>
                                        </div>
                                    </div>
                                    <div class="event-schedule-body event-schedule-center">
                                        <span class="event-schedule-media-subtitle">Intro to UI/UX Design</span>
                                        <h3 class="event-schedule-media-title">John Doe, Dribbble</h3>
                                        <p class="event-schedule-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum ut scelerisque odio, a viverra arcu. Nulla ut suscipit velit, non dictum quam. Proin hendrerit vulputate mauris a imperdiet</p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <!-- Event List Item -->
                        <li class="clearfix g-pb-50">
                            <a href="#" class="event-schedule-item">
                                <div class="event-schedule-center-wrap">
                                    <div class="event-schedule-info event-schedule-center">
                                        <span class="event-schedule-info-data">17:45 - 18:45</span>
                                    </div>
                                    <div class="event-schedule-media-wrap event-schedule-center">
                                        <div class="event-schedule-media">
                                            <?= $this->Html->image('schedule/img2.jpg', ['fullBase' => true, 'class' => 'event-schedule-media-img', 'alt' => 'image']) ?>
                                        </div>
                                    </div>
                                    <div class="event-schedule-body event-schedule-center">
                                        <span class="event-schedule-media-subtitle">Design Trands of 2017</span>
                                        <h3 class="event-schedule-media-title">Kate Watson, Airbnb</h3>
                                        <p class="event-schedule-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum ut scelerisque odio, a viverra arcu. Nulla ut suscipit velit, non dictum quam. Proin hendrerit vulputate mauris a imperdiet</p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <!-- Event List Item -->
                        <li class="clearfix g-pb-50">
                            <a href="#" class="event-schedule-item">
                                <div class="event-schedule-center-wrap">
                                    <div class="event-schedule-info event-schedule-center">
                                        <span class="event-schedule-info-data">19:00 - 21:00</span>
                                    </div>
                                    <div class="event-schedule-media-wrap event-schedule-center">
                                        <div class="event-schedule-media">
                                            <?= $this->Html->image('schedule/img3.jpg', ['fullBase' => true, 'class' => 'event-schedule-media-img', 'alt' => 'image']) ?>
                                        </div>
                                    </div>
                                    <div class="event-schedule-body event-schedule-center">
                                        <span class="event-schedule-media-subtitle">Digital Marketing</span>
                                        <h3 class="event-schedule-media-title">Sara Woodman, Google</h3>
                                        <p class="event-schedule-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum ut scelerisque odio, a viverra arcu. Nulla ut suscipit velit, non dictum quam. Proin hendrerit vulputate mauris a imperdiet</p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <!-- Event List Item -->
                        <li class="clearfix">
                            <a href="#" class="event-schedule-item">
                                <div class="event-schedule-center-wrap">
                                    <div class="event-schedule-info event-schedule-center">
                                        <span class="event-schedule-info-data">21:15 - 22:00</span>
                                    </div>
                                    <div class="event-schedule-media-wrap event-schedule-center">
                                        <div class="event-schedule-media">
                                            <?= $this->Html->image('schedule/img4.jpg', ['fullBase' => true, 'class' => 'event-schedule-media-img', 'alt' => 'image']) ?>
                                        </div>
                                    </div>
                                    <div class="event-schedule-body event-schedule-center">
                                        <span class="event-schedule-media-subtitle">Photoshop vs Sketch</span>
                                        <h3 class="event-schedule-media-title">Mark Rayman, Invision</h3>
                                        <p class="event-schedule-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum ut scelerisque odio, a viverra arcu. Nulla ut suscipit velit, non dictum quam. Proin hendrerit vulputate mauris a imperdiet</p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <!-- End Event List Item -->
                    </ul>
                    <!-- End Event List -->
                </div>

                <div role="tabpanel" class="tab-pane fade" id="day2">
                    <!-- Event List -->
                    <ul class="event-schedule">
                        <li class="clearfix g-pb-50">
                            <a href="#" class="event-schedule-item">
                                <div class="event-schedule-center-wrap">
                                    <div class="event-schedule-info event-schedule-center">
                                        <span class="event-schedule-info-data">17:45 - 18:45</span>
                                    </div>
                                    <div class="event-schedule-media-wrap event-schedule-center">
                                        <div class="event-schedule-media">
                                            <?= $this->Html->image('schedule/img2.jpg', ['fullBase' => true, 'class' => 'event-schedule-media-img', 'alt' => 'image']) ?>
                                        </div>
                                    </div>
                                    <div class="event-schedule-body event-schedule-center">
                                        <span class="event-schedule-media-subtitle">Photoshop vs Sketch</span>
                                        <h3 class="event-schedule-media-title">Mark Rayman, Invision</h3>
                                        <p class="event-schedule-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum ut scelerisque odio, a viverra arcu. Nulla ut suscipit velit, non dictum quam. Proin hendrerit vulputate mauris a imperdiet</p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <!-- Event List Item -->
                        <li class="clearfix g-pb-50">
                            <a href="#" class="event-schedule-item">
                                <div class="event-schedule-center-wrap">
                                    <div class="event-schedule-info event-schedule-center">
                                        <span class="event-schedule-info-data">19:00 - 21:00</span>
                                    </div>
                                    <div class="event-schedule-media-wrap event-schedule-center">
                                        <div class="event-schedule-media">
                                            <?= $this->Html->image('schedule/img3.jpg', ['fullBase' => true, 'class' => 'event-schedule-media-img', 'alt' => 'image']) ?>
                                        </div>
                                    </div>
                                    <div class="event-schedule-body event-schedule-center">
                                        <span class="event-schedule-media-subtitle">Digital Marketing</span>
                                        <h3 class="event-schedule-media-title">Sara Woodman, Google</h3>
                                        <p class="event-schedule-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum ut scelerisque odio, a viverra arcu. Nulla ut suscipit velit, non dictum quam. Proin hendrerit vulputate mauris a imperdiet</p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <!-- Event List Item -->
                        <li class="clearfix g-pb-50">
                            <a href="#" class="event-schedule-item">
                                <div class="event-schedule-center-wrap">
                                    <div class="event-schedule-info event-schedule-center">
                                        <span class="event-schedule-info-data">15:30 - 17:30</span>
                                    </div>
                                    <div class="event-schedule-media-wrap event-schedule-center">
                                        <div class="event-schedule-media">
                                            <?= $this->Html->image('schedule/img1.jpg', ['fullBase' => true, 'class' => 'event-schedule-media-img', 'alt' => 'image']) ?>
                                        </div>
                                    </div>
                                    <div class="event-schedule-body event-schedule-center">
                                        <span class="event-schedule-media-subtitle">Intro to UI/UX Design</span>
                                        <h3 class="event-schedule-media-title">John Doe, Dribbble</h3>
                                        <p class="event-schedule-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum ut scelerisque odio, a viverra arcu. Nulla ut suscipit velit, non dictum quam. Proin hendrerit vulputate mauris a imperdiet</p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <!-- Event List Item -->
                        <!-- Event List Item -->
                        <li class="clearfix">
                            <a href="#" class="event-schedule-item">
                                <div class="event-schedule-center-wrap">
                                    <div class="event-schedule-info event-schedule-center">
                                        <span class="event-schedule-info-data">21:15 - 22:00</span>
                                    </div>
                                    <div class="event-schedule-media-wrap event-schedule-center">
                                        <div class="event-schedule-media">
                                            <?= $this->Html->image('schedule/img4.jpg', ['fullBase' => true, 'class' => 'event-schedule-media-img', 'alt' => 'image']) ?>
                                        </div>
                                    </div>
                                    <div class="event-schedule-body event-schedule-center">
                                        <span class="event-schedule-media-subtitle">Design Trands of 2017</span>
                                        <h3 class="event-schedule-media-title">Kate Watson, Airbnb</h3>
                                        <p class="event-schedule-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum ut scelerisque odio, a viverra arcu. Nulla ut suscipit velit, non dictum quam. Proin hendrerit vulputate mauris a imperdiet</p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <!-- End Event List Item -->
                    </ul>
                    <!-- End Event List -->
                </div>

                <div role="tabpanel" class="tab-pane fade" id="day3">
                    <!-- Event List -->
                    <ul class="event-schedule">
                        <!-- Event List Item -->
                        <li class="clearfix g-pb-50">
                            <a href="#" class="event-schedule-item">
                                <div class="event-schedule-center-wrap">
                                    <div class="event-schedule-info event-schedule-center">
                                        <span class="event-schedule-info-data">21:15 - 22:00</span>
                                    </div>
                                    <div class="event-schedule-media-wrap event-schedule-center">
                                        <div class="event-schedule-media">
                                            <?= $this->Html->image('schedule/img4.jpg', ['fullBase' => true, 'class' => 'event-schedule-media-img', 'alt' => 'image']) ?>
                                        </div>
                                    </div>
                                    <div class="event-schedule-body event-schedule-center">
                                        <span class="event-schedule-media-subtitle">Pop and Indie</span>
                                        <h3 class="event-schedule-media-title">The elly and friends</h3>
                                        <p class="event-schedule-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum ut scelerisque odio, a viverra arcu. Nulla ut suscipit velit, non dictum quam. Proin hendrerit vulputate mauris a imperdiet</p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <!-- Event List Item -->
                        <li class="clearfix g-pb-50">
                            <a href="#" class="event-schedule-item">
                                <div class="event-schedule-center-wrap">
                                    <div class="event-schedule-info event-schedule-center">
                                        <span class="event-schedule-info-data">15:30 - 17:30</span>
                                    </div>
                                    <div class="event-schedule-media-wrap event-schedule-center">
                                        <div class="event-schedule-media">
                                            <?= $this->Html->image('schedule/img1.jpg', ['fullBase' => true, 'class' => 'event-schedule-media-img', 'alt' => 'image']) ?>
                                        </div>
                                    </div>
                                    <div class="event-schedule-body event-schedule-center">
                                        <span class="event-schedule-media-subtitle">Rock and Roll</span>
                                        <h3 class="event-schedule-media-title">Metamorphoses band</h3>
                                        <p class="event-schedule-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum ut scelerisque odio, a viverra arcu. Nulla ut suscipit velit, non dictum quam. Proin hendrerit vulputate mauris a imperdiet</p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <!-- Event List Item -->
                        <li class="clearfix g-pb-50">
                            <a href="#" class="event-schedule-item">
                                <div class="event-schedule-center-wrap">
                                    <div class="event-schedule-info event-schedule-center">
                                        <span class="event-schedule-info-data">17:45 - 18:45</span>
                                    </div>
                                    <div class="event-schedule-media-wrap event-schedule-center">
                                        <div class="event-schedule-media">
                                            <?= $this->Html->image('schedule/img2.jpg', ['fullBase' => true, 'class' => 'event-schedule-media-img', 'alt' => 'image']) ?>
                                        </div>
                                    </div>
                                    <div class="event-schedule-body event-schedule-center">
                                        <span class="event-schedule-media-subtitle">Alternative, Rock and Roll</span>
                                        <h3 class="event-schedule-media-title">Amber Smith band</h3>
                                        <p class="event-schedule-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum ut scelerisque odio, a viverra arcu. Nulla ut suscipit velit, non dictum quam. Proin hendrerit vulputate mauris a imperdiet</p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <!-- Event List Item -->
                        <li class="clearfix">
                            <a href="#" class="event-schedule-item">
                                <div class="event-schedule-center-wrap">
                                    <div class="event-schedule-info event-schedule-center">
                                        <span class="event-schedule-info-data">19:00 - 21:00</span>
                                    </div>
                                    <div class="event-schedule-media-wrap event-schedule-center">
                                        <div class="event-schedule-media">
                                            <?= $this->Html->image('schedule/img3.jpg', ['fullBase' => true, 'class' => 'event-schedule-media-img', 'alt' => 'image']) ?>
                                        </div>
                                    </div>
                                    <div class="event-schedule-body event-schedule-center">
                                        <span class="event-schedule-media-subtitle">Rock</span>
                                        <h3 class="event-schedule-media-title">Green day</h3>
                                        <p class="event-schedule-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum ut scelerisque odio, a viverra arcu. Nulla ut suscipit velit, non dictum quam. Proin hendrerit vulputate mauris a imperdiet</p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <!-- End Event List Item -->
                    </ul>
                    <!-- End Event List -->
                </div>
            </div>
        </div>
        <!-- End Tab -->
    </section>
    <!-- End Schedule -->

    <!-- Video -->
    <section id="about" class="promo-block-v2">
        <div class="container g-pt-100 g-pb-100">
            <!-- Heading -->
            <div class="text-center g-mb-70">
                <div class="g-mb-30">
                    <h2 class="g-color-white">Promo <span class="ver-divider ver-divider-white"></span> <span class="g-color-default">Video</span></h2>
                </div>
                <p class="g-color-white--dark g-page-title">Nam sed erat aliquet libero aliquet commodo. Donec euismod augue non quam finibus, nec iaculis tellus gravida. Integer<br>efficitur eros ut dui laoreet, ut blandit turpis tincidunt.</p>
            </div>
            <!-- End Heading -->

            <!-- 16:9 aspect ratio -->
            <div class="embed-responsive embed-responsive-16by9 event-video-effect">
                <iframe class="embed-responsive-item" src="https://player.vimeo.com/video/167434033"></iframe>
            </div>
        </div>
        <!-- End Video -->
    </section>
    <!-- End Video -->

    <!-- Upcoming Events -->
    <section id="guests" class="g-pt-100 g-pb-100">
        <!-- Heading -->
        <div class="container text-center g-mb-70">
            <div class="g-mb-30">
                <h2>Upcoming <span class="ver-divider ver-divider-dark"></span> <span class="g-color-default">Events</span></h2>
            </div>
            <p class="g-page-title">Nam sed erat aliquet libero aliquet commodo. Donec euismod augue non quam finibus, nec iaculis tellus gravida. Integer<br>efficitur eros ut dui laoreet, ut blandit turpis tincidunt.</p>
        </div>
        <!-- End Heading -->

        <!-- Slick v2 -->
        <div class="slick-v2 g-mb-50">
            <div class="item">
                <article>
                    <?= $this->Html->image('slider/img1.jpg', ['fullBase' => true, 'class' => 'img-responsive', 'alt' => 'image']) ?>
                    <div class="slick-v2-info">
                        <div class="g-mb-20">
                            <h4 class="slick-v2-title">UX/UI Design</h4>
                            <span class="slick-v2-subtitle">Budapest, Hungry</span>
                        </div>
                        <div class="g-mb-20">
                            <p class="slick-v2-text">Ut augue diam, lacinia fringilla erat eu, vehicula commodo quam. Aliquam eget accumsan ligula. Maecenas sit amet consectetur lectus. Suspendisse commodo et magna non pulvinar.</p>
                        </div>
                        <ul class="list-inline event-icon-wrap">
                            <li><a href="#" class="event-icon"><span class="fa fa-twitter"></span></a></li>
                            <li><a href="#" class="event-icon"><span class="fa fa-pinterest"></span></a></li>
                            <li><a href="#" class="event-icon"><span class="fa fa-facebook"></span></a></li>
                            <li><a href="#" class="event-icon"><span class="fa fa-linkedin"></span></a></li>
                        </ul>
                    </div>
                </article>
            </div>
            <div class="item">
                <article>
                    <?= $this->Html->image('slider/img2.jpg', ['fullBase' => true, 'class' => 'img-responsive', 'alt' => 'image']) ?>
                    <div class="slick-v2-info">
                        <div class="g-mb-20">
                            <h4 class="slick-v2-title">Design Trands</h4>
                            <span class="slick-v2-subtitle">East Bay, California, U.S.</span>
                        </div>
                        <div class="g-mb-20">
                            <p class="slick-v2-text">Ut augue diam, lacinia fringilla erat eu, vehicula commodo quam. Aliquam eget accumsan ligula. Maecenas sit amet consectetur lectus. Suspendisse commodo et magna non pulvinar.</p>
                        </div>
                        <ul class="list-inline event-icon-wrap">
                            <li><a href="#" class="event-icon"><span class="fa fa-twitter"></span></a></li>
                            <li><a href="#" class="event-icon"><span class="fa fa-pinterest"></span></a></li>
                            <li><a href="#" class="event-icon"><span class="fa fa-facebook"></span></a></li>
                            <li><a href="#" class="event-icon"><span class="fa fa-linkedin"></span></a></li>
                        </ul>
                    </div>
                </article>
            </div>
            <div class="item">
                <article>
                    <?= $this->Html->image('slider/img3.jpg', ['fullBase' => true, 'class' => 'img-responsive', 'alt' => 'image']) ?>
                    <div class="slick-v2-info">
                        <div class="g-mb-20">
                            <h4 class="slick-v2-title">Digital Marketing</h4>
                            <span class="slick-v2-subtitle">Paris, France</span>
                        </div>
                        <div class="g-mb-20">
                            <p class="slick-v2-text">Ut augue diam, lacinia fringilla erat eu, vehicula commodo quam. Aliquam eget accumsan ligula. Maecenas sit amet consectetur lectus. Suspendisse commodo et magna non pulvinar.</p>
                        </div>
                        <ul class="list-inline event-icon-wrap">
                            <li><a href="#" class="event-icon"><span class="fa fa-twitter"></span></a></li>
                            <li><a href="#" class="event-icon"><span class="fa fa-pinterest"></span></a></li>
                            <li><a href="#" class="event-icon"><span class="fa fa-facebook"></span></a></li>
                            <li><a href="#" class="event-icon"><span class="fa fa-linkedin"></span></a></li>
                        </ul>
                    </div>
                </article>
            </div>
            <div class="item">
                <article>
                    <?= $this->Html->image('slider/img1.jpg', ['fullBase' => true, 'class' => 'img-responsive', 'alt' => 'image']) ?>
                    <div class="slick-v2-info">
                        <div class="g-mb-20">
                            <h4 class="slick-v2-title">Photoshop vs Sketch</h4>
                            <span class="slick-v2-subtitle">London, UK</span>
                        </div>
                        <div class="g-mb-20">
                            <p class="slick-v2-text">Ut augue diam, lacinia fringilla erat eu, vehicula commodo quam. Aliquam eget accumsan ligula. Maecenas sit amet consectetur lectus. Suspendisse commodo et magna non pulvinar.</p>
                        </div>
                        <ul class="list-inline event-icon-wrap">
                            <li><a href="#" class="event-icon"><span class="fa fa-twitter"></span></a></li>
                            <li><a href="#" class="event-icon"><span class="fa fa-pinterest"></span></a></li>
                            <li><a href="#" class="event-icon"><span class="fa fa-facebook"></span></a></li>
                            <li><a href="#" class="event-icon"><span class="fa fa-linkedin"></span></a></li>
                        </ul>
                    </div>
                </article>
            </div>
            <div class="item">
                <article>
                    <?= $this->Html->image('slider/img2.jpg', ['fullBase' => true, 'class' => 'img-responsive', 'alt' => 'image']) ?>
                    <div class="slick-v2-info">
                        <div class="g-mb-20">
                            <h4 class="slick-v2-title">Startups</h4>
                            <span class="slick-v2-subtitle">Budapest, Hungry</span>
                        </div>
                        <div class="g-mb-20">
                            <p class="slick-v2-text">Ut augue diam, lacinia fringilla erat eu, vehicula commodo quam. Aliquam eget accumsan ligula. Maecenas sit amet consectetur lectus. Suspendisse commodo et magna non pulvinar.</p>
                        </div>
                        <ul class="list-inline event-icon-wrap">
                            <li><a href="#" class="event-icon"><span class="fa fa-twitter"></span></a></li>
                            <li><a href="#" class="event-icon"><span class="fa fa-pinterest"></span></a></li>
                            <li><a href="#" class="event-icon"><span class="fa fa-facebook"></span></a></li>
                            <li><a href="#" class="event-icon"><span class="fa fa-linkedin"></span></a></li>
                        </ul>
                    </div>
                </article>
            </div>
            <div class="item">
                <article>
                    <?= $this->Html->image('slider/img3.jpg', ['fullBase' => true, 'class' => 'img-responsive', 'alt' => 'image']) ?>
                    <div class="slick-v2-info">
                        <div class="g-mb-20">
                            <h4 class="slick-v2-title">Future Of Web Design</h4>
                            <span class="slick-v2-subtitle">London, UK</span>
                        </div>
                        <div class="g-mb-20">
                            <p class="slick-v2-text">Ut augue diam, lacinia fringilla erat eu, vehicula commodo quam. Aliquam eget accumsan ligula. Maecenas sit amet consectetur lectus. Suspendisse commodo et magna non pulvinar.</p>
                        </div>
                        <ul class="list-inline event-icon-wrap">
                            <li><a href="#" class="event-icon"><span class="fa fa-twitter"></span></a></li>
                            <li><a href="#" class="event-icon"><span class="fa fa-pinterest"></span></a></li>
                            <li><a href="#" class="event-icon"><span class="fa fa-facebook"></span></a></li>
                            <li><a href="#" class="event-icon"><span class="fa fa-linkedin"></span></a></li>
                        </ul>
                    </div>
                </article>
            </div>
        </div>
        <!-- End Slick v2 -->
    </section>
    <!-- End Upcoming Events -->

    <!-- Gallery -->
    <section id="gallery" class="promo-block-v3">
        <div class="container g-pt-100 g-pb-100">
            <!-- Heading -->
            <div class="text-center g-mb-70">
                <div class="g-mb-30">
                    <h2 class="g-color-white">Festival <span class="ver-divider ver-divider-white"></span> <span class="g-color-default">Gallery</span></h2>
                </div>
                <p class="g-color-white--dark g-page-title">Nam sed erat aliquet libero aliquet commodo. Donec euismod augue non quam finibus, nec iaculis tellus gravida. Integer<br>efficitur eros ut dui laoreet, ut blandit turpis tincidunt.</p>
            </div>
            <!-- End Heading -->

            <div class="g-position-r">
                <!-- Owl Carousel v1 -->
                <div class="owl2-carousel-v1">
                    <!-- Gallery -->
                    <div class="item">
                        <a class="fancybox gallery__item" href=" <?= $this->Url->image('gallery/img1-lg.jpg', ['fullBase' => true]) ?>" rel="gallery" title="Image 1">
                            <?= $this->Html->image('gallery/img1.jpg', ['fullBase' => true, 'class' => 'img-responsive gallery__item-img', 'alt' => '']) ?>
                        </a>
                        <a class="fancybox gallery__item" href="<?= $this->Url->image('gallery/img2-lg.jpg', ['fullBase' => true]) ?>" rel="gallery" title="Image 2">
                            <?= $this->Html->image('gallery/img2.jpg', ['fullBase' => true, 'class' => 'img-responsive gallery__item-img', 'alt' => '']) ?>
                        </a>
                    </div>
                    <div class="item">
                        <a class="fancybox gallery__item" href="<?= $this->Url->image('gallery/img3-lg.jpg', ['fullBase' => true]) ?>" rel="gallery" title="Image 3">
                            <?= $this->Html->image('gallery/img3.jpg', ['fullBase' => true, 'class' => 'img-responsive gallery__item-img', 'alt' => '']) ?>
                        </a>
                        <a class="fancybox gallery__item" href=" <?= $this->Url->image('gallery/img4-lg.jpg') ?>" rel="gallery" title="Image 4">
                            <?= $this->Html->image('gallery/img4.jpg', ['fullBase' => true, 'class' => 'img-responsive gallery__item-img', 'alt' => '']) ?>
                        </a>
                    </div>

                    <div class="item">
                        <a class="fancybox gallery__item" href=" <?= $this->Url->image('gallery/img1-lg.jpg', ['fullBase' => true]) ?>" rel="gallery" title="Image 1">
                            <?= $this->Html->image('gallery/img1.jpg', ['fullBase' => true, 'class' => 'img-responsive gallery__item-img', 'alt' => '']) ?>
                        </a>
                        <a class="fancybox gallery__item" href=" <?= $this->Url->image('gallery/img2-lg.jpg', ['fullBase' => true]) ?>" rel="gallery" title="Image 2">
                            <?= $this->Html->image('gallery/img2.jpg', ['fullBase' => true, 'class' => 'img-responsive gallery__item-img', 'alt' => '']) ?>
                        </a>
                    </div>
                    <div class="item">
                        <a class="fancybox gallery__item" href=" <?= $this->Url->image('gallery/img3-lg.jpg', ['fullBase' => true]) ?>" rel="gallery" title="Image 3">
                            <?= $this->Html->image('gallery/img3.jpg', ['fullBase' => true, 'class' => 'img-responsive gallery__item-img', 'alt' => '']) ?>
                        </a>
                        <a class="fancybox gallery__item" href=" <?= $this->Url->image('gallery/img4-lg.jpg', ['fullBase' => true]) ?>" rel="gallery" title="Image 4">
                            <?= $this->Html->image('gallery/img4.jpg', ['fullBase' => true, 'class' => 'img-responsive gallery__item-img', 'alt' => '']) ?>
                        </a>
                    </div>
                    <div class="item">
                        <a class="fancybox gallery__item" href=" <?= $this->Url->image('gallery/img1-lg.jpg', ['fullBase' => true]) ?>" rel="gallery" title="Image 1">
                            <?= $this->Html->image('gallery/img1.jpg', ['fullBase' => true, 'class' => 'img-responsive gallery__item-img', 'alt' => '']) ?>
                        </a>
                        <a class="fancybox gallery__item" href=" <?= $this->Url->image('gallery/img2-lg.jpg', ['fullBase' => true]) ?>" rel="gallery" title="Image 2">
                            <?= $this->Html->image('gallery/img2.jpg', ['fullBase' => true, 'class' => 'img-responsive gallery__item-img', 'alt' => '']) ?>
                        </a>
                    </div>
                    <div class="item">
                        <a class="fancybox gallery__item" href=" <?= $this->Url->image('gallery/img3-lg.jpg', ['fullBase' => true]) ?>" rel="gallery" title="Image 3">
                            <?= $this->Html->image('gallery/img3.jpg', ['fullBase' => true, 'class' => 'img-responsive gallery__item-img', 'alt' => '']) ?>
                        </a>
                        <a class="fancybox gallery__item" href=" <?= $this->Url->image('gallery/img4-lg.jpg', ['fullBase' => true]) ?>" rel="gallery" title="Image 4">
                            <?= $this->Html->image('gallery/img4.jpg', ['fullBase' => true, 'class' => 'img-responsive gallery__item-img', 'alt' => '']) ?>
                        </a>
                    </div>
                    <div class="item">
                        <a class="fancybox gallery__item" href=" <?= $this->Url->image('gallery/img1-lg.jpg', ['fullBase' => true]) ?>" rel="gallery" title="Image 1">
                            <?= $this->Html->image('gallery/img1.jpg', ['fullBase' => true, 'class' => 'img-responsive gallery__item-img', 'alt' => '']) ?>
                        </a>
                        <a class="fancybox gallery__item" href=" <?= $this->Url->image('gallery/img2-lg.jpg', ['fullBase' => true]) ?>" rel="gallery" title="Image 2">
                            <?= $this->Html->image('gallery/img2.jpg', ['fullBase' => true, 'class' => 'img-responsive gallery__item-img', 'alt' => '']) ?>
                        </a>
                    </div>
                    <div class="item">
                        <a class="fancybox gallery__item" href=" <?= $this->Url->image('gallery/img3-lg.jpg', ['fullBase' => true]) ?>" rel="gallery" title="Image 3">
                            <?= $this->Html->image('gallery/img3.jpg', ['fullBase' => true, 'class' => 'img-responsive gallery__item-img', 'alt' => '']) ?>
                        </a>
                        <a class="fancybox gallery__item" href=" <?= $this->Url->image('gallery/img4-lg.jpg', ['fullBase' => true]) ?>" rel="gallery" title="Image 4">
                            <?= $this->Html->image('gallery/img4.jpg', ['fullBase' => true, 'class' => 'img-responsive gallery__item-img', 'alt' => '']) ?>
                        </a>
                    </div>
                </div>
                <!-- End Owl Carousel v1 -->

                <!-- Owl Carousel v1 Nav -->
                <div class="owl2-carousel-v1-nav">
                    <span class="owl2-carousel-v1-arrow owl2-carousel-v1-next"></span>
                    <span class="owl2-carousel-v1-arrow owl2-carousel-v1-prev"></span>
                </div>
                <!-- End Owl Carousel v1 Nav -->
            </div>
        </div>
    </section>
    <!-- End Gallery -->

    <!-- Posts -->
    <section id="posts" class="g-bg-color-gray g-overflow-h">
        <div class="container g-pt-100 g-pb-100">
            <!-- Heading -->
            <div class="text-center g-mb-70">
                <div class="g-mb-30">
                    <h2>Latest <span class="ver-divider ver-divider-dark"></span> <span class="g-color-default">Posts</span></h2>
                </div>
                <p class="g-page-title">Nam sed erat aliquet libero aliquet commodo. Donec euismod augue non quam finibus, nec iaculis tellus gravida. Integer<br>efficitur eros ut dui laoreet, ut blandit turpis tincidunt.</p>
            </div>
            <!-- End Heading -->

            <!-- Masonry Grid -->
            <div id="js__masonry" class="row">
                <div id="js__masonry-sizer" class="col-xs-6 col-sm-6 col-md-1"></div>
                <!-- Masonry Grid -->
                <div class="js__masonry-item col-xs-mbl-12 col-xs-6 col-md-4 g-mb-30">
                    <article class="blog">
                        <?= $this->Html->image('blog/img1.jpg', ['fullBase' => true, 'class' => 'img-responsive ', 'alt' => 'Image']) ?>
                        <div class="blog-content">
                            <div class="g-mb-30">
                                <small class="blog-date">April 25, 2015</small>
                                <h3 class="blog-title"><a href="#">Mauris tellus magna, pretium</a></h3>
                                <p class="blog-text">Sed feugiat porttitor nunc, non dignissim ipsum  vestibulum in. Donec in blandit dolor. Vivamus a fringilla lorem, vel.</p>
                            </div>
                            <div class="clearfix blog-publisher">
                                <div class="blog-publisher-media">
                                    <?= $this->Html->image('blog/img7.jpg', ['fullBase' => true, 'class' => 'blog-publisher-img', 'alt' => 'Image']) ?>
                                </div>
                                <div class="blog-publisher-body">
                                    <span class="blog-publisher-name">by Dorian Gray</span>
                                </div>
                            </div>
                        </div>
                    </article>
                </div>
                <!-- Masonry Grid -->
                <div class="js__masonry-item col-xs-mbl-12 col-xs-6 col-md-4 g-mb-30">
                    <article class="blog">
                        <?= $this->Html->image('blog/img2.jpg', ['fullBase' => true, 'class' => 'img-responsive ', 'alt' => 'Image']) ?>
                        <div class="blog-content">
                            <div class="g-mb-30">
                                <small class="blog-date">April 25, 2015</small>
                                <h3 class="blog-title"><a href="#">Sed arcu erat, facilisis at tortor vel, blandit tristique enim</a></h3>
                                <p class="blog-text">Sed feugiat porttitor nunc, non dignissim ipsum  vestibulum in. Donec in blandit dolor. Vivamus a fringilla lorem, vel.</p>
                            </div>
                            <div class="clearfix blog-publisher">
                                <div class="blog-publisher-media">
                                    <?= $this->Html->image('blog/img8.jpg', ['fullBase' => true, 'class' => 'blog-publisher-img', 'alt' => 'Image']) ?>
                                </div>
                                <div class="blog-publisher-body">
                                    <span class="blog-publisher-name">by Dorian Gray</span>
                                </div>
                            </div>
                        </div>
                    </article>
                </div>
                <!-- Masonry Grid -->
                <div class="js__masonry-item col-xs-mbl-12 col-xs-6 col-md-4 g-mb-30">
                    <article class="blog">
                        <?= $this->Html->image('blog/img3.jpg', ['fullBase' => true, 'class' => 'img-responsive ', 'alt' => 'Image']) ?>
                        <div class="blog-content">
                            <div class="g-mb-30">
                                <small class="blog-date">April 25, 2015</small>
                                <h3 class="blog-title"><a href="#">Donec euismod augue non quam finibus nec iaculis tellus gravida</a></h3>
                                <p class="blog-text">Sed feugiat porttitor nunc, non dignissim ipsum  vestibulum in. Donec in blandit dolor. Vivamus a fringilla lorem, vel.</p>
                            </div>
                            <div class="clearfix blog-publisher">
                                <div class="blog-publisher-media">
                                    <?= $this->Html->image('blog/img1.jpg', ['fullBase' => true, 'class' => 'blog-publisher-img', 'alt' => 'Image']) ?>
                                </div>
                                <div class="blog-publisher-body">
                                    <span class="blog-publisher-name">by Dorian Gray</span>
                                </div>
                            </div>
                        </div>
                    </article>
                </div>
                <!-- Masonry Grid -->
                <div class="js__masonry-item col-xs-mbl-12 col-xs-6 col-md-4 g-mb-30">
                    <article class="blog">
                        <?= $this->Html->image('blog/img4.jpg', ['fullBase' => true, 'class' => 'img-responsive ', 'alt' => 'Image']) ?>
                        <div class="blog-content">
                            <div class="g-mb-30">
                                <small class="blog-date">April 25, 2015</small>
                                <h3 class="blog-title"><a href="#">Cras consequat nibh a viverra tempor</a></h3>
                                <p class="blog-text">Sed feugiat porttitor nunc, non dignissim ipsum  vestibulum in. Donec in blandit dolor. Vivamus a fringilla lorem, vel.</p>
                            </div>
                            <div class="clearfix blog-publisher">
                                <div class="blog-publisher-media">
                                    <?= $this->Html->image('blog/img8.jpg', ['fullBase' => true, 'class' => 'blog-publisher-img', 'alt' => 'Image']) ?>
                                </div>
                                <div class="blog-publisher-body">
                                    <span class="blog-publisher-name">by Dorian Gray</span>
                                </div>
                            </div>
                        </div>
                    </article>
                </div>
                <!-- Masonry Grid -->
                <div class="js__masonry-item col-xs-mbl-12 col-xs-6 col-md-4 g-mb-30">
                    <article class="blog">
                        <?= $this->Html->image('blog/img5.jpg', ['fullBase' => true, 'class' => 'img-responsive ', 'alt' => 'Image']) ?>
                        <div class="blog-content">
                            <div class="g-mb-30">
                                <small class="blog-date">April 25, 2015</small>
                                <h3 class="blog-title"><a href="#">Fusce nulla neque, luctus ac magna sit amet, sollicitudin blandit</a></h3>
                                <p class="blog-text">Sed feugiat porttitor nunc, non dignissim ipsum  vestibulum in. Donec in blandit dolor. Vivamus a fringilla lorem, vel.</p>
                            </div>
                            <div class="clearfix blog-publisher">
                                <div class="blog-publisher-media">
                                    <?= $this->Html->image('blog/img9.jpg', ['fullBase' => true, 'class' => 'blog-publisher-img', 'alt' => 'Image']) ?>
                                </div>
                                <div class="blog-publisher-body">
                                    <span class="blog-publisher-name">by Dorian Gray</span>
                                </div>
                            </div>
                        </div>
                    </article>
                </div>
                <!-- Masonry Grid -->
                <div class="js__masonry-item col-xs-mbl-12 col-xs-6 col-md-4 g-mb-30">
                    <article class="blog">
                        <?= $this->Html->image('blog/img6.jpg', ['fullBase' => true, 'class' => 'img-responsive ', 'alt' => 'Image']) ?>
                        <div class="blog-content">
                            <div class="g-mb-30">
                                <small class="blog-date">April 25, 2015</small>
                                <h3 class="blog-title"><a href="#">Sed consequat tristique metus</a></h3>
                                <p class="blog-text">Sed feugiat porttitor nunc, non dignissim ipsum  vestibulum in. Donec in blandit dolor. Vivamus a fringilla lorem, vel.</p>
                            </div>
                            <div class="clearfix blog-publisher">
                                <div class="blog-publisher-media">
                                    <?= $this->Html->image('blog/img7.jpg', ['fullBase' => true, 'class' => 'blog-publisher-img', 'alt' => 'Image']) ?>
                                </div>
                                <div class="blog-publisher-body">
                                    <span class="blog-publisher-name">by Dorian Gray</span>
                                </div>
                            </div>
                        </div>
                    </article>
                </div>
                <!-- End Masonry Grid -->
            </div>
        </div>
        <!-- End Masonry Grid -->
    </section>
    <!-- End Posts -->

    <!-- Pricing -->
    <section id="pricing" class="container g-pt-100 g-pb-100">
        <!-- Heading -->
        <div class="text-center g-mb-70">
            <div class="g-mb-30">
                <h2>Pricing <span class="ver-divider ver-divider-dark"></span> <span class="g-color-default">Registration</span></h2>
            </div>
            <p class="g-page-title">Nam sed erat aliquet libero aliquet commodo. Donec euismod augue non quam finibus, nec iaculis tellus gravida. Integer<br>efficitur eros ut dui laoreet, ut blandit turpis tincidunt.</p>
        </div>
        <!-- End Heading -->

        <div class="row g-mb-100">
            <div class="col-md-7 col-md-push-5 g-md-mb-60">
                <form>
                    <!-- Pricing -->
                    <label class="pricing__lable">
                        <input class="pricing__input" type="radio" name="radio-box">
                        <div class="pricing g-mb-20">
                            <div class="pricing-head">
                                <h4 class="pricing-head-tag">$10.00</h4>
                                <small class="pricing-head-subtitle">per person</small>
                            </div>
                            <div class="pricing-info">
                                <h4 class="pricing-info-title">Basic Pass</h4>
                                <p class="pricing-info-text">Sed arcu erat, facilisis at tortor vel, blandit tristique enim. Donec dapibus neque consectetur tellus pretium, eget lacinia velit ullamcorper.</p>
                            </div>
                        </div>
                    </label>
                    <!-- End Pricing -->

                    <!-- Pricing -->
                    <label class="pricing__lable">
                        <input class="pricing__input" type="radio" name="radio-box" checked>
                        <div class="pricing g-mb-20">
                            <div class="pricing-head">
                                <h4 class="pricing-head-tag">$50.00</h4>
                                <small class="pricing-head-subtitle">per person</small>
                            </div>
                            <div class="pricing-info">
                                <h4 class="pricing-info-title">Advanced Pass</h4>
                                <p class="pricing-info-text">Sed arcu erat, facilisis at tortor vel, blandit tristique enim. Donec dapibus neque consectetur tellus pretium, eget lacinia velit ullamcorper.</p>
                            </div>
                        </div>
                    </label>
                    <!-- End Pricing -->

                    <!-- Pricing -->
                    <label class="pricing__lable">
                        <input class="pricing__input" type="radio" name="radio-box">
                        <div class="pricing">
                            <div class="pricing-head">
                                <h4 class="pricing-head-tag">$99.00</h4>
                                <small class="pricing-head-subtitle">per person</small>
                            </div>
                            <div class="pricing-info">
                                <h4 class="pricing-info-title">Full Pass</h4>
                                <p class="pricing-info-text">Sed arcu erat, facilisis at tortor vel, blandit tristique enim. Donec dapibus neque consectetur tellus pretium, eget lacinia velit ullamcorper.</p>
                            </div>
                        </div>
                    </label>
                    <!-- End Pricing -->
                </form>
            </div>
            <div class="col-md-5 col-md-pull-7">
                <!-- Register Input -->
                <form action="#" method="post">
                    <input class="form-control reg-input g-mb-20" type="text" name="firstname" id="firstname" placeholder="First name">
                    <input class="form-control reg-input g-mb-20" type="text" name="lastname" id="lastname" placeholder="Last name">
                    <input class="form-control reg-input g-mb-20" type="text" name="email" id="email" placeholder="Email">
                    <input class="form-control reg-input g-mb-20" type="text" name="address" id="address" placeholder="Address">
                    <textarea class="form-control reg-input g-mb-20" name="message" id="message" rows="6" placeholder="Your plan: Advanced pass"></textarea>
                    <button type="submit" class="btn-block btn-u btn-u--dark btn-u-md btn-u-upper">Register Now</button>
                </form>
                <!-- End Register Input -->
            </div>
        </div>

        <!-- Clients -->
        <div class="slick-v3">
            <div class="item">
                <div class="clients">
                    <?= $this->Html->image('clients/img1.png', ['fullBase' => true, 'class' => 'clients-logo ', 'alt' => 'Logo']) ?>
                </div>
            </div>
            <div class="item">
                <div class="clients">
                    <?= $this->Html->image('clients/img2.png', ['fullBase' => true, 'class' => 'clients-logo ', 'alt' => 'Logo']) ?>
                </div>
            </div>
            <div class="item">
                <div class="clients">
                    <?= $this->Html->image('clients/img3.png', ['fullBase' => true, 'class' => 'clients-logo ', 'alt' => 'Logo']) ?>
                </div>
            </div>
            <div class="item">
                <div class="clients">
                    <?= $this->Html->image('clients/img4.png', ['fullBase' => true, 'class' => 'clients-logo ', 'alt' => 'Logo']) ?>
                </div>
            </div>
            <div class="item">
                <div class="clients">
                    <?= $this->Html->image('clients/img5.png', ['fullBase' => true, 'class' => 'clients-logo ', 'alt' => 'Logo']) ?>
                </div>
            </div>
            <div class="item">
                <div class="clients">
                    <?= $this->Html->image('clients/img6.png', ['fullBase' => true, 'class' => 'clients-logo client-logo-defaul ', 'alt' => 'Logo']) ?>
                </div>
            </div>
            <div class="item">
                <div class="clients">
                    <?= $this->Html->image('clients/img1.png', ['fullBase' => true, 'class' => 'clients-logo clients-logo-defaul ', 'alt' => 'Logo']) ?>
                </div>
            </div>
        </div>
        <!-- End Clients -->
    </section>
    <!-- End Pricing -->

    <!-- Contact -->
    <section id="contact">
        <div class="promo-block-v4">
            <div class="g-container--sm g-pt-100 g-pb-200">
                <!-- Address -->
                <div class="text-center g-mb-70">
                    <div class="g-mb-30">
                        <h2 class="g-color-white">Contact <span class="ver-divider ver-divider-white"></span> <span class="g-color-default">Information</span></h2>
                    </div>
                    <div class="g-mb-60">
                        <p class="g-color-white--dark g-page-title">Nam sed erat aliquet libero aliquet commodo. Donec euismod augue non quam finibus, nec iaculis tellus gravida. Integer efficitur eros ut dui laoreet, ut blandit turpis tincidunt.</p>
                    </div>
                    <div class="row">
                        <div class="col-sm-4 g-sm-mb-30">
                            <span class="text-uppercase g-color-white--dark">Email: <strong class="g-color-white">marketing@unify.com</strong></span>
                        </div>
                        <div class="col-sm-4 g-sm-mb-30">
                            <span class="text-uppercase g-color-white--dark">Phone number: <strong class="g-color-white">+48 555 2566 112</strong></span>
                        </div>
                        <div class="col-sm-4">
                            <span class="text-uppercase g-color-white--dark">Address: <strong class="g-color-white">In sed lectus</strong></span>
                        </div>
                    </div>
                </div>
                <!-- End Address -->
            </div>
        </div>

        <!-- Google Map -->
        <div class="container g-mto-200">
            <div class="g-position-o">
                <div id="map" class="contact-map"></div>

                <!-- Contact -->
                <div class="contact">
                    <div class="contact-body g-block-middle">
                        <form action="#" method="post">
                            <input class="form-control contact-input g-mb-20" type="text" name="name" id="name" placeholder="Your name">
                            <input class="form-control contact-input g-mb-20" type="text" name="email" id="email" placeholder="Your Email">
                            <textarea class="form-control contact-input g-mb-20" name="message" id="message" rows="6" placeholder="Message"></textarea>
                            <div class="text-right">
                                <button type="submit" class="btn-u btn-u-md btn-u-upper">Submit Message</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- End Contact -->
            </div>
        </div>
        <!-- End Google Map -->

        <!-- Subfooter -->
        <div class="container text-center g-pt-100 g-pb-40">
            <div class="g-mb-30 page-scroll">
                <a href="#body">
                    <?= $this->Html->image(
                        'agency/logo.svg',
                        [
                            'fullBase' => true,
                            'alt' => ' ',
                            'style' => [
                                'width: 116px;',
                                'height: 40px;',
                                'background-color: lightgreen;'
                            ]
                        ]) ?>
                </a>
            </div>
            <div class="g-mb-30">
                <p class="g-page-title">Integer accumsan maximus leo, et consectetur metus vestibulum in. Vestibulum viverra justo odio<br>maximus efficitur</p>
            </div>
            <ul class="list-inline event-icon-wrap">
                <li><a href="#" class="event-icon event-icon-default"><span class="fa fa-twitter"></span></a></li>
                <li><a href="#" class="event-icon event-icon-default"><span class="fa fa-pinterest"></span></a></li>
                <li><a href="#" class="event-icon event-icon-default"><span class="fa fa-facebook"></span></a></li>
                <li><a href="#" class="event-icon event-icon-default"><span class="fa fa-linkedin"></span></a></li>
            </ul>
        </div>
        <!-- End Subfooter -->
    </section>
    <!-- End Contact -->
</div><!--/wrapper-->

<!-- JS Global Compulsory
    < ?= $this->Html->script(['/vendor/jquery/jquery-migrate.min' ], ['block' => 'scriptBottom'])  ?>-->
<?= $this->Html->script('/vendor/jquery/jquery_1_11_3.min', ['block' => 'jquery']) ?>
<!-- JS Implementing Plugins -->
    <?= $this->Html->script([
        '/vendor/smoothscroll/smoothScroll',
        '/vendor/modernizr/modernizr',
        '/vendor/slick/slick.min',
        '/vendor/countdown2/jquery.plugin.min',
        '/vendor/countdown2/jquery.countdown.min',
        '/vendor/slick/slick.min',
        '/vendor/masonry/jquery.imagesloaded.pkgd.min',
        '/vendor/masonry/jquery.masonry.pkgd.min',
        '/vendor/owl-carousel/owl.carousel.min',
        '/vendor/fancybox/jquery.fancybox.pack'],
        ['block' => 'scriptBottom'])
    ?>

<!-- JS Page Level-->
    <?= $this->Html->script([
        'one.app',
        'plugins/coming_soon',
        'plugins/slick-v1',
        'plugins/slick-v2',
        'plugins/slick-v3',
        'plugins/masonry',
        'plugins/owl2-carousel-v1',
        'plugins/fancy-box',
        'plugins/gmaps-ini'],
        ['block' => "scriptBottom", "defer" => true])
        ?>


<?= $this->Html->script(
    '//maps.googleapis.com/maps/api/js?key=AIzaSyCDSb3wORiw36c9kGhpSVqjkTYtJpVp4l4&callback=initMap',
    ['block' => 'scriptBottom', 'defer' => true])
?>
<?php $this->Html->scriptStart(['block' => 'scriptBottom', 'defer' => true]);
    echo 'jQuery(document).ready(function() {
        App.init();
        PageComingSoon.initPageComingSoon();
        Owl2Carouselv1.initOwl2Carouselv1();
        FancyBox.initFancybox();
        Masonry.initMasonry();
    });';
$this->Html->scriptEnd();
?>
<!--[if lt IE 10]>
<script src="../assets/plugins/sky-forms-pro/skyforms/js/jquery.placeholder.min.js"></script>
