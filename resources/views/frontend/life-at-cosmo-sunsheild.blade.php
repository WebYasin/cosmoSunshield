@extends("layouts.layout")
@section('page')
<?php if($fetch_heading){ ?>
    <section class="section-space pb-0 overflow-hidden">
        <div class="container">
            <div class="title col-xl-8 mx-auto text-center">
                <h2><?php echo $fetch_heading->heading1 ? $fetch_heading->heading1 :"";  ?></h2>
                <p><?php echo $fetch_heading->description1 ? $fetch_heading->description1 :"";  ?></p>
            </div>
            <div class="text-center">
                <img src="<?php echo config('app.CATALOG'); ?>images/moon-curve.svg" alt="curve" class="img-fluid" />
            </div>
        </div>
    </section>
    <?php } ?>
    <?php if($fetch_heading){ ?>
    <section class="section-space gray-bg">
        <div class="container">
            <div class="row justify-content-between align-items-center">
                <div class="col-lg-6 col-sm-7">
                    <div class="title text-center medium-desp ceo-message">
                        <h2><?php echo $fetch_heading->heading2 ? $fetch_heading->heading2 :"";  ?></h2>
                        <h3><?php echo $fetch_heading->heading2_1 ? $fetch_heading->heading2_1 :"";  ?></h3>
                        <p><?php echo $fetch_heading->description2 ? $fetch_heading->description2 :"";  ?></p>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-5">
                    <div class="full-image rounded-full">
                        <img src="<?php echo url($fetch_heading->img2 ? $fetch_heading->img2 : $noImage); ?>" class="" />
                    </div>
                    <div class="title medium-desp ceo-message text-center mt-3">
                        <p class="fs-20 text-color name"><?php echo $fetch_heading->name2 ? $fetch_heading->name2 :"";  ?></p>
                        <p class="position"><?php echo $fetch_heading->designation2 ? $fetch_heading->designation2 :"";  ?></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php } ?>

    <?php if(count($all_gallery) >= 1){ ?>
    <section class="section-space">
        <div class="container">
            <div class="title col-md-12 mx-auto text-center">
            <h2><?php echo $fetch_heading->heading3 ? $fetch_heading->heading3 :"";  ?></h2>
            <p><?php echo $fetch_heading->description3 ? $fetch_heading->description3 :"";  ?></p>

            </div>
        </div>
        <div class="ps-sm-5">
        <div class="swiper work-culture-slider">
            <div class="swiper-wrapper">
                <?php
                    if(is_array($all_gallery) || is_object($all_gallery))
                    {
                        foreach ($all_gallery as $gallery) {

                ?>
                <div class="swiper-slide">
                    <div class="culture-block">
                        <img src="<?php echo url($gallery->image ? $gallery->image : $noImage); ?>" alt="culture" />
                        <div class="content">
                            <h5><?php echo $gallery->name ? $gallery->name :"";  ?></h5>
                        </div>
                    </div>
                </div>
                <?php } } ?>

            </div>
        </div>
        <div class="position-relative mt-3 text-center">
            <div class="swiper-button-prev work-prev box-swiper-btn grey"></div>
            <div class="swiper-button-next work-next box-swiper-btn grey"></div>
        </div>
        </div>
    </section>
    <?php } ?>
    <section class="section-space pt-0">
        <div class="container">
            <div class="title col-md-6 mx-auto text-center">
            <h2><?php echo $fetch_heading->heading4 ? $fetch_heading->heading4 :"";  ?></h2>
            <p><?php echo $fetch_heading->description4 ? $fetch_heading->description4 :"";  ?></p>
         </div>
            <div class="row gy-2">
            <?php
                    if(is_array($all_jobs) || is_object($all_jobs))
                    {
                        foreach ($all_jobs as $jobs) {

                ?>
                <div class="col-md-12">
                    <div class="opening-block">
                        <div class="row align-items-center">
                            <div class="col-md-4 col-12">
                                <div class="position"><?php echo $jobs->title ? $jobs->title :"";  ?></div>
                            </div>
                            <div class="col-md-4 col-12">
                                <div class="location text-sm-center"><?php echo $jobs->location ? $jobs->location :"";  ?></div>
                            </div>
                            <div class="col-md-4 col-12 mt-sm-0 mt-4">
                                <div class="action text-sm-end">
                                    <a href="<?php echo url('job-details/'.$jobs->slug); ?>" class="btn">Apply Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } } ?>

            </div>
            <div class="text-center mt-4">
                <a href="<?php echo url('openings'); ?>" class="btn">View All Openings</a>
            </div>
            <!-- <div class="cta-section mt-5">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h3><?php echo $fetch_heading->heading5 ? $fetch_heading->heading5 :"";  ?></h3>
                    </div>
                    <div class="col-md-4 text-end">
                        <a href="<?php echo $fetch_heading->btn_link ? $fetch_heading->btn_link :"";  ?>" class="btn white-fill"><?php echo $fetch_heading->btn_name ? $fetch_heading->btn_name :"";  ?></a>
                    </div>
                </div>
            </div> -->
        </div>
    </section>
    @endsection
