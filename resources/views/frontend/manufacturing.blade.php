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
                <div class="col-md-6 mx-auto">
                    <div class="title text-center">
                        <h2><?php echo $fetch_heading->heading1 ? $fetch_heading->heading1 :"";  ?></h2>
                        <p><?php echo $fetch_heading->description1 ? $fetch_heading->description1 :"";  ?></p>
                    </div>
                </div>
            </div>
            <div class="row mt-5 justify-content-between align-items-center">
                <div class="col-md-6">
                    <div class="title">
                    <h2><?php echo $fetch_heading->heading2 ? $fetch_heading->heading2 :"";  ?></h2>
                    </div>
                </div>
                <div class="col-md-5">
                <p><?php echo $fetch_heading->description2 ? $fetch_heading->description2 :"";  ?></p>
                </div>
            </div>
            <?php
                if(is_array($all_manufacturing) || is_object($all_manufacturing))
                {
                    foreach ($all_manufacturing as $manufacturing) {

            ?>
            <div class="row justify-content-between mt-5 align-items-center">
                <div class="col-md-4">
                    <div class="contact-info-detail">
                        <h4><?php echo $manufacturing->location ? $manufacturing->location :"";  ?></h4>
                        <h6><?php echo $manufacturing->name ? $manufacturing->name :"";  ?></h6>
                        <p><?php echo $manufacturing->address ? $manufacturing->address :"";  ?> </p>
                        <a href="tel:Ph: <?php echo $manufacturing->contact ? $manufacturing->contact :"";  ?> ">Ph: <?php echo $manufacturing->contact ? $manufacturing->contact :"";  ?> </a>
                    </div>
                </div>
                <div class="col-md-5 full-image">
                    <img src="<?php echo url($manufacturing->image ? $manufacturing->image : $noImage); ?>" alt="<?php echo $manufacturing->location ? $manufacturing->location :"";  ?>" />
                </div>
            </div>
            <?php } } ?>
        </div>
    </section>
    @endsection
