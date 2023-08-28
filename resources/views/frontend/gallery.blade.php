@extends("layouts.layout")
@section('page')
    <section class="section-space">
        <div class="container">
            <div class="col-lg-5">
                <div class="title mb-0">
                    <h2>Gallery</h2>
                    <p>Got a question about how to have better meetings with your team? We've got the answers.</p>
                </div>
            </div>
        </div>
    </section>
    <section class="section-space pt-0">
        <div class="container">
            <?php if($feature_video){ ?>
            <div class="row mb-sm-5 mb-4">
                <div class="col-md-12">
                    <div class="video-img-box">
                        <img src="<?php echo url($feature_video->image ? $feature_video->image : $noImage); ?>" alt="video-bg" />
                    </div>
                </div>
            </div>
            <?php } ?>
            <div class="row g-sm-5 g-3">
                <?php
                    if(is_array($all_gallery) || is_object($all_gallery))
                    {
                        foreach ($all_gallery as $gallery) {

                ?>
                <div class="col-lg-4 col-sm-6 col-12">
                    <div class="video-img-box mini">
                        <img src="<?php echo url($gallery->image ? $gallery->image : $noImage); ?>" alt="video-bg" />
                    </div>
                </div>
                <?php } } ?>


            </div>
        </div>
    </section>
    @endsection
