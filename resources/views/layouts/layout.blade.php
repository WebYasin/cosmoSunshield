<?php

use Illuminate\Support\Facades\DB;

$header_menu            = DB::table('front_menu')->where(array('status' => 1, 'parent_id' => 0, 'header' => 1))->orderBy('sort_order', 'ASC')->get();
$footer_menu            = DB::table('front_menu')->where(array('status' => 1, 'footer' => 1))->orderBy('sort_order_footer', 'ASC')->get();
$wconfig                = websetting();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title><?php echo $page_title; ?></title>
    <base href="<?php echo url(''); ?>/" data-base="<?php echo url(''); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?php echo config('app.CATALOG'); ?>images/favicon.ico" sizes="32x32" />
    <link rel="icon" href="<?php echo config('app.CATALOG'); ?>images/favicon.ico" sizes="192x192" />
    <link rel="apple-touch-icon" href="<?php echo config('app.CATALOG'); ?>images/favicon.ico" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" integrity="sha512-t4GWSVZO1eC8BM339Xd7Uphw5s17a86tIZIj8qRxhnKub6WoyhnrxeCIMeAqBPgdZGlCcG2PrZjMc+Wr78+5Xg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/8.4.7/swiper-bundle.min.css" integrity="sha512-N2IsWuKsBYYiHNYdaEuK4eaRJ0onfUG+cdZilndYaMEhUGQq/McsFU75q3N+jbJUNXm6O+K52DRrK+bSpBGj0w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel='stylesheet' href='<?php echo config('app.CATALOG'); ?>css/scrollCue.css' />
    <link rel='stylesheet' href='<?php echo config('app.CATALOG'); ?>css/app.css' />
    <link rel='stylesheet' href='<?php echo config('app.CATALOG'); ?>css/responsive.css' />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js" integrity="sha512-VK2zcvntEufaimc+efOYi622VN5ZacdnufnmX7zIhCPmjhKnOi9ZDMtg1/ug5l183f19gG1/cBstPO4D8N/Img==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/8.4.7/swiper-bundle.min.js" integrity="sha512-h5Vv+n+z0eRnlJoUlWMZ4PLQv4JfaCVtgU9TtRjNYuNltS5QCqi4D4eZn4UkzZZuG2p4VBz3YIlsB7A2NVrbww==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="<?php echo config('app.CATALOG'); ?>js/scrollCue.js"></script>
    <script src="<?php echo config('app.CATALOG'); ?>js/app.js"></script>
</head>

<body>
    <header>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-3 col-8">
                    <a href="/" class="logo">
                        <img src="<?php echo url($wconfig['checkout_image'] ? $wconfig['checkout_image'] : 'images/logo.svg'); ?>" class="img-fluid" alt="Cosmo Sunshield" decoding="async" />
                    </a>
                </div>
                <div class="col-md-9 col-4">
                    <div class="navigation">
                        <a href="/" class="logo mb-4 d-lg-none d-sm-block">
                            <img src="<?php echo url($wconfig['checkout_image'] ? $wconfig['checkout_image'] : 'images/logo.svg'); ?>" class="img-fluid" alt="Cosmo Sunshield" decoding="async" />
                        </a>
                        <ul class="menu">
                            <?php
                            foreach ($header_menu as $menuHeader) {
                                $sub_menu =  DB::table('front_menu')->where(array('status' => 1, 'parent_id' => $menuHeader->id, 'header' => 1))->orderBy('sort_order', 'ASC')->get();
                                if (count($sub_menu) >= 1) {
                            ?>
                                    <li class="menu-item-has-children">
                                        <a href="<?php echo url($menuHeader->link); ?>"><?php echo $menuHeader->name; ?></a>
                                        <ul class="sub-menu">
                                            <?php foreach ($sub_menu as $menuSub) { ?>
                                                <li> <a href="<?php echo url($menuSub->link); ?>"><?php echo $menuSub->name; ?></a></li>
                                            <?php } ?>

                                        </ul>
                                    </li>
                                <?php } else { ?>
                                    <li> <a href="<?php echo url($menuHeader->link); ?>"><?php echo $menuHeader->name; ?></a></li>

                            <?php }
                            } ?>


                            <li class="d-lg-block d-none">
                                <button type="button" class="empty-btn search_btn">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M9 17A8 8 0 1 0 9 1a8 8 0 0 0 0 16Zm10 2-4.35-4.35" stroke="#272727" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </button>
                            </li>
                            <li class="button d-lg-block d-none"><a href="<?php echo url('contact-us'); ?>">Contact</a></li>
                        </ul>
                    </div>
                    <button type="button" class="d-lg-none d-block menu-toggle">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                    </button>
                    <a href="<?php echo url('contact-us'); ?>" class="btn d-lg-none d-sm-inline-block d-none float-end me-3">Contact</a>
                </div>
            </div>
        </div>
        <div class="search_input d-none">
            <input type="text" class="form-control" placeholder="Search Here" id="keyword">
            <div class="input-group-append">
                <button class="ml-2  " type="button"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                    </svg></button>
            </div>

            <div id="searchResult"></div>

            <button class="close_search" type="button"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                    <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z" />
                </svg></button>
        </div>
    </header>
    @section('page')
    @show



    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-sm-12 col-12 mb-lg-0 mb-5">
                    <div class="logo">
                        <a href="index.php" class="custom-logo-link">
                            <img src="<?php echo url($wconfig['checkout_image'] ? $wconfig['checkout_image'] : 'images/logo.svg'); ?>" alt="Cosmo Sunshield" decoding="async" />
                        </a>
                        <p><?php echo $wconfig['config_footer_note'] ? $wconfig['config_footer_note'] : ""; ?></p>
                    </div>
                    <div class="social">
                        <?php if ($wconfig['config_facebook']) { ?>
                            <a href="<?php echo $wconfig['config_facebook']; ?>" target="_blank">
                                <svg width="13" height="23" viewBox="0 0 13 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M10.673 3.82h2.188V.162A29.42 29.42 0 0 0 9.674 0C6.52 0 4.36 1.904 4.36 5.405v3.222H.878v4.09H4.36V23h4.267V12.716h3.34l.53-4.089h-3.87V5.811c0-1.177.331-1.991 2.046-1.991Z" fill="#fff" />
                                </svg>
                            </a>
                        <?php } ?>
                        <?php if ($wconfig['config_twitter']) { ?>
                            <a href="<?php echo $wconfig['config_twitter']; ?>" target="_blank">
                                <svg width="24" height="20" viewBox="0 0 24 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M23.154 2.51a9.847 9.847 0 0 1-2.724.748A4.707 4.707 0 0 0 22.51.64a9.44 9.44 0 0 1-2.998 1.143 4.726 4.726 0 0 0-8.179 3.24c-.002.364.037.726.115 1.08a13.366 13.366 0 0 1-9.745-4.952A4.742 4.742 0 0 0 3.151 7.48a4.663 4.663 0 0 1-2.136-.583v.051A4.76 4.76 0 0 0 2.083 9.95a4.748 4.748 0 0 0 2.72 1.653 4.712 4.712 0 0 1-1.24.155c-.3.006-.6-.022-.895-.08a4.78 4.78 0 0 0 4.418 3.296 9.49 9.49 0 0 1-5.862 2.02 8.832 8.832 0 0 1-1.131-.064 13.295 13.295 0 0 0 7.252 2.124 13.348 13.348 0 0 0 9.542-3.918 13.384 13.384 0 0 0 3.915-9.556c0-.21-.007-.411-.017-.612a9.438 9.438 0 0 0 2.369-2.458Z" fill="#fff" />
                                </svg>
                            </a>
                        <?php } ?>
                        <?php if ($wconfig['config_instagram']) { ?>
                            <a href="<?php echo $wconfig['config_instagram']; ?>" target="_blank">
                                <svg width="23" height="22" viewBox="0 0 23 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M22.149 6.554a7.98 7.98 0 0 0-.506-2.64 5.588 5.588 0 0 0-3.186-3.2 7.967 7.967 0 0 0-2.642-.503C14.65.155 14.28.143 11.324.143c-2.956 0-3.327.012-4.489.064a7.948 7.948 0 0 0-2.64.507 5.313 5.313 0 0 0-1.932 1.257 5.372 5.372 0 0 0-1.256 1.93A8 8 0 0 0 .502 6.55C.447 7.717.435 8.088.435 11.05c0 2.961.012 3.331.058 4.494.019.904.192 1.799.511 2.645A5.585 5.585 0 0 0 4.19 21.38c.846.318 1.74.49 2.642.508 1.16.051 1.532.064 4.487.064 2.956 0 3.327-.013 4.487-.064a7.942 7.942 0 0 0 2.642-.508 5.568 5.568 0 0 0 3.186-3.19 8.007 8.007 0 0 0 .507-2.646c.051-1.164.064-1.534.064-4.495 0-2.961 0-3.332-.055-4.495l-.001.001Zm-1.96 8.903a5.986 5.986 0 0 1-.375 2.024 3.618 3.618 0 0 1-2.068 2.07 5.98 5.98 0 0 1-2.02.376c-1.149.051-1.493.064-4.399.064-2.905 0-3.254-.013-4.398-.064a5.958 5.958 0 0 1-2.021-.375 3.35 3.35 0 0 1-1.255-.814 3.392 3.392 0 0 1-.813-1.257 6.008 6.008 0 0 1-.368-2.024c-.052-1.143-.064-1.486-.064-4.4 0-2.914.012-3.257.064-4.4a5.983 5.983 0 0 1 .374-2.024c.173-.476.452-.906.817-1.257a3.38 3.38 0 0 1 1.255-.814 5.986 5.986 0 0 1 2.021-.375c1.144-.05 1.488-.064 4.395-.064 2.907 0 3.255.013 4.398.064.69.007 1.374.134 2.021.375a3.35 3.35 0 0 1 1.256.814c.36.353.638.782.812 1.257a6.01 6.01 0 0 1 .367 2.024c.047 1.143.064 1.486.064 4.4 0 2.914-.012 3.25-.063 4.401v-.001Z" fill="#fff" />
                                    <path d="M11.324 5.446a5.586 5.586 0 0 0-5.166 3.457 5.608 5.608 0 0 0 1.212 6.103 5.59 5.59 0 0 0 9.546-3.96c0-1.485-.59-2.91-1.638-3.96a5.587 5.587 0 0 0-3.954-1.64Zm0 9.237a3.626 3.626 0 0 1-3.353-2.244 3.639 3.639 0 0 1 .787-3.96 3.627 3.627 0 0 1 6.195 2.57c0 .963-.382 1.888-1.063 2.57a3.626 3.626 0 0 1-2.566 1.064Zm7.121-9.459a1.31 1.31 0 0 1-.806 1.208 1.304 1.304 0 0 1-1.78-.953 1.308 1.308 0 0 1 1.28-1.562 1.304 1.304 0 0 1 1.306 1.307Z" fill="#fff" />
                                </svg>
                            </a>
                        <?php } ?>
                        <?php if ($wconfig['config_youtube']) { ?>
                            <a href="<?php echo $wconfig['config_youtube']; ?>" target="_blank">
                                <svg width="29" height="20" viewBox="0 0 29 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M28.125 3.372A3.523 3.523 0 0 0 25.65.895C23.456.292 14.67.292 14.67.292 11 .25 7.332.442 3.687.872a3.587 3.587 0 0 0-2.472 2.5 37.163 37.163 0 0 0-.579 6.761c-.014 2.267.18 4.53.579 6.76a3.523 3.523 0 0 0 2.474 2.478c2.22.602 10.982.602 10.982.602 3.67.043 7.338-.15 10.983-.58a3.517 3.517 0 0 0 2.47-2.476 37.1 37.1 0 0 0 .58-6.76 35.272 35.272 0 0 0-.58-6.785Z" fill="#fff" />
                                    <path d="m11.872 14.347 7.306-4.215-7.306-4.215v8.43Z" fill="#272727" />
                                </svg>
                            </a>
                        <?php } ?>
                        <?php if ($wconfig['config_linkedin']) { ?>
                            <a href="<?php echo $wconfig['config_linkedin']; ?>" target="_blank">
                                <svg xmlns="http://www.w3.org/2000/svg" width="29" height="29" viewBox="0 0 100 100" style="enable-background:new 0 0 512 512" xml:space="preserve">
                                    <path d="M90 90V60.7c0-14.4-3.1-25.4-19.9-25.4-8.1 0-13.5 4.4-15.7 8.6h-.2v-7.3H38.3V90h16.6V63.5c0-7 1.3-13.7 9.9-13.7 8.5 0 8.6 7.9 8.6 14.1v26H90zM11.3 36.6h16.6V90H11.3zM19.6 10c-5.3 0-9.6 4.3-9.6 9.6s4.3 9.7 9.6 9.7 9.6-4.4 9.6-9.7-4.3-9.6-9.6-9.6z" fill="#ffffff" />
                                </svg>
                            </a>
                        <?php } ?>
                    </div>
                </div>
                <div class="col-lg-2 offset-lg-1 col-sm-4 col-6 mt-sm-0 mt-5">
                    <div class="footer-widget">
                        <h4>Company</h4>
                        <ul>
                            <li><a href="<?php echo url('about-us'); ?>">Our Story</a></li>
                            <li><a href="<?php echo url('leadership'); ?>">Leadership Team</a></li>
                            <li><a href="<?php echo url('manufacturing'); ?>">Manufacturing</a></li>
                            <li><a href="<?php echo url('sustainability'); ?>">Sustainability</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-sm-4 col-6 mt-sm-0 mt-5">
                    <div class="footer-widget">
                        <h4>Quick Links</h4>
                        <ul>
                            <li><a href="<?php echo url('blogs'); ?>">Blogs</a></li>
                            <li><a href="<?php echo url('life-at-cosmo-sunshield'); ?>">Careers</a></li>
                            <li><a href="<?php echo url('quality-assurance'); ?>">Quality Assurance</a></li>
                            <li><a href="<?php echo url('join-our-dealer-network'); ?>">Dealers</a></li>
                        </ul>
                    </div>
                </div>
                <!-- <div class="col-lg-4 offset-lg-1 col-sm-8 col-12">
                <div class="footer-widget half-menu">
                    <h4>Company</h4>
                    <?php
                    if (is_array($footer_menu) || is_object($footer_menu)) {
                    ?>
                    <ul>
                        <?php foreach ($footer_menu as $menuFooter) { ?>
                            <li> <a href="<?php echo url($menuFooter->link); ?>"><?php echo $menuFooter->name; ?></a></li>

                        <?php } ?>

                    </ul>
                    <?php } ?>
                </div>
            </div> -->
                <div class="col-lg-2 offset-lg-1 col-sm-4 col-12 mt-sm-0 mt-5">
                    <div class="footer-widget">
                        <h4>Solutions</h4>
                        <ul>
                            <li><a href="#">Sunshield</a></li>
                            <li><a href="#">Safety & Security</a></li>
                            <li><a href="#">Decorative</a></li>
                            <li><a href="#">Anti Graffiti</a></li>
                        </ul>
                    </div>
                </div>
                <!-- <div class="text-end">
                <a href="mailto:sunshield@cosmofilms.com" class="underline-light"> </a>
            </div> -->
                <div class="col-md-12">
                    <div class="copyright">
                        <div class="row justify-content-between">
                            <div class="col-lg-8 col-12 d-flex flex-wrap m-0 justify-content-sm-between justify-content-center">
                                <p class="mb-0 d-inline-block text-sm-start text-center mb-sm-0 mb-3"><?php echo $wconfig['config_copywrite'] ? $wconfig['config_copywrite'] : ""; ?></p>

                                <a href="#">Privacy Policy</a>
                                <a href="#">Terms of Use</a>
                            </div>
                            <div class="col-lg-4 col-12 text-lg-end text-center mt-lg-0 mt-3">
                                <p class="mb-0">
                                    <svg width="16" height="14" viewBox="0 0 16 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M2.4 1.8h11.2c.77 0 1.4.63 1.4 1.4v8.4c0 .77-.63 1.4-1.4 1.4H2.4c-.77 0-1.4-.63-1.4-1.4V3.2c0-.77.63-1.4 1.4-1.4Z" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M15 3.2 8 8.1 1 3.2" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <a href="https://www.cyberworx.in" target="_blank" class="underline-light ms-1">sunshield@cosmofilms.com</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <div class="modal fade" id="videoPopup" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-body">
                    <iframe src="" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>

    <script>
        $('.search_btn').on('click', function(event) {
            $('.search_input').removeClass('d-none');
        });

        $('.close_search').on('click', function(event) {
            $('.search_input').addClass('d-none');
        });
    </script>
</body>

</html>
@section('javascript')
@show
