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
    <?php
        if(count($all_feature_blog) >= 1){
    ?>
    <section class="section-space">
        <div class="container">
            <div class="title">
                <h2>Featured Blogs</h2>
            </div>
            <div class="swiper featured-blog-slider">
                <div class="swiper-wrapper">
                    <?php if(is_array($all_feature_blog) || is_object($all_feature_blog)){
                        foreach ($all_feature_blog as $feature_blog) {
                      ?>
                    <div class="swiper-slide">
                        <div class="featured-blog">
                            <img src="<?php echo url($feature_blog->thumbnail ? $feature_blog->thumbnail : $noImage); ?>" alt="featured-blog" />
                            <div class="content">
                                <h2><?php echo $feature_blog->title ?$feature_blog->title:""; ?></h2>
                                <p><?php echo $feature_blog->short_description ?$feature_blog->short_description:""; ?></p>
                                <a href="<?php echo url('blog-details/'.$feature_blog->slug); ?>" class="btn white">Read More</a>
                            </div>
                        </div>
                    </div>
                    <?php } } ?>


                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </section>
    <?php } ?>
    <section class="section-space pt-0">
        <div class="container">
            <div class="title">
                <h2>Latest Blogs</h2>
            </div>
            <div class="row g-5" data-cues="slideInUp">
            <?php if(is_array($all_blogs) || is_object($all_blogs)){
                        foreach ($all_blogs as $blogs) {
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
                <div class="col-md-12 text-center">
                    <!-- <button type="button" class="btn">Load More</button> -->
                    {{ $all_blogs->links() }}
                </div>
            </div>
        </div>
    </section>
@endsection
