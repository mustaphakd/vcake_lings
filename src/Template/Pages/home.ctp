
<?php

$this->set(
    'submenues',
    [
        'about' => "About",
        "team" => "Team",
        "services" => "Process",
        "work" => "Work",
        "pricing" => "Pricing",
        "contact" => "Contact"]);
/*$this->submenues = [
    'about' => "About",
    "team" => "Team",
    "services" => "Process",
    "work" => "Work",
    "pricing" => "Pricing",
    "contact" => "Contact"];*/

$this->set('mainActive', "events");

?>
<!-- Masthead -->
<header class="masthead" style="background-image: url('img/agency/backgrounds/bg-header.jpg');">
    <div class="container h-100">
        <div class="row h-100">
            <div class="col-12 my-auto text-center text-white">
                <img class="masthead-img img-fluid mb-3" src="img/agency/profile.svg" alt="">
                <div class="masthead-title"><?= $this->fetch('title') ?></div>
                <hr class="colored">
                <div class="masthead-subtitle">by Start Bootstrap</div>
            </div>
        </div>
    </div>
    <div class="scroll-down">
        <a class="btn page-scroll" href="#about">
            <i class="fa fa-angle-down fa-fw"></i>
        </a>
    </div>
</header>

<!-- About Section -->
<section class="page-section" id="about">
    <div class="container-fluid">
        <div class="wow fadeIn text-center">
            <h1>A Theme for Creatives &amp; Agencies</h1>
            <p class="mb-0">Vitality is the perfect theme for a freelance professional or an agency.</p>
        </div>
        <hr class="colored">
        <div class="row text-center">
            <div class="col-lg-3 col-md-6">
                <div class="wow fadeIn px-4 pb-4 pb-lg-0 h-100" data-wow-delay=".2s">
                    <i class="fa fa-code fa-4x"></i>
                    <h3>Bootstrap 4</h3>
                    <p class="mb-0">Unleash the power and flexibility of the newly released Bootstrap 4 when you choose Vitality! One framework, every device.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="wow fadeIn px-4 pb-4 pb-lg-0 h-100" data-wow-delay=".4s">
                    <i class="fa fa-edit fa-4x"></i>
                    <h3>Easy to Edit</h3>
                    <p class="mb-0">Vitality is easy to edit and customize and includes SASS and LESS versions for deeper customization.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="wow fadeIn px-4 pb-4 pb-lg-0 h-100" data-wow-delay=".6s">
                    <i class="fa fa-tablet fa-4x"></i>
                    <h3>Responsive</h3>
                    <p class="mb-0">In today's world where devices come in every shape and size, Vitality will responsively adapt to look great on any screen!</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="wow fadeIn px-4 h-100" data-wow-delay=".8s">
                    <i class="fa fa-heart fa-4x"></i>
                    <h3>Built with Love</h3>
                    <p class="mb-0">All themes by Start Bootstrap are crafted with care. Thank you for choosing Vitality and being a customer!</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Team Section -->
<section class="page-section bg-faded" id="team">
    <div class="container text-center wow fadeIn">
        <h2>Our Team</h2>
        <p class="mb-0">We are a group of digital marketers with a passion for great art that serves a practical purpose.</p>
        <hr class="colored">
        <div class="team-carousel owl-carousel owl-theme mt-4">

            <!-- Team Carousel Item 1 -->
            <div class="item">
                <div class="overlay"></div>
                <img class="img-fluid" src="img/agency/team/1.jpg" alt="">
                <div class="team-caption">
                    <h3>Patricia West</h3>
                    <hr class="colored">
                    <p>Marketing Director</p>
                    <ul class="list-inline list-team-social">
                        <li class="list-inline-item">
                            <a href="#"><i class="fa fa-facebook fa-fw"></i></a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#"><i class="fa fa-twitter fa-fw"></i></a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#"><i class="fa fa-linkedin fa-fw"></i></a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Team Carousel Item 2 -->
            <div class="item">
                <div class="overlay"></div>
                <img class="img-fluid" src="img/agency/team/2.jpg" alt="">
                <div class="team-caption">
                    <h3>Howard Scott</h3>
                    <hr class="colored">
                    <p>Sales Manager</p>
                    <ul class="list-inline list-team-social">
                        <li class="list-inline-item">
                            <a href="#"><i class="fa fa-facebook fa-fw"></i></a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#"><i class="fa fa-twitter fa-fw"></i></a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#"><i class="fa fa-linkedin fa-fw"></i></a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Team Carousel Item 3 -->
            <div class="item">
                <div class="overlay"></div>
                <img class="img-fluid" src="img/agency/team/3.jpg" alt="">
                <div class="team-caption">
                    <h3>Kate Williams</h3>
                    <hr class="colored">
                    <p>Creative Director</p>
                    <ul class="list-inline list-team-social">
                        <li class="list-inline-item">
                            <a href="#"><i class="fa fa-facebook fa-fw"></i></a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#"><i class="fa fa-twitter fa-fw"></i></a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#"><i class="fa fa-linkedin fa-fw"></i></a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#"><i class="fa fa-dribbble fa-fw"></i></a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Team Carousel Item 4 -->
            <div class="item">
                <div class="overlay"></div>
                <img class="img-fluid" src="img/agency/team/4.jpg" alt="">
                <div class="team-caption">
                    <h3>Jeremy Davidson</h3>
                    <hr class="colored">
                    <p>Web Developer</p>
                    <ul class="list-inline list-team-social">
                        <li class="list-inline-item">
                            <a href="#"><i class="fa fa-facebook fa-fw"></i></a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#"><i class="fa fa-twitter fa-fw"></i></a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#"><i class="fa fa-linkedin fa-fw"></i></a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#"><i class="fa fa-github fa-fw"></i></a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Team Carousel Item 5 -->
            <div class="item">
                <div class="overlay"></div>
                <img class="img-fluid" src="img/agency/team/5.jpg" alt="">
                <div class="team-caption">
                    <h3>Amy Vanderbute</h3>
                    <hr class="colored">
                    <p>Graphic Artist</p>
                    <ul class="list-inline list-team-social">
                        <li class="list-inline-item">
                            <a href="#"><i class="fa fa-facebook fa-fw"></i></a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#"><i class="fa fa-twitter fa-fw"></i></a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#"><i class="fa fa-linkedin fa-fw"></i></a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#"><i class="fa fa-dribbble fa-fw"></i></a>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="call-to-action" style="background-image: url('img/agency/backgrounds/bg-quote.jpg');">
    <div class="container wow fadeIn">
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <span class="quote">Good <span class="text-primary">design</span> is finding that perfect balance between the way something <span class="text-primary">looks</span> and how it <span class="text-primary">functions</span>.</span>
                <hr class="colored">
                <a class="btn btn-primary page-scroll" href="#services">How We Work</a>
            </div>
        </div>
    </div>
</section>

<!-- Services Section -->
<section class="page-section services" id="services">
    <div class="container">
        <div class="text-center wow fadeIn">
            <h2>Our Process</h2>
            <hr class="colored">
            <p class="mb-0">Here is an overview of how we approach each new project.</p>
        </div>
        <div class="row mt-4">
            <!-- Service Item 1 -->
            <div class="col-lg-4 wow fadeIn" data-wow-delay=".2s">
                <div class="media">
                    <div class="pull-left">
                        <i class="fa fa-clipboard rounded-circle"></i>
                    </div>
                    <div class="media-body">
                        <h3 class="media-heading">Plan</h3>
                        <ul>
                            <li>Client interview</li>
                            <li>Gather consumer data</li>
                            <li>Create content strategy</li>
                            <li>Analyze research</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Service Item 2 -->
            <div class="col-lg-4 wow fadeIn" data-wow-delay=".4s">
                <div class="media">
                    <div class="pull-left">
                        <i class="fa fa-pencil rounded-circle"></i>
                    </div>
                    <div class="media-body">
                        <h3 class="media-heading">Create</h3>
                        <ul>
                            <li>Build wireframe</li>
                            <li>Gather client feedback</li>
                            <li>Code development</li>
                            <li>Marketing review</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Service Item 3 -->
            <div class="col-lg-4 wow fadeIn" data-wow-delay=".6s">
                <div class="media">
                    <div class="pull-left">
                        <i class="fa fa-rocket rounded-circle"></i>
                    </div>
                    <div class="media-body">
                        <h3 class="media-heading">Launch</h3>
                        <ul>
                            <li>Deploy website</li>
                            <li>Market product launch</li>
                            <li>Collect UX data</li>
                            <li>Quarterly maintenence</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Portfolio Carousel Heading -->
<section class="page-section bg-faded" id="work">
    <div class="container text-center wow fadeIn">
        <h2>Our Work</h2>
        <hr class="colored">
        <p>Here are some examples of our work.</p>
    </div>
</section>

<!-- Portfolio Carousel -->
<div class="portfolio-carousel wow fadeIn owl-carousel owl-theme">

    <!-- Portfolio Carousel Item 1 -->
    <div class="item" style="background-image: url('img/agency/portfolio/carousel/bg-1.jpg')">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-5 push-md-7">
                    <div class="project-details">
                        <span class="project-name">Project Name</span>
                        <span class="project-description">Branding, Website Design</span>
                        <hr class="colored">
                        <a href="#portfolioModal1" data-toggle="modal" class="btn btn-primary">View Details <i class="fa fa-long-arrow-right fa-fw"></i></a>
                    </div>
                </div>
                <div class="col-md-7 pull-md-5 hidden-xs">
                    <div class="device-container">
                        <div class="device-mockup macbook portrait black">
                            <div class="device">
                                <div class="screen">
                                    <img class="img-fluid" src="img/agency/portfolio/carousel/screen-1a.jpg" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Portfolio Carousel Item 2 -->
    <div class="item" style="background-image: url('img/agency/portfolio/carousel/bg-2.jpg')">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-5 push-md-7">
                    <div class="project-details">
                        <span class="project-name">Project Name</span>
                        <span class="project-description">Branding, Website Design</span>
                        <hr class="colored">
                        <a href="#portfolioModal2" data-toggle="modal" class="btn btn-primary">View Details <i class="fa fa-long-arrow-right fa-fw"></i></a>
                    </div>
                </div>
                <div class="col-md-7 pull-md-5 hidden-xs">
                    <div class="device-container">
                        <div class="device-mockup macbook portrait black">
                            <div class="device">
                                <div class="screen">
                                    <img class="img-fluid" src="img/agency/portfolio/carousel/screen-2a.jpg" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Portfolio Carousel Item 3 -->
    <div class="item" style="background-image: url('img/agency/portfolio/carousel/bg-3.jpg')">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-5 push-md-7">
                    <div class="project-details">
                        <span class="project-name">Project Name</span>
                        <span class="project-description">Branding, Website Design</span>
                        <hr class="colored">
                        <a href="#portfolioModal3" data-toggle="modal" class="btn btn-primary">View Details <i class="fa fa-long-arrow-right fa-fw"></i></a>
                    </div>
                </div>
                <div class="col-md-7 pull-md-5 hidden-xs">
                    <div class="device-container">
                        <div class="device-mockup macbook portrait black">
                            <div class="device">
                                <div class="screen">
                                    <img class="img-fluid" src="img/agency/portfolio/carousel/screen-3a.jpg" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Portfolio Carousel Item 4 -->
    <div class="item" style="background-image: url('img/agency/portfolio/carousel/bg-4.jpg')">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-5 push-md-7">
                    <div class="project-details">
                        <span class="project-name">Project Name</span>
                        <span class="project-description">Branding, Website Design</span>
                        <hr class="colored">
                        <a href="#portfolioModal4" data-toggle="modal" class="btn btn-primary">View Details <i class="fa fa-long-arrow-right fa-fw"></i></a>
                    </div>
                </div>
                <div class="col-md-7 pull-md-5 hidden-xs">
                    <div class="device-container">
                        <div class="device-mockup macbook portrait black">
                            <div class="device">
                                <div class="screen">
                                    <img class="img-fluid" src="img/agency/portfolio/carousel/screen-4.jpg" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Portfolio Grid Section -->
<section class="page-section">
    <div class="container text-center wow fadeIn">
        <h2>Portfolio</h2>
        <hr class="colored">
        <p>Here are some other projects that we've worked on.</p>
        <div class="controls mt-3">
            <button type="button" class="control btn btn-secondary btn-sm mx-2 mb-4" data-filter="all">All</button>
            <button type="button" class="control btn btn-secondary btn-sm mx-2 mb-4" data-filter=".identity">Identity</button>
            <button type="button" class="control btn btn-secondary btn-sm mx-2 mb-4" data-filter=".graphic">Graphic</button>
            <button type="button" class="control btn btn-secondary btn-sm mx-2 mb-4" data-filter=".web">Web</button>
        </div>
        <div class="portfolio-grid clearfix" id="portfolioList">
            <!-- Grid Item 1 -->
            <div class="mix identity" href="img/agency/portfolio/grid/grid-1.jpg" title="Client Name">
                <div class="portfolio-wrapper">
                    <img src="img/agency/portfolio/grid/grid-1.jpg" alt="">
                    <div class="caption">
                        <div class="caption-text">
                            <a class="text-title">Client Name</a>
                            <span class="text-category">Brand Identity</span>
                        </div>
                        <div class="caption-bg"></div>
                    </div>
                </div>
            </div>
            <!-- Grid Item 2 -->
            <div class="mix web" href="img/agency/portfolio/grid/grid-2.jpg" title="Client Name">
                <div class="portfolio-wrapper">
                    <img src="img/agency/portfolio/grid/grid-2.jpg" alt="">
                    <div class="caption">
                        <div class="caption-text">
                            <a class="text-title">Client Name</a>
                            <span class="text-category">Web Development</span>
                        </div>
                        <div class="caption-bg"></div>
                    </div>
                </div>
            </div>
            <!-- Grid Item 3 -->
            <div class="mix web" href="img/agency/portfolio/grid/grid-3.jpg" title="Client Name">
                <div class="portfolio-wrapper">
                    <img src="img/agency/portfolio/grid/grid-3.jpg" alt="">
                    <div class="caption">
                        <div class="caption-text">
                            <a class="text-title">Client Name</a>
                            <span class="text-category">Web Development</span>
                        </div>
                        <div class="caption-bg"></div>
                    </div>
                </div>
            </div>
            <!-- Grid Item 4 -->
            <div class="mix identity" href="img/agency/portfolio/grid/grid-4.jpg" title="Client Name">
                <div class="portfolio-wrapper">
                    <img src="img/agency/portfolio/grid/grid-4.jpg" alt="">
                    <div class="caption">
                        <div class="caption-text">
                            <a class="text-title">Client Name</a>
                            <span class="text-category">Brand Identity</span>
                        </div>
                        <div class="caption-bg"></div>
                    </div>
                </div>
            </div>
            <!-- Grid Item 5 -->
            <div class="mix web" href="img/agency/portfolio/grid/grid-5.jpg" title="Client Name">
                <div class="portfolio-wrapper">
                    <img src="img/agency/portfolio/grid/grid-5.jpg" alt="">
                    <div class="caption">
                        <div class="caption-text">
                            <a class="text-title">Client Name</a>
                            <span class="text-category">Web Development</span>
                        </div>
                        <div class="caption-bg"></div>
                    </div>
                </div>
            </div>
            <!-- Grid Item 6 -->
            <div class="mix graphic" href="img/agency/portfolio/grid/grid-6.jpg" title="Client Name">
                <div class="portfolio-wrapper">
                    <img src="img/agency/portfolio/grid/grid-6.jpg" alt="">
                    <div class="caption">
                        <div class="caption-text">
                            <a class="text-title">Client Name</a>
                            <span class="text-category">Graphic Design</span>
                        </div>
                        <div class="caption-bg"></div>
                    </div>
                </div>
            </div>
            <!-- Grid Item 7 -->
            <div class="mix graphic" href="img/agency/portfolio/grid/grid-7.jpg" title="Client Name">
                <div class="portfolio-wrapper">
                    <img src="img/agency/portfolio/grid/grid-7.jpg" alt="">
                    <div class="caption">
                        <div class="caption-text">
                            <a class="text-title">Client Name</a>
                            <span class="text-category">Graphic Design</span>
                        </div>
                        <div class="caption-bg"></div>
                    </div>
                </div>
            </div>
            <!-- Grid Item 8 -->
            <div class="mix web" href="img/agency/portfolio/grid/grid-8.jpg" title="Client Name">
                <div class="portfolio-wrapper">
                    <img src="img/agency/portfolio/grid/grid-8.jpg" alt="">
                    <div class="caption">
                        <div class="caption-text">
                            <a class="text-title">Client Name</a>
                            <span class="text-category">Web Development</span>
                        </div>
                        <div class="caption-bg"></div>
                    </div>
                </div>
            </div>
            <!-- Grid Item 9 -->
            <div class="mix identity" href="img/agency/portfolio/grid/grid-9.jpg" title="Client Name">
                <div class="portfolio-wrapper">
                    <img src="img/agency/portfolio/grid/grid-9.jpg" alt="">
                    <div class="caption">
                        <div class="caption-text">
                            <a class="text-title">Client Name</a>
                            <span class="text-category">Brand Identity</span>
                        </div>
                        <div class="caption-bg"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Testomonials Section -->
<section class="page-section testimonials bg-faded">
    <div class="container wow fadeIn">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="testimonials-carousel">
                    <!-- Testimonial Item 1 -->
                    <div class="item mb-4">
                        <p class="lead">"Working with Vitality was both a valuable and rewarding experience."</p>
                        <hr class="colored">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reprehenderit, temporibus, laborum, dignissimos doloremque corporis alias nostrum recusandae culpa id quisquam harum impedit sed sunt non obcaecati vero ipsam aut fugit?</p>
                        <div class="testimonial-img">
                            <img class="rounded-circle img-fluid" src="img/agency/testimonials/1.jpg" alt="">
                        </div>
                        <div class="testimonial-author">
                            <span class="name">Jim Walker</span>
                            <p class="small">CEO of Company Name</p>
                            <div class="stars">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                        </div>
                    </div>
                    <!-- Testimonial Item 2 -->
                    <div class="item mb-4">
                        <p class="lead">"Vitality is a well coded, well documented, and easy to use theme!"</p>
                        <hr class="colored">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem amet rem minus dolorum, facere in soluta explicabo, unde eveniet illo vel, nemo nostrum atque nesciunt facilis quaerat quasi reprehenderit dicta.</p>
                        <div class="testimonial-img">
                            <img class="rounded-circle img-fluid" src="img/agency/testimonials/2.jpg" alt="">
                        </div>
                        <div class="testimonial-author">
                            <span class="name">Ashley Creadle</span>
                            <p class="small">Creative Director of Company Name</p>
                            <div class="stars">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Pricing Section -->
<section class="page-section pricing" id="pricing" style="background-image: url('img/agency/backgrounds/bg-pricing.jpg')">
    <div class="container wow fadeIn">
        <div class="text-center">
            <h2>Pricing</h2>
            <hr class="colored">
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eum, quae, laborum, voluptate delectus odio doloremque error porro obcaecati nemo animi ducimus quaerat nostrum? Ab molestiae eaque et atque architecto reiciendis.</p>
        </div>
        <div class="row">
            <!-- Pricing Table 1 -->
            <div class="col-md-4">
                <div class="pricing-item featured-first">
                    <h3>Basic</h3>
                    <hr class="colored">
                    <div class="price"><span class="number"><sup>$</sup>25</span> / month</div>
                    <ul class="list-group mb-3">
                        <li class="list-group-item">60 Users</li>
                        <li class="list-group-item">Unlimited Forums</li>
                        <li class="list-group-item">Unlimited Reports</li>
                        <li class="list-group-item">3,000 Entries per Month</li>
                        <li class="list-group-item">200 MB Storage</li>
                        <li class="list-group-item">Unlimited Support</li>
                    </ul>
                    <a href="#" class="btn btn-secondary">Sign Up</a>
                </div>
            </div>
            <!-- Pricing Table 2 -->
            <div class="col-md-4">
                <div class="pricing-item featured">
                    <h3>Plus</h3>
                    <hr class="colored">
                    <div class="price"><span class="number"><sup>$</sup>50</span> / month</div>
                    <ul class="list-group mb-3">
                        <li class="list-group-item">60 Users</li>
                        <li class="list-group-item">Unlimited Forums</li>
                        <li class="list-group-item">Unlimited Reports</li>
                        <li class="list-group-item">3,000 Entries per Month</li>
                        <li class="list-group-item">200 MB Storage</li>
                        <li class="list-group-item">Unlimited Support</li>
                    </ul>
                    <a href="#" class="btn btn-secondary">Sign Up</a>
                </div>
            </div>
            <!-- Pricing Table 3 -->
            <div class="col-md-4">
                <div class="pricing-item featured-last">
                    <h3>Premium</h3>
                    <hr class="colored">
                    <div class="price"><span class="number"><sup>$</sup>150</span> / month</div>
                    <ul class="list-group mb-3">
                        <li class="list-group-item">60 Users</li>
                        <li class="list-group-item">Unlimited Forums</li>
                        <li class="list-group-item">Unlimited Reports</li>
                        <li class="list-group-item">3,000 Entries per Month</li>
                        <li class="list-group-item">200 MB Storage</li>
                        <li class="list-group-item">Unlimited Support</li>
                    </ul>
                    <a href="#" class="btn btn-secondary">Sign Up</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Newsletter Signup Call to Action -->
<section class="page-section signup-form bg-inverse text-white">
    <div class="container text-center">
        <h3 class="m0">Subscribe to our newsletter!</h3>
        <hr class="colored">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <!-- MailChimp Signup Form -->
                <div id="mc_embed_signup">
                    <!-- Replace the form action in the line below with your MailChimp embed action! Visit the documentation for additional instructions! -->
                    <form role="form" action="//startbootstrap.us3.list-manage.com/subscribe/post?u=531af730d8629808bd96cf489&amp;id=afb284632f" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" target="_blank" novalidate>
                        <div class="input-group input-group-lg">
                            <input type="email" name="EMAIL" class="form-control" id="mce-EMAIL" placeholder="Email address...">
                            <span class="input-group-btn">
                                    <button type="submit" name="subscribe" id="mc-embedded-subscribe" class="btn btn-primary">Subscribe!</button>
                                </span>
                        </div>
                        <div id="mce-responses">
                            <div class="response" id="mce-error-response" style="display:none"></div>
                            <div class="response" id="mce-success-response" style="display:none"></div>
                        </div>
                    </form>
                </div>
                <!-- End MailChimp Signup Form -->
            </div>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section class="page-section" id="contact">
    <div class="container wow fadeIn">
        <div class="text-center">
            <h2>Contact Us</h2>
            <hr class="colored">
            <p>Please tell us about your next project and we will let you know what we can do to help you.</p>
        </div>
        <div class="row mt-4">
            <div class="col-lg-8 offset-lg-2">
                <form name="sentMessage" id="contactForm" novalidate>
                    <div class="row control-group">
                        <div class="form-group col-12 floating-label-form-group controls">
                            <label>Name</label>
                            <input type="text" class="form-control" placeholder="Name" id="name" required data-validation-required-message="Please enter your name.">
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>
                    <div class="row control-group">
                        <div class="form-group col-12 floating-label-form-group controls">
                            <label>Email Address</label>
                            <input type="email" class="form-control" placeholder="Email Address" id="email" required data-validation-required-message="Please enter your email address.">
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>
                    <div class="row control-group">
                        <div class="form-group col-12 floating-label-form-group controls">
                            <label>Phone Number</label>
                            <input type="tel" class="form-control" placeholder="Phone Number" id="phone" required data-validation-required-message="Please enter your phone number.">
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>
                    <div class="row control-group">
                        <div class="form-group col-12 floating-label-form-group controls">
                            <label>Message</label>
                            <textarea rows="5" class="form-control" placeholder="Message" id="message" required data-validation-required-message="Please enter a message."></textarea>
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>
                    <br>
                    <div id="success"></div>
                    <div class="row">
                        <div class="form-group col-12">
                            <button type="submit" class="btn btn-secondary">Send</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Block Button Call to Action -->
<a class="btn btn-block btn-full-width" href="https://wrapbootstrap.com/theme/vitality-multipurpose-one-page-theme-WB02K3KK3">Buy Vitality Now!</a>

<!-- Footer -->
<footer class="footer" style="background-image: url('img/agency/backgrounds/bg-footer.jpg')">
    <div class="container text-center">
        <div class="row">
            <div class="col-md-4 footer-contact-details">
                <h4><i class="fa fa-phone"></i> Call</h4>
                <p>555-213-4567</p>
            </div>
            <div class="col-md-4 footer-contact-details">
                <h4><i class="fa fa-map-marker"></i> Visit</h4>
                <p>3481 Melrose Place
                    <br>Beverly Hills, CA 90210</p>
            </div>
            <div class="col-md-4 footer-contact-details">
                <h4><i class="fa fa-envelope"></i> Email</h4>
                <p><a href="mailto:mail@example.com">mail@example.com</a>
                </p>
            </div>
        </div>
        <div class="row footer-social">
            <div class="col-lg-12">
                <ul class="list-inline">
                    <li class="list-inline-item">
                        <a href="#"><i class="fa fa-facebook fa-fw fa-2x"></i></a>
                    </li>
                    <li class="list-inline-item">
                        <a href="#"><i class="fa fa-twitter fa-fw fa-2x"></i></a>
                    </li>
                    <li class="list-inline-item">
                        <a href="#"><i class="fa fa-linkedin fa-fw fa-2x"></i></a>
                    </li>
                </ul>
            </div>
        </div>
        <p class="copyright">&copy; 2017 Start Bootstrap Themes</p>
    </div>
</footer>

<!-- Portfolio Modals -->
<!-- Example Modal 1: Corresponds with Portfolio Carousel Item 1 -->
<div class="portfolio-modal modal fade" id="portfolioModal1" tabindex="-1" role="dialog" aria-hidden="true" style="background-image: url('img/agency/portfolio/carousel/bg-1.jpg')">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="close-modal" data-dismiss="modal">
                <div class="lr">
                    <div class="rl">
                    </div>
                </div>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 offset-lg-2">
                            <h2>Project Name</h2>
                            <hr class="colored">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quos modi in tenetur vero voluptatum sapiente dolores eligendi nemo iste ea. Omnis, odio enim sint quam dolorum dolorem. Nostrum, minus, ad.</p>
                        </div>
                        <div class="col-lg-8 offset-lg-2">
                            <div class="device-mockup macbook portrait black">
                                <div class="device">
                                    <div class="screen">

                                        <!-- Modal Mockup Option 1: Single Image (Uncomment Below to Use) -->
                                        <!-- <img src="img/agency/portfolio/carousel/screen-1a.jpg" class="img-fluid" alt=""> -->

                                        <!-- Modal Mockup Option 2: Carousel (Example In Use Below) -->
                                        <div class="mockup-carousel">
                                            <div class="item">
                                                <img src="img/agency/portfolio/carousel/screen-1a.jpg" class="img-fluid" alt="">
                                            </div>
                                            <div class="item">
                                                <img src="img/agency/portfolio/carousel/screen-1b.jpg" class="img-fluid" alt="">
                                            </div>
                                            <div class="item">
                                                <img src="img/agency/portfolio/carousel/screen-1c.jpg" class="img-fluid" alt="">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8 offset-lg-2">
                            <ul class="list-inline item-details">
                                <li>Client: <strong>Start Bootstrap</strong>
                                </li>
                                <li>Date: <strong>April 2015</strong>
                                </li>
                                <li>Service: <strong>Web Development</strong>
                                </li>
                            </ul>
                            <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Example Modal 2: Corresponds with Portfolio Carousel Item 2 -->
<div class="portfolio-modal modal fade" id="portfolioModal2" tabindex="-1" role="dialog" aria-hidden="true" style="background-image: url('img/agency/portfolio/carousel/bg-2.jpg')">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="close-modal" data-dismiss="modal">
                <div class="lr">
                    <div class="rl">
                    </div>
                </div>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 offset-lg-2">
                            <h2>Project Name</h2>
                            <hr class="colored">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quos modi in tenetur vero voluptatum sapiente dolores eligendi nemo iste ea. Omnis, odio enim sint quam dolorum dolorem. Nostrum, minus, ad.</p>
                        </div>
                        <div class="col-lg-8 offset-lg-2">
                            <div class="device-mockup macbook portrait black">
                                <div class="device">
                                    <div class="screen">

                                        <!-- Modal Mockup Option 1: Single Image (Uncomment Below to Use) -->
                                        <!-- <img src="img/agency/portfolio/carousel/screen-2a.jpg" class="img-fluid" alt=""> -->

                                        <!-- Modal Mockup Option 2: Carousel (Example In Use Below) -->
                                        <div class="mockup-carousel">
                                            <div class="item">
                                                <img src="img/agency/portfolio/carousel/screen-2a.jpg" class="img-fluid" alt="">
                                            </div>
                                            <div class="item">
                                                <img src="img/agency/portfolio/carousel/screen-2b.jpg" class="img-fluid" alt="">
                                            </div>
                                            <div class="item">
                                                <img src="img/agency/portfolio/carousel/screen-2c.jpg" class="img-fluid" alt="">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8 offset-lg-2">
                            <ul class="list-inline item-details">
                                <li>Client: <strong>Start Bootstrap</strong>
                                </li>
                                <li>Date: <strong>April 2015</strong>
                                </li>
                                <li>Service: <strong>Web Development</strong>
                                </li>
                            </ul>
                            <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Example Modal 3: Corresponds with Portfolio Carousel Item 3 -->
<div class="portfolio-modal modal fade" id="portfolioModal3" tabindex="-1" role="dialog" aria-hidden="true" style="background-image: url('img/agency/portfolio/carousel/bg-3.jpg')">
    <div class="modal-content">
        <div class="modal-dialog">
            <div class="close-modal" data-dismiss="modal">
                <div class="lr">
                    <div class="rl">
                    </div>
                </div>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 offset-lg-2">
                            <h2>Project Name</h2>
                            <hr class="colored">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quos modi in tenetur vero voluptatum sapiente dolores eligendi nemo iste ea. Omnis, odio enim sint quam dolorum dolorem. Nostrum, minus, ad.</p>
                        </div>
                        <div class="col-lg-8 offset-lg-2">
                            <div class="device-mockup macbook portrait black">
                                <div class="device">
                                    <div class="screen">

                                        <!-- Modal Mockup Option 1: Single Image (Uncomment Below to Use) -->
                                        <!-- <img src="img/agency/portfolio/carousel/screen-3a.jpg" class="img-fluid" alt=""> -->

                                        <!-- Modal Mockup Option 2: Carousel (Example In Use Below) -->
                                        <div class="mockup-carousel">
                                            <div class="item">
                                                <img src="img/agency/portfolio/carousel/screen-3a.jpg" class="img-fluid" alt="">
                                            </div>
                                            <div class="item">
                                                <img src="img/agency/portfolio/carousel/screen-3b.jpg" class="img-fluid" alt="">
                                            </div>
                                            <div class="item">
                                                <img src="img/agency/portfolio/carousel/screen-3c.jpg" class="img-fluid" alt="">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8 offset-lg-2">
                            <ul class="list-inline item-details">
                                <li>Client: <strong>Start Bootstrap</strong>
                                </li>
                                <li>Date: <strong>April 2015</strong>
                                </li>
                                <li>Service: <strong>Web Development</strong>
                                </li>
                            </ul>
                            <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Example Modal 4: Corresponds with Portfolio Carousel Item 4 -->
<div class="portfolio-modal modal fade" id="portfolioModal4" tabindex="-1" role="dialog" aria-hidden="true" style="background-image: url('img/agency/portfolio/carousel/bg-4.jpg')">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="close-modal" data-dismiss="modal">
                <div class="lr">
                    <div class="rl">
                    </div>
                </div>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 offset-lg-2">
                            <h2>Project Name</h2>
                            <hr class="colored">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quos modi in tenetur vero voluptatum sapiente dolores eligendi nemo iste ea. Omnis, odio enim sint quam dolorum dolorem. Nostrum, minus, ad.</p>
                        </div>
                        <div class="col-lg-8 offset-lg-2">
                            <div class="device-mockup macbook portrait black">
                                <div class="device">
                                    <div class="screen">

                                        <!-- Modal Mockup Option 1: Single Image (Example In Use Below) -->
                                        <img src="img/agency/portfolio/carousel/screen-4.jpg" class="img-fluid" alt="">

                                        <!-- Modal Mockup Option 2: Carousel (Uncomment Below to Use) -->
                                        <!-- <div class="mockup-carousel">
                                        <div class="item">
                                            <img src="img/agency/portfolio/carousel/screen-1a.jpg" class="img-fluid" alt="">
                                        </div>
                                        <div class="item">
                                            <img src="img/agency/portfolio/carousel/screen-2a.jpg" class="img-fluid" alt="">
                                        </div>
                                        <div class="item">
                                            <img src="img/agency/portfolio/carousel/screen-3a.jpg" class="img-fluid" alt="">
                                        </div>
                                    </div> -->

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8 offset-lg-2">
                            <ul class="list-inline item-details">
                                <li>Client: <strong>Start Bootstrap</strong>
                                </li>
                                <li>Date: <strong>April 2015</strong>
                                </li>
                                <li>Service: <strong>Web Development</strong>
                                </li>
                            </ul>
                            <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->

<?= $this->Html->script('vitality-mixitup', ["block" => "scriptBottom"]) ?>
