@extends("layouts.layout")
@section('page')
    <section class="section-space">
        <div class="container">
            <div class="row">
                <div class="col-md-7 pe-5">
                    <div class="title">
                        <h2><?php echo $fetch_blog->title ? $fetch_blog->title:"";  ?></h2>
                    </div>
                    <div class="career-info">
                    <?php echo $fetch_blog->description ? $fetch_blog->description:"";  ?>
                    </div>
                    <div class="career-info">
                        <h3>Requirements</h3>
                        <ul class="no-style">
                            <li>Qualification : <?php echo $fetch_blog->qualification ? $fetch_blog->qualification:"";  ?></li>
                            <li>Industry : <?php echo $fetch_blog->industry ? $fetch_blog->industry:"";  ?></li>
                            <li>Experience : <?php echo $fetch_blog->experience ? $fetch_blog->experience:"";  ?></li>
                            <li>Category: <?php echo $fetch_blog->category_name ? $fetch_blog->category_name:"";  ?></li>
                            <li>Skills : <?php echo $fetch_blog->skills ? $fetch_blog->skills:"";  ?></li>
                            <li>Remuneration : <?php echo $fetch_blog->remuneration ? $fetch_blog->remuneration:"";  ?></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="gray-bg p-5">
                        <p>Please use this form to apply for this position. LR HR will review your application and if shortlisted you will receive a call very soon.</p>
                        <form action="" class="mt-4">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">Full Name*</label>
                                        <input type="text" placeholder="Full Name" class="form-control" required="">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">Email*</label>
                                        <input type="email" placeholder="Email" class="form-control" required="">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">Phone*</label>
                                        <input type="tel" placeholder="Phone" class="form-control" required="">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">Position</label>
                                        <select class="form-select">
                                            <option value="1">Manager</option>
                                            <option value="2">CFO</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <button type="submit" class="btn">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endsection
