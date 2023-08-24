@extends("layouts.layout")
@section('page')
<?php if($fetch_blog){ ?>
    <section class="title-section">
        <img src="<?php echo url($fetch_blog->image ? $fetch_blog->image : $noImage); ?>" alt="banner" />
        <!--<div class="title-holder blog-detail">-->
        <!--    <div class="container">-->
        <!--        <h1><?php echo $fetch_blog->short_description ?$fetch_blog->short_description:""; ?></h1>-->
        <!--    </div>-->
        <!--</div>-->
    </section>
    <?php } ?>
    <section class="section-space">
        <div class="container">
            <div class="col-md-10 mx-auto">
                <div class="blog-content">
                    <div class="title">
                        <h1><?php echo $fetch_blog->title ?$fetch_blog->title:""; ?></h1>
                    </div>
                    <div class="blog-date">Published on : <span> <?php echo date('M d,Y', strtotime($fetch_blog->publish_date)); ?></span></div>
                    <div class="sharethis-inline-share-buttons"></div>
                    <?php echo $fetch_blog->description ?$fetch_blog->description:""; ?>
                </div>
            </div>
        </div>
    </section>
    <section class="section-space pt-0">
        <div class="container">
            <hr class="mb-5"/>
            <div class="title text-center">
                <h2>Related Blogs</h2>
            </div>
            <div class="row g-5" data-cues="slideInUp">
            <?php if(is_array($all_related_blog) || is_object($all_related_blog)){
                        foreach ($all_related_blog as $blogs) {
                      ?>
                <div class="col-md-4">
                    <div class="blog-block type2">
                        <div class="img-box">
                        <a href="<?php echo url('blog-details/'.$blogs->slug); ?>">
                                <img src="<?php echo url($blogs->thumbnail ? $blogs->thumbnail : $noImage); ?>" alt="<?php echo $blogs->title ?$blogs->title:""; ?>" decoding="async" loading="lazy"
                                />
                            </a>
                        </div>
                        <div class="content">
                            <div class="row py-3">
                                <div class="col tag">
                                <?php echo $blogs->category_name ?$blogs->category_name:""; ?>
                                </div>
                                <div class="col text-end">
                                <?php echo date('M d,Y', strtotime($blogs->publish_date)); ?>
                                </div>
                            </div>
                            <h3><a href="<?php echo url('blog-details/'.$blogs->slug); ?>"><?php echo $blogs->title ?$blogs->title:""; ?></a></h3>
                            <a href="<?php echo url('blog-details/'.$blogs->slug); ?>">Read More</a>
                        </div>
                    </div>
                </div>
                <?php } } ?>


            </div>
        </div>
    </section>
    @endsection
    <script type="text/javascript" src="https://platform-api.sharethis.com/js/sharethis.js#property=64ba47e299ed020012e4a094&product=inline-share-buttons&source=platform" async="async"></script>
