@extends("layouts.layout")
@section('page')
<?php
use Illuminate\Support\Facades\DB;
?>
<?php if ($fetch_banner) { ?>
    <section class="title-section">
        <img src="<?php echo url($fetch_banner->image ? $fetch_banner->image : $noImage); ?>" alt="banner" />
        <div class="title-holder">
            <div class="container">
                <svg width="756" height="140" viewBox="0 0 756 140" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M.217 139.046c118.686-76.44 435.823-184.133 754.881-3.392C636.151 32.617 318.647-110.957.217 139.046Z" fill="#ED2C3F" />
                </svg>
                <h2><?php echo $fetch_banner->subTitle ? $fetch_banner->subTitle : ""; ?></h2>
            </div>
        </div>
    </section>
<?php } ?>
<section class="section-space pb-0">
    <div class="container text-center">
        <ul class="nav d-inline-flex justify-content-center theme-tab-panel" id="pills-tab" role="tablist">
            <?php if (is_array($all_solution) || is_object($all_solution)) {
                $i = 0;
                foreach ($all_solution as $solutionHeading) {
                    $i++;
            ?>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link <?php echo $i == 1 ? 'active' : ''; ?>" id="pills-home-tab<?php echo $solutionHeading->id ?>" data-bs-toggle="pill" data-bs-target="#pills-home<?php echo $solutionHeading->id ?>" type="button" role="tab" aria-controls="pills-home<?php echo $solutionHeading->id ?>" aria-selected="true"><span><?php echo $solutionHeading->title ?></span></button>
                    </li>
            <?php     }
            } ?>

        </ul>
    </div>
</section>
<div class="tab-content" id="pills-tabContent">
    <?php if (is_array($all_solution) || is_object($all_solution)) {
        $i = 0;
        foreach ($all_solution as $solution) {
            $i++;
            $all_feature = DB ::table('solution_details')->where('solution_id',$solution->id)->orderBy('sort_order',"ASC")->get();
            $all_product = DB ::table('product')->where('solution_id',$solution->id)->orderBy('sort_order',"ASC")->get();
    ?>
            <div class="tab-pane fade <?php echo $i == 1 ? 'show active' : ''; ?>" id="pills-home<?php echo $solution->id ?>" role="tabpanel" aria-labelledby="pills-home-tab<?php echo $solution->id ?>" tabindex="0">
                <section class="section-space">
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-7 mx-auto">
                                <div class="title text-center mb-0">
                                    <h2>Solutions <?php echo $solution->title ? $solution->title : ""; ?></h2>
                                    <p><?php echo $solution->description ? $solution->description : ""; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="section-space py-0">
                    <div class="container">
                        <div class="row" data-cues="slideInUp">
                            <?php
                                if(is_array($all_feature) || is_object($all_feature))
                                {
                                    foreach ($all_feature as $feature) {

                            ?>
                            <div class="col-lg-3 col-sm-6 col-12">
                                <div class="icon-box type2">
                                    <div class="icon">
                                        <img src="<?php echo url($feature->image ? $feature->image : $noImage); ?>" alt="icon" />
                                    </div>
                                    <h5><?php echo $feature->title ? $feature->title : ""; ?></h5>
                                </div>
                            </div>
                            <?php } } ?>

                        </div>
                    </div>
                </section>
                <section class="section-space">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-7">
                                <div class="title">
                                    <h2><?php echo $fetch_heading->heading1 ?$fetch_heading->heading1:"" ; ?></h2>
                                    <p><?php echo $fetch_heading->description1 ?$fetch_heading->description1:"" ; ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="row gy-4">
                        <?php
                                if(is_array($all_product) || is_object($all_product))
                                {
                                    foreach ($all_product as $product) {

                            ?>
                            <div class="col-md-4">
                                <div class="blog-block type2">
                                    <div class="img-box">
                                        <a href="#">
                                            <img src="<?php echo url($product->image ? $product->image : $noImage); ?>" alt="Sunshield" decoding="async" loading="lazy" />
                                        </a>
                                    </div>
                                    <div class="content mt-3">
                                        <h3><a href="#"><?php echo $product->name ? $product->name : ""; ?></a></h3>
                                    </div>
                                </div>
                            </div>
                            <?php } } ?>
                        </div>
                    </div>
                </section>
            </div>
    <?php     }
    } ?>

</div>
<section class="section-space pt-0">
    <div class="container">
        <div class="row">
            <div class="col-md-6 pe-sm-0">
                <div class="cta-box h-100">
                    <h3>Looking for a Solution</h3>
                    <a href="<?php echo url('contact-us') ?>" class="btn">Contact Us</a>
                </div>
            </div>
            <div class="col-md-6 ps-sm-0">
                <div class="cta-box red h-100">
                    <h3>Locate Nearest Dealers</h3>
                    <a href="<?php echo url('join-our-dealer-network') ?>" class="btn white">Locate Dealers</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
