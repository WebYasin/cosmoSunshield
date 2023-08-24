@extends("layouts.layout")
@section('page')
<?php if($home_banner){ ?>
    <section>
        <div class="home-main-video">
            <?php if($home_banner->video){ ?>
            <video muted loop autoplay>
                <source src="<?php echo url($home_banner->video); ?>"
                    type="video/mp4">
            </video>
            <?php } ?>
            <div class="banner-content">
                <div class="container">
                    <div class="col-md-7">
                        <h1 data-cue="slideInUp"><?php echo $home_banner->title ?$home_banner->title:""; ?></h1>
                        <p data-cue="slideInUp" data-delay="100"><?php echo $home_banner->content ?$home_banner->content:""; ?></p>
                        <a href="<?php echo $home_banner->btn_link ?$home_banner->btn_link:"#"; ?>" class="btn white" data-cue="slideInUp" data-delay="200"><?php echo $home_banner->btn_name ?$home_banner->btn_name:""; ?></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php } ?>
    <section class="section-space">
        <div class="container">
            <?php if($fetch_heading){ ?>
            <div class="row">
                <div class="col-md-10 mx-auto">
                    <div class="title text-center">
                        <h2 data-cue="slideInUp"><?php echo $fetch_heading->heading1 ?$fetch_heading->heading1:""; ?></h2>
                        <div class="col-md-9 mx-auto">
                            <p data-cue="slideInUp"><?php echo $fetch_heading->description1 ?$fetch_heading->description1:""; ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
            <div class="row">
                <?php
                    if(is_array($all_solution) || is_object($all_solution)){
                        $i=0;
                        foreach ($all_solution as $solution) {
                            $i++;
                            $class = $i == 1 ? 'right-curve':'';
                ?>
                <div class="col-md-6">
                    <div class="solution-block <?php echo $class; ?>" data-cue="slideInRight">
                        <div class="img-box">
                            <img src="<?php echo url($solution->image ? $solution->image : $noImage); ?>" alt="For Buildings" decoding="async" loading="lazy" />
                            <div class="content">
                                <h3><?php echo $solution->title ?$solution->title:""; ?></h3>
                                <p><?php echo $solution->short_description ?$solution->short_description:""; ?></p>
                                <a href="#" class="btn white">Learn More</a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                }
                    }
                    ?>

            </div>
        </div>
    </section>
    <?php
        if(count($all_product) >=1){
    ?>
    <section class="section-space pt-0">
        <div class="container">
            <div class="row">
                <div class="col-md-7 mx-auto">
                    <div class="title text-center">
                        <h2 data-cue="slideInUp"><?php echo $fetch_heading->heading2 ?$fetch_heading->heading2:""; ?></h2>
                        <p data-cue="slideInUp"><?php echo $fetch_heading->description2 ?$fetch_heading->description2:""; ?></p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 position-relative">
                    <div class="swiper product-slider">
                        <div class="swiper-wrapper" data-cues="slideInUp">
                            <?php
                                if(is_array($all_product) || is_object($all_product)){
                                    foreach ($all_product as $product) {
                            ?>
                            <div class="swiper-slide">
                                <div class="product-block">
                                    <div class="img-box">
                                        <a href="<?php echo url('product-details/'. $product->slug); ?>">
                                        <img src="<?php echo url($product->image ? $product->image : $noImage); ?>" alt="<?php echo $product->name ?$product->name:""; ?>" decoding="async" loading="lazy" />
                                        </a>
                                    </div>
                                    <div class="content">
                                        <h3><?php echo $product->name ?$product->name:""; ?></h3>
                                        <p><?php echo $product->short_description ?$product->short_description:""; ?></p>
                                        <!-- <a href="#" class="btn">Learn More</a> -->
                                    </div>
                                </div>
                            </div>
                            <?php } } ?>
                        </div>
                    </div>
                    <!-- <div class="swiper-button-prev product-prev box-swiper-btn float dark"></div>
                    <div class="swiper-button-next product-next box-swiper-btn float dark"></div> -->
                </div>
            </div>
        </div>
    </section>
    <?php } ?>
    <?php if(count($all_home_why_cosmo) >= 1){ ?>
    <section class="section-space">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-md-6">
                    <div class="title" data-cue="slideInLeft">
                        <h2><?php echo $fetch_heading->heading3 ?$fetch_heading->heading3:""; ?></h2>
                    </div>
                </div>
                <!-- <div class="col-md-5">
                    <div class="title">
                        <p>Cosmo Sunshield has engineered products to exceed expectations in industries across the globe.</p>
                    </div>
                </div> -->
            </div>
            <div class="benefit-section" data-cues="slideInUp">
                <?php
                    if(is_array($all_home_why_cosmo) || is_object($all_home_why_cosmo)){
                        $i=0;
                        foreach ($all_home_why_cosmo as $home_why_cosmo) {
                            $i++;
                            $class_active = count($all_home_why_cosmo) == $i ? 'active' :'';
                ?>
                <div class="benefit-block <?php echo $class_active; ?>">
                    <div class="img-box">
                        <img src="<?php echo url($home_why_cosmo->image ? $home_why_cosmo->image : $noImage); ?>" alt="benefit" />
                        <div class="verticle-info">
                            <div class="icon"><img src="<?php echo url($home_why_cosmo->icon ? $home_why_cosmo->icon : $noImage); ?>" alt="icon" /></div>
                            <div class="tagline"><?php echo $home_why_cosmo->title ?$home_why_cosmo->title:""; ?></div>
                        </div>
                        <div class="info">
                            <p><?php echo $home_why_cosmo->content ?$home_why_cosmo->content:""; ?></p>
                        </div>
                    </div>
                </div>
                <?php } } ?>
            </div>
        </div>
    </section>
    <?php } ?>
    <?php
    if(count($all_home_feature) >= 1) {
       ?>
    <section class="section-space pt-0">
        <div class="container">
            <div class="row" data-cues="slideInUp">
            <?php if(is_array($all_home_feature) || is_object($all_home_feature)){
                                    foreach ($all_home_feature as $home_feature) {
                                  ?>
                <div class="col-md-3">
                    <div class="icon-box">
                        <div class="icon">
                            <img src="<?php echo url($home_feature->image ? $home_feature->image : $noImage); ?>" alt="<?php echo $home_feature->title ?$home_feature->title:""; ?>" />
                        </div>
                        <h5><?php echo $home_feature->title ?$home_feature->title:""; ?></h5>
                    </div>
                </div>
                <?php } } ?>

            </div>
        </div>
    </section>
    <?php } ?>
    <section class="section-space pt-0">
        <div class="container">
            <div class="row align-items-center justify-content-between">
                <div class="col-md-3">
                    <div class="full-image" data-cues="slideInLeft">
                        <img src="<?php echo url($fetch_heading->image4 ? $fetch_heading->image4 : $noImage); ?>" alt="edge" />
                    </div>
                </div>
                <div class="col-md-4 text-center">
                    <div class="title" data-cues="slideInUp">
                        <h2><?php echo $fetch_heading->heading4 ?$fetch_heading->heading4:""; ?></h2>
                        <p><?php echo $fetch_heading->description4 ?$fetch_heading->description4:""; ?></p>
                    </div>
                    <a href="<?php echo $fetch_heading->btn_link4 ?$fetch_heading->btn_link4:"#"; ?>" class="btn" data-cue="slideInUp">Learn More</a>
                </div>
                <div class="col-md-3">
                    <div class="full-image" data-cues="slideInRight">
                        <img src="<?php echo url($fetch_heading->image4_1 ? $fetch_heading->image4_1 : $noImage); ?>" alt="edge" />
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="position-relative">
        <div class="explore-bg-section">
            <div class="full-image">
                <img src="<?php echo url($fetch_heading->image5 ? $fetch_heading->image5 : $noImage); ?>" alt="explore" />
            </div>
        </div>
        <div class="explore-content">
            <div class="container">
                <div class="row">
                    <div class="col-md-11 mx-auto">
                        <div class="row justify-content-between">
                            <div class="col-md-6">
                                <div class="explore-info" data-cues="slideInUp">
                                    <!-- <h6>For Dealers</h6> -->
                                    <h3><?php echo $fetch_heading->heading5 ?$fetch_heading->heading5:""; ?></h3>
                                    <p><?php echo $fetch_heading->description5 ?$fetch_heading->description5:""; ?></p>

                                    <div class="mt-4">
                                        <a href="<?php echo $fetch_heading->btn_link5_1 ?$fetch_heading->btn_link5_1:""; ?>" class="btn white me-3">Become a Dealer</a>
                                        <a href="<?php echo $fetch_heading->btn_link5_2 ?$fetch_heading->btn_link5_2:""; ?>" class="btn white">Locate a Dealer</a>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="col-md-5">
                                <div class="explore-info">
                                    <h6>For Customers</h6>
                                    <h3>Best Solution Provided to our Customers</h3>
                                    <a href="#" class="btn white">Contact Us</a>
                                </div>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php
        if(count($all_blogs) >= 1){
    ?>
    <section class="section-space">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="title" data-cue="slideInUp">
                    <h2><?php echo $fetch_heading->heading6 ?$fetch_heading->heading6:""; ?></h2>
                    <p><?php echo $fetch_heading->description6 ?$fetch_heading->description6:""; ?></p>
                    </div>
                </div>
            </div>
            <div class="row gx-5" data-cue="slideInRight">
                <?php
                    if(is_array($all_blogs) || is_object($all_blogs)){
                        foreach ($all_blogs as $blogs) {
                ?>
                <div class="col-md-4">
                    <div class="blog-block">
                        <div class="img-box">
                            <a href="<?php echo url('blog-details/'. $blogs->slug); ?>">
                                <img src="<?php echo url($blogs->image ? $blogs->image : $noImage); ?>" alt="The Science Behind Window Films: How They Work" decoding="async" loading="lazy" />
                            </a>
                        </div>
                        <div class="content">
                            <h3><a href="<?php echo url('blog-details/'. $blogs->slug); ?>"><?php echo $blogs->title ? $blogs->title :""; ?></a></h3>
                            <a href="<?php echo url('blog-details/'. $blogs->slug); ?>">Read More</a>
                        </div>
                    </div>
                </div>
                <?php } } ?>
                <div class="text-center mt-4">
                    <a href="<?php echo url('blogs'); ?>" class="btn">View All</a>
                </div>
            </div>
        </div>
    </section>
    <?php } ?>
    <?php if(count($all_testimonial) >= 1){ ?>
    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 px-0">
                    <div class="swiper testimonial">
                        <div class="swiper-wrapper">
                        <?php if(is_array($all_testimonial) || is_object($all_testimonial)){
                                    foreach ($all_testimonial as $testimonial_img) {
                                  ?>
                            <div class="swiper-slide">
                                <div class="full-image">
                                    <img src="<?php echo url($testimonial_img->image ? $testimonial_img->image : $noImage); ?>" alt="testimonial" />
                                </div>
                            </div>
                            <?php    }
                                }
                                ?>

                        </div>
                    </div>
                </div>
                <div class="col-md-6 p-5 bg-red h-full">
                    <div class="p-4">
                        <div class="title">
                        <h2><?php echo $fetch_heading->heading7 ?$fetch_heading->heading7:""; ?></h2>
                        </div>
                        <div class="swiper testimonial">
                            <div class="swiper-wrapper">
                                <?php if(is_array($all_testimonial) || is_object($all_testimonial)){
                                    foreach ($all_testimonial as $testimonial) {
                                  ?>
                                <div class="swiper-slide">
                                    <div class="testimonial-block">
                                        <p><?php echo $testimonial->description ? $testimonial->description :""; ?></p>
                                        <div class="name"><?php echo $testimonial->name ? $testimonial->name :""; ?></div>
                                        <div class="position"><?php echo $testimonial->designation ? $testimonial->designation :""; ?></div>
                                    </div>
                                </div>
                                <?php    }
                                }
                                ?>
                            </div>
                        </div>
                        <div class="position-relative mt-5">
                            <div class="swiper-button-prev test-prev box-swiper-btn me-2"></div>
                            <div class="swiper-button-next test-next box-swiper-btn"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php } ?>
    @endsection
