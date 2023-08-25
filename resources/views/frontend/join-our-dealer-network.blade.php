@extends("layouts.layout")
@section('page')
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

<?php if ($fetch_heading) { ?>
    <section class="section-space">
        <div class="container">
            <div class="title medium-desp mb-5">
                <p><?php echo $fetch_heading->description1 ? $fetch_heading->description1 : "";  ?></p>
            </div>
            <div class="bullet-list">
                <?php $list = explode("@", $fetch_heading->description2);  ?>
                <ul>
                    <?php foreach ($list as $key => $value) {

                    ?>
                        <li><?php echo $value; ?></li>
                    <?php } ?>

                </ul>
            </div>
        </div>
    </section>
<?php } ?>
<section class="section-space pt-0 pt-lg-5">
    <div class="container">
        <div class="gray-bg p-sm-5 p-4">
            <div class="title small px-xl-5">
                <h2>Dealer Application Form</h2>
            </div>
            <form action="<?php echo url('joinDealer'); ?>" method="POST" enctype="multipart/form-data" class="px-xl-5">
                @if(session()->has('success'))
                <div class="alert alert-success">
                    <strong> {{ session()->get('success') }}</strong> </a>
                </div>
                @endif

                @if(session()->has('error'))
                <div class="alert alert-danger">
                    <strong> {{ session()->get('error') }}</strong> </a>
                </div>
                @endif
                @csrf
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <div class="form-group">
                            <label class="form-label">I am interested in*</label>
                            <div>
                                <?php if(is_array($all_solution) || is_object($all_solution))
                                    foreach ($all_solution as $solution) {

                                ?>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="interest_in[]" id="inlineCheckbox<?php echo $solution->id; ?>" value="<?php echo $solution->title; ?>">
                                    <label class="form-check-label" for="inlineCheckbox<?php echo $solution->id; ?>"><?php echo $solution->title; ?></label>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">First Name</label>
                            <input type="text" name="first_name" placeholder="First Name" class="form-control" required="">
                            @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Last Name</label>
                            <input type="text" name="last_name" placeholder="Last Name" class="form-control" required="">
                            @error('last_name')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" placeholder="Email" class="form-control" required="">
                            @error('email')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Phone</label>
                            <input type="tel" name="number" placeholder="Phone" class="form-control" required="">
                            @error('number')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Business Name</label>
                            <input type="text" name="business_name" placeholder="Business Name" class="form-control" required="">
                            @error('business_name')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Business Address</label>
                            <input type="text" name="business_address" placeholder="Business Address" class="form-control" required="">
                            @error('business_address')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Business Experience</label>
                            <input type="text" name="business_experience" placeholder="Business Experience" class="form-control" required="">
                            @error('business_experience')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">City</label>
                            <select class="form-select" name="city">
                                <option value="New Delhi">New Delhi</option>
                                <option value="Mumbai">Mumbai</option>
                            </select>
                            @error('city')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="upload-btn">
                                <svg width="15" height="17" viewBox="0 0 15 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="m12.585 8.924-5.033 5.041A3.461 3.461 0 0 1 2.666 9.08L9.18 2.564a2.093 2.093 0 0 1 2.883 0 2.052 2.052 0 0 1 0 2.883l-5.62 5.61a.621.621 0 1 1-.912-.846L9.71 6.04a.818.818 0 0 0-1.156-1.156L4.376 9.07a2.232 2.232 0 0 0 0 3.168 2.297 2.297 0 0 0 3.168 0l5.611-5.62a3.665 3.665 0 0 0-5.18-5.18L1.462 7.956a5.09 5.09 0 0 0 7.24 7.142l5.04-5.033a.816.816 0 0 0-.578-1.396.818.818 0 0 0-.578.24v.016Z" fill="#525252" />
                                </svg>
                                Upload Photo
                                <input type="file" name="image" class="d-none" accept=".jpg,.png,.jpeg,.gif,.webp" />
                            </label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox3" name="checkbox" value="checked" required>
                                    <label class="form-check-label consent-line" for="inlineCheckbox3">By submitting this form, you hereby agree to the terms and conditions.</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 d-grid">
                        <button type="submit" class="btn">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
