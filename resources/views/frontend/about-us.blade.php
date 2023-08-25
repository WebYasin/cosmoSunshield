@extends("layouts.layout")
@section('page')
<?php if($fetch_banner){ ?>
    <section class="title-section">
        <img src="<?php echo url($fetch_banner->image ? $fetch_banner->image : $noImage); ?>" alt="banner" />
        <div class="title-holder">
            <div class="container">
                <svg width="756" height="140" viewBox="0 0 756 140" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M.217 139.046c118.686-76.44 435.823-184.133 754.881-3.392C636.151 32.617 318.647-110.957.217 139.046Z" fill="#ED2C3F"/>
                </svg>
                <h2><?php echo $fetch_banner->subTitle ?$fetch_banner->subTitle:""; ?></h2>
                <p><?php echo $fetch_banner->description ?$fetch_banner->description:""; ?></p>
            </div>
        </div>
    </section>
    <?php } ?>
    <?php if($fetch_heading){ ?>
    <section class="section-space">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-6 col-12 pe-lg-5">
                    <div class="full-image">
                        <img src="<?php echo url($fetch_heading->image1 ? $fetch_heading->image1 : $noImage); ?>" alt="about-imge"/>
                    </div>
                </div>
                <div class="col-lg-6 mt-lg-0 mt-4">
                    <div class="title color">
                        <h2><?php echo $fetch_heading->heading1 ?$fetch_heading->heading1:""; ?></h2>
                    </div>
                    <div class="section-content">
                        <p><?php echo $fetch_heading->description1 ?$fetch_heading->description1:""; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php } ?>
    <?php if(count($all_about_shield)>=1){ ?>
    <section class="section-space sky-bg">
        <div class="container">
            <div class="row justify-content-between section-content">
                <div class="col-md-5">
                    <div class="full-image">
                        <img src="<?php echo url($fetch_heading->image2 ? $fetch_heading->image2 : $noImage); ?>" alt="logo" />
                    </div>
                </div>
                <div class="col-lg-6 my-lg-0 my-4">
                    <div class="title red">
                        <h2><?php echo $fetch_heading->heading2 ?$fetch_heading->heading2:""; ?></h2>
                    </div>
                    <div class="">
                        <p><?php echo $fetch_heading->short_description2 ?$fetch_heading->short_description2:""; ?></p>
                    </div>
                </div>
                <div class="col-md-12 d-grid row-gap-3 mt-4 mb-5">
                    <?php
                        if(is_array($all_about_shield) || is_object($all_about_shield))
                        {
                            foreach ($all_about_shield as $about_shield) {

                    ?>
                    <div class="border-heading-content">
                        <div class="row">
                            <div class="col-md-6 position-relative remain-border">
                                <h3><?php echo $about_shield->title; ?></h3>
                            </div>
                            <div class="col-md-6">
                            <?php echo $about_shield->description; ?>
                                <!-- <p><strong>“Save"</strong> reflects our dedication to promoting energy efficiency and sustainability.</p> -->
                            </div>
                        </div>
                    </div>
                    <?php } } ?>
                </div>
                <div class="col-md-12 section-content">
                <p><?php echo $fetch_heading->description2 ?$fetch_heading->description2:""; ?></p>
                </div>
            </div>
        </div>
    </section>
    <?php } ?>
    <section class="section-space half-sky-bg pb-0 pt-0">
        <div class="container">
            <div class="row ">
                <div class="col-md-12">
                    <div class="video-img-box">
                        <img class="video-btn-img" src="<?php echo url($fetch_heading->video_thumbnail ? $fetch_heading->video_thumbnail : $noImage); ?>"  alt="video-bg" />
                        <!-- <iframe  src="" title="Sun control film installation in the car. GARWARE/IceCool Shield RTA-approved Film / TATA SAFARI" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe> -->
                        <?php if($fetch_heading->video2){ ?>
                        <video muted loop autoplay src="">

                        </video>
                    <?php } ?>
                        <button type="button" class="video-btn video-my-btn" data="<?php echo url($fetch_heading->video2); ?>">
                            <svg width="86" height="86" viewBox="0 0 86 86" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="43" cy="43" r="42.5" fill="#000" fill-opacity=".27" stroke="#fff"/>
                                <path d="m35 29 21 14-21 14V29Z" fill="#fff"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section-space">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mx-auto">
                    <div class="title text-center">
                    <h2><?php echo $fetch_heading->heading3 ?$fetch_heading->heading3:""; ?></h2>
                        <p><?php echo $fetch_heading->description3 ?$fetch_heading->description3:""; ?></p>
                    </div>
                </div>
            </div>
            <div class="row gx-sm-5 gy-3">
                <?php
                    if(is_array($all_value) || is_object($all_value))
                    {
                        foreach ($all_value as $value) {
                ?>
                <div class="col-lg-4 col-sm-6 col-12 pe-lg-5">
                    <div class="value-block">
                        <img src="<?php echo url($value->image ? $value->image : $noImage); ?>"  alt="<?php echo $value->title ?$value->title:""; ?>" />
                        <h4><?php echo $value->title ?$value->title:""; ?></h4>
                        <p><?php echo $value->description ?$value->description:""; ?></p>
                    </div>
                </div>
                <?php } } ?>

            </div>
        </div>
    </section>
    <?php if($fetch_heading){ ?>
    <section class="section-space pt-0">
        <div class="full-image bottom-gradient position-relative">
        <img src="<?php echo url($fetch_heading->image4 ? $fetch_heading->image4 : $noImage); ?>"  alt="<?php echo $fetch_heading->heading4 ? $fetch_heading->heading4:""; ?>" />
            <div class="title float text-white text-center section-space pb-0">
            <h2><?php echo $fetch_heading->heading4 ?$fetch_heading->heading4:""; ?></h2>
            </div>
        </div>
        <div class="container up-shift">
            <div class="section-content text-center">
            <?php echo $fetch_heading->description4 ?$fetch_heading->description4:""; ?>
                <a href="<?php echo url('sustainability'); ?>" class="btn">Learn More</a>
            </div>
        </div>
    </section>
    <?php } ?>
    <?php if($fetch_heading){ ?>
    <section class="section-space pt-0">
        <div class="container">
            <div class="row ">
                <div class="col-md-12">
                    <div class="cta-section" style="background-image: url(<?php echo url($fetch_heading->image5 ? $fetch_heading->image5 : $noImage); ?>)">
                        <a href="<?php echo url('leadership'); ?>">
                            <div class="title">
                                <h2><?php echo $fetch_heading->heading5 ?$fetch_heading->heading5:""; ?></h2>
                                <p> <?php echo $fetch_heading->description5 ?$fetch_heading->description5:""; ?></p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php } ?>
    <script>
        //Youtube Video Btn
        // youtube-video-btn
// $(".video-my-btn").click(function(){
//   let videoId = $(this).attr("data");
//   $(this).prev().attr("src",`${videoId}`)
//   $('.video-my-btn').style ="display :none !important";
//   $('.video-btn-img').style ="display:none !important";
// })
        </script>
    @endsection
