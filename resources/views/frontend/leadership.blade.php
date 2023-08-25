@extends("layouts.layout")
@section('page')
<?php if($fetch_heading){ ?>
    <section class="section-space pb-0 position-relative overflow-hidden">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 text-center">
                    <div class="title medium-desp ceo-message">
                        <h2><?php echo $fetch_heading->heading1 ? $fetch_heading->heading1 :"";  ?></h2>
                        <h3><?php echo $fetch_heading->description1 ? $fetch_heading->description1 :"";  ?></h3>
                        <p class="fs-20 text-color name"><?php echo $fetch_heading->name1 ? $fetch_heading->name1 :"";  ?></p>
                        <p class="position"><?php echo $fetch_heading->designation1 ? $fetch_heading->designation1 :"";  ?></p>
                    </div>
                </div>
                <div class="col-lg-4 text-center">
                    <img src="<?php echo url($fetch_heading->image ? $fetch_heading->image : $noImage); ?>" class="img-fluid" alt="" />
                </div>
            </div>
        </div>
        <img src="<?php echo config('app.CATALOG'); ?>images/right-bottom-curve.svg" alt="curve" class="float-element bottom-right" />
    </section>
    <?php } ?>
    <section class="mt-3 section-space pt-g-0">
        <div class="container">
            <div class="row">
                <?php if(is_array($all_team) || is_object($all_team)){
                    foreach ($all_team as $team) {
                  ?>
                <div class="col-md-12">
                    <div class="team-block big">
                        <div class="full-image">
                            <img src="<?php echo url($team->image ? $team->image : $noImage); ?>" alt="sanjay" />
                        </div>
                        <div class="content">
                            <h3><?php echo $team->title ? $team->title :"";  ?></h3>
                            <h6><?php echo $team->designation ? $team->designation :"";  ?></h6>
                            <div class="info">
                                <?php echo $team->description ? $team->description :"";  ?>
                            </div>
                            <!-- <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">More Details</a> -->
                        </div>
                    </div>
                </div>
                <?php } } ?>
                <div class="col-md-4">
                    <div class="team-block">

                    </div>
                </div>
                <div class="col-md-4">

                </div>
                <div class="col-md-4">

                </div>
            </div>
        </div>
    </section>
    @endsection
    <?php if(is_array($all_team) || is_object($all_team)){
                    foreach ($all_team as $team) {
                  ?>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content team-popup-content">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-body section-space px-5">
                <div class="row">
                    <div class="col-md-5 full-image pe-5">
                        <img src="<?php echo url($team->thumbnail ? $team->thumbnail : $noImage); ?>" alt="<?php echo $team->title ? $team->title :"";  ?>" />
                    </div>
                    <div class="col-md-7 pe-5">
                        <h2><?php echo $team->title ? $team->title :"";  ?></h2>
                        <h5><?php echo $team->designation ? $team->designation :"";  ?> </h5>
                        <hr/>
                        <?php echo $team->description ? $team->description :"";  ?>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
    <?php } } ?>
