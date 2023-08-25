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

    <section class="section-space">
        <div class="container">
            <div class="row">
            <div class="col-md-8 mx-auto position-relative mb-5">
                    <div class="swiper product-slider small">
                        <div class="swiper-wrapper">
                            <?php
                                if(is_array($all_product) || is_object($all_product))
                                {
                                    foreach ($all_product as $product) {
                            ?>
                            <div class="swiper-slide">
                                <div class="product-block small">
                                    <div class="img-box">
                                        <a href="<?php echo url('products#sunshield'.$product->id) ?>">
                                            <img src="<?php echo url($product->thumbnail ? $product->thumbnail : $noImage); ?>" alt="<?php echo $product->name ?$product->name:""; ?>" decoding="async" loading="lazy"/>
                                        </a>
                                    </div>
                                    <div class="content">
                                        <h3><?php echo $product->name ?$product->name:""; ?></h3>
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
                <div class="col-md-12 vice-versa-content">
                <?php
                                if(is_array($all_product) || is_object($all_product))
                                {
                                    foreach ($all_product as $productDetails) {
                            ?>
                    <div class="row align-items-center justify-content-between">
                        <div class="scroll-position" id="sunshield<?php echo $productDetails->id; ?>"></div>
                        <div class="col-md-6 full-image">
                            <img src="<?php echo url($productDetails->image ? $productDetails->image : $noImage); ?>" alt="image" />
                        </div>
                        <div class="col-md-6 ps-5">
                            <div class="title medium">
                                <h2><?php echo $productDetails->name ?$productDetails->name:""; ?></h2>
                                <p><?php echo $productDetails->short_description ?$productDetails->short_description:""; ?></p>
                                <a href="#" class="btn mt-4">Learn More</a>
                            </div>
                        </div>
                    </div>
                    <?php } } ?>
                </div>
            </div>
        </div>
    </section>

    <section class="section-space pt-0">
        <div class="container">
            <div class="row">
                <div class="col-md-7 mx-auto">
                    <div class="title text-center mb-0">
                        <h2>Looking for a Better Solution?</h2>
                        <a href="<?php echo url('contact-us'); ?>" class="btn mt-4">Contact Us</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endsection
