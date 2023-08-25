@extends("layouts.layout")
@section('page')
    <section class="section-space">
        <div class="container">
            <div class="title col-md-6 mx-auto text-center">
                <h2>Current Openings</h2>
                <p>Sunshield has engineered products to exceed expectations in industries across the globe.</p>
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

            <div class="cta-section no-overlay mt-5">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h3>Didn’t find the job matching your profile? Submit your resume directly</h3>
                    </div>
                    <div class="col-md-4 text-sm-end">
                        <a href="#" class="btn white-fill">Submit Now</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endsection
