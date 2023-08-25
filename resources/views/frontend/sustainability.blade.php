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
    <?php if(count($all_sustainability)>=1){ ?>
    <section class="section-space">
        <div class="container">
            <div class="row">
                <div class="section-content text-center">
                <h3><?php echo $fetch_heading->heading1 ? $fetch_heading->heading1 :"";  ?></h3>
                <p><?php echo $fetch_heading->description1 ? $fetch_heading->description1 :"";  ?></p>
                </div>
            </div>
            <div class="row gy-sm-0 gy-4 mt-5">
            <?php
                if(is_array($all_sustainability) || is_object($all_sustainability))
                {
                    foreach ($all_sustainability as $sustainability) {

            ?>
                <div class="col-lg-4 col-sm-6 col-12">
                    <div class="sustainability-block">
                    <img src="<?php echo url($sustainability->image ? $sustainability->image : $noImage); ?>" alt="image" />
                        <div class="content">
                        <h4><?php echo $sustainability->name ? $sustainability->name :"";  ?></h4>
                        <p><?php echo $sustainability->description ? $sustainability->description :"";  ?></p>
                        </div>
                    </div>
                </div>
                <?php } } ?>

            </div>
        </div>
    </section>
    <?php } ?>
    <?php if($fetch_heading){ ?>
    <section class="section-space py-0">
        <div class="container section-bg section-space" style="background-image:url(<?php echo url($fetch_heading->image2 ? $fetch_heading->image2 : $noImage); ?>)">
            <div class="col-lg-6 col-sm-10 col-12 ps-sm-5 ps-3">
                <div class="title pt-3 medium">
                <h2><?php echo $fetch_heading->heading2 ? $fetch_heading->heading2 :"";  ?></h2>
                <p><?php echo $fetch_heading->description2 ? $fetch_heading->description2 :"";  ?></p>
                </div>
            </div>
        </div>
    </section>
    <?php } ?>
    <?php if(count($all_sustainability_goals)>=1){ ?>
    <section class="section-space">
        <div class="container">
            <div class="title text-center">
            <h2><?php echo $fetch_heading->heading3 ? $fetch_heading->heading3 :"";  ?></h2>
            </div>
            <div class="row mt-4 gy-4">
            <?php
                if(is_array($all_sustainability_goals) || is_object($all_sustainability_goals))
                {
                    foreach ($all_sustainability_goals as $sustainability_goals) {

            ?>
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="full-image">
                                <img src="<?php echo url($sustainability_goals->image ? $sustainability_goals->image : $noImage); ?>" alt="goal" />
                            </div>
                        </div>
                        <div class="col-md-8 ps-sm-5">
                            <div class="title pt-3">
                                <h4><?php echo $sustainability_goals->name ? $sustainability_goals->name :"";  ?></h4>
                                <p><?php echo $sustainability_goals->description ? $sustainability_goals->description :"";  ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } } ?>


            </div>
        </div>
    </section>
    <?php } ?>
    @endsection
