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
            </div>
        </div>
    </section>
    <?php } ?>
    <?php if(count($all_quality_assurance) >= 1){ ?>
    <section class="section-space">
        <div class="container">
            <div class="row align-items-center justify-content-between mb-5">
                <div class="col-md-5 full-image">
                    <div class="quote-box-title">
                    <h3><?php echo $fetch_heading->heading1 ? $fetch_heading->heading1 :"";  ?></h3>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="title">
                    <p><?php echo $fetch_heading->description1 ? $fetch_heading->description1 :"";  ?></p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 vice-versa-content">
                <?php
                if(is_array($all_quality_assurance) || is_object($all_quality_assurance))
                {
                    foreach ($all_quality_assurance as $quality_assurance) {

            ?>
                    <div class="row align-items-center justify-content-between">
                        <div class="col-md-5 full-image">
                            <img src="<?php echo url($quality_assurance->image ? $quality_assurance->image : $noImage); ?>" alt="image" />
                        </div>
                        <div class="col-md-6">
                            <div class="title">
                                <h2><?php echo $quality_assurance->title ? $quality_assurance->title :"";  ?></h2>
                                <p><?php echo $quality_assurance->description ? $quality_assurance->description :"";  ?></p>
                            </div>
                        </div>
                    </div>
                    <?php } } ?>

                </div>
            </div>
        </div>
    </section>
    <?php }  ?>
    <?php if(count($all_quality_industry_association) >= 1){ ?>
    <section class="section-space pt-0">
        <div class="container">
            <div class="row">
                <div class="col-md-7 mx-auto">
                    <div class="title text-center">
                    <h2><?php echo $fetch_heading->heading2 ? $fetch_heading->heading2 :"";  ?></h2>
                    <p class="px-5"><?php echo $fetch_heading->description2 ? $fetch_heading->description2 :"";  ?></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="swiper industry-slider">
            <div class="swiper-wrapper">
            <?php
                if(is_array($all_quality_industry_association) || is_object($all_quality_industry_association))
                {
                    foreach ($all_quality_industry_association as $quality_industry_association) {

            ?>
                <div class="swiper-slide">
                    <div class="industry-logo-block">
                        <img src="<?php echo url($quality_industry_association->image ? $quality_industry_association->image : $noImage); ?>" alt="<?php echo $quality_industry_association->name ? $quality_industry_association->name :"";  ?>" />
                    </div>
                </div>
                <?php } } ?>

            </div>
        </div>
    </section>
    <?php }  ?>
    @endsection
