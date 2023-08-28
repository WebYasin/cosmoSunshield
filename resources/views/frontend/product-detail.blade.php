@extends("layouts.layout")
@section('page')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
    <link rel="stylesheet" href="<?php echo config('app.CATALOG'); ?>css/twentytwenty.css" />
    <script src="<?php echo config('app.CATALOG'); ?>js/jquery.event.move.js"></script>
    <script src="<?php echo config('app.CATALOG'); ?>js/jquery.twentytwenty.js"></script>
    <?php if($fetch_product){ ?>
    <section>
        <div class="full-image bottom-gradient position-relative float-title overlay">
            <div class="float-container">
                <div class="container">
                    <h2><?php echo $fetch_product->name ?$fetch_product->name:""; ?></h2>
                </div>
            </div>
            <img src="<?php echo url($fetch_product->banner_image ? $fetch_product->banner_image : $noImage); ?>" alt="banner" />
        </div>
    </section>
    <?php } ?>

    <section class="section-space">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 mx-auto">
                    <div class="title large-desp text-center">
                    <?php echo $fetch_product->description ?$fetch_product->description:""; ?>

                    </div>
                </div>
                <?php if($fetch_product->video){ ?>
                <div class="col-md-12 mt-5">
                    <div class="video-img-box">
                        <img src="<?php echo url($fetch_product->video_image ?$fetch_product->video_image: $noImage); ?>" alt="video-bg" />
                        <video muted="" loop="" autoplay="" src=""></video>
                        <button type="button" class="video-btn youtube-video-btn" data="<?php echo url($fetch_product->video); ?>">
                            <svg width="86" height="86" viewBox="0 0 86 86" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="43" cy="43" r="42.5" fill="#000" fill-opacity=".27" stroke="#fff"/>
                                <path d="m35 29 21 14-21 14V29Z" fill="#fff"/>
                            </svg>
                        </button>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </section>
    <?php if($fetch_product){ ?>
    <section class="section-space pt-lg-5 pt-0">
        <div class="container">
            <div class="row">
                <div class="col-xl-8">
                    <div class="title medium-desp">
                        <h2><?php echo $fetch_product->heading1 ?$fetch_product->heading1:""; ?></h2>
                        <p><?php echo $fetch_product->description1 ?$fetch_product->description1:""; ?></p>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="full-image">
                        <img src="<?php echo url($fetch_product->image1 ?$fetch_product->image1: $noImage); ?>" alt="video-bg" />
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php } ?>
    <section class="section-space pt-0">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="title medium-desp">
                        <h2><?php echo $fetch_product->heading2 ?$fetch_product->heading2:""; ?></h2>
                        <p><?php echo $fetch_product->description2 ?$fetch_product->description2:""; ?></p>

                    </div>
                </div>
                <div class="col-md-12">
                    <div class="swiper sub-product-slider">
                        <div class="swiper-wrapper">
                            <?php
                                    if(is_array($all_product) || is_object($all_product))
                                    {
                                        foreach ($all_product as $product) {

                            ?>
                            <div class="swiper-slide">
                                <div class="blog-block type2 hover my-3">
                                    <div class="img-box">
                                        <a href="#">
                                            <img src="<?php echo url($product->image ?$product->image: $noImage); ?>" alt="Sunshield" decoding="async" loading="lazy"
                                            />
                                        </a>
                                    </div>
                                    <div class="content mt-3">
                                        <h3><a href="#"><?php echo $product->name ?$product->name:""; ?></a></h3>
                                        <!-- <a href="#" class="link">More Details</a> -->
                                    </div>
                                </div>
                            </div>
                            <?php } } ?>
                        </div>
                    </div>
                    <div class="text-center mt-3">
                        <div class="swiper-button-prev product-prev-2 box-swiper-btn dark"></div>
                        <div class="swiper-button-next product-next-2 box-swiper-btn dark"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php if($fetch_product->after_image && $fetch_product->before_image){ ?>
    <section class="position-relative">
        <div class="before-after-btn-section">
            <div class="row m-0">
                <div class="col-md-6 col-6 text-center">
                    <div class="image-tag">Before</div>
                </div>
                <div class="col-md-6 col-6 text-center">
                    <div class="image-tag">After</div>
                </div>
            </div>
        </div>
        <div class="full-image before-after position-relative twentytwenty-container">
            <img src="<?php echo url($fetch_product->after_image ?$fetch_product->after_image:$noImage); ?>" />
            <img src="<?php echo url($fetch_product->before_image ?$fetch_product->before_image:$noImage); ?>" />
        </div>
    </section>
    <?php } ?>
    <section class="section-space">
        <div class="container">
            <div class="full-image bottom-gradient position-relative float-title">
                <img src="<?php echo url($fetch_product->image3 ?$fetch_product->image3:$noImage); ?>" />
                <div class="float-container static-position-mobile px-sm-5">
                    <div class="container">
                        <div class="col-lg-4 mt-sm-0 mt-4">
                        <h2><?php echo $fetch_product->heading3 ?$fetch_product->heading3:""; ?></h2>

                            <div class="mt-3 d-sm-block d-none">
                                <div class="swiper-button-prev product-prev-2 box-swiper-btn dark"></div>
                                <div class="swiper-button-next product-next-2 box-swiper-btn dark"></div>
                            </div>
                        </div>
                    </div>
            <?php if(count($all_feature) >= 1){ ?>
                <div class="ps-sm-5 benefit-slider-section">
                    <div class="swiper benefit-sliders">
                        <div class="swiper-wrapper">
                            <?php
                                if(is_array($all_feature) || is_object($all_feature))
                                {
                                    foreach ($all_feature as $feature) {

                            ?>
                            <div class="swiper-slide">
                                <div class="bg-white benefit-block">
                                    <div class="title large-desp mb-0">
                                        <p><?php echo $feature->title ? $feature->title:""; ?></p>
                                    </div>
                                </div>
                            </div>
                            <?php } } ?>
                        </div>
                    </div>
                </div>
                <?php } ?>
                </div>
            </div>
        </div>
    </section>
    <section class="section-space pb-0">
        <div class="container pt-sm-5">
            <div class="resource-box mt-sm-4">
                <div class="row justify-content-between align-items-center">
                    <div class="col-lg-3">
                        <div class="title medium-desp mb-0">
                        <h2><?php echo $fetch_product->heading4 ?$fetch_product->heading4:""; ?></h2>
                        <p><?php echo $fetch_product->description4 ? $fetch_product->description4:""; ?></p>
                        </div>
                    </div>
                    <div class="col-lg-7 mt-lg-0 mt-5">
                        <div class="row gy-4">
                            <div class="col-md-6">
                                <div class="bg-white download-block">
                                    <a href="<?php echo url($fetch_product->catalog); ?>" download>
                                        <img src="<?php echo config('app.CATALOG'); ?>images/download-img.jpg" alt="Product Catalog" />
                                        <div class="flex align-items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="me-2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
                                            </svg>
                                            Product Catalog
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section-space">
        <div class="container">
            <div class="row">
                <div class="col-md-7 mx-auto">
                    <div class="title text-center mb-0">
                    <h2><?php echo $fetch_product->heading5 ?$fetch_product->heading5:""; ?></h2>
                        <a href="<?php echo $fetch_product->link5 ?$fetch_product->link5:"#"; ?>" class="btn mt-4">Contact Us</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        $(window).load(function(){
        $(".before-after").twentytwenty();
        });
    </script>
    @endsection
