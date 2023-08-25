@extends("layouts.layout")
@section('page')
<section class="section-space">
    <div class="container">
        <div class="row">
            <div class="col-lg-5">
                <div class="title">
                    <h2>Contact Us</h2>
                    <p>Got a question about how to have better meetings with your team? We've got the answers.</p>
                </div>
                <div class="contact-info">
                    <p><a href="tel:+91 011 23453345" class="underline-blue">+91 011 23453345</a> </p>
                    <p><a href="mailto:support@cosmosunshield.com" class="underline-blue">support@cosmosunshield.com</a></p>
                </div>
                <div class="social mb-4">
                    <?php if ($wconfig['config_facebook']) { ?>
                        <a href="<?php echo $wconfig['config_facebook']; ?>" target="_blank">
                            <img src="<?php echo config('app.CATALOG'); ?>images/facebook.png" alt="facebook" />
                        </a>
                    <?php } ?>
                    <?php if ($wconfig['config_twitter']) { ?>
                        <a href="<?php echo $wconfig['config_twitter']; ?>" target="_blank">
                            <img src="<?php echo config('app.CATALOG'); ?>images/twitter.png" alt="twitter" />
                        </a>
                    <?php } ?>
                    <?php if ($wconfig['config_linkedin']) { ?>
                        <a href="<?php echo $wconfig['config_linkedin']; ?>" target="_blank">
                            <img src="<?php echo config('app.CATALOG'); ?>images/linkedin.png" alt="linkedin" />
                        </a>
                    <?php } ?>
                    <?php if ($wconfig['config_youtube']) { ?>
                        <a href="<?php echo $wconfig['config_youtube']; ?>" target="_blank">
                            <img src="<?php echo config('app.CATALOG'); ?>images/youtube.png" alt="youtube" />
                        </a>
                    <?php } ?>
                </div>
                <div class="contact-info small">
                    <p><?php echo $wconfig['config_open']; ?></p>
                </div>
            </div>
            <div class="col-lg-7 mt-lg-0 mt-4">
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
                <form action="<?php echo url('enquiry') ?>" method="POST">
                @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Full Name*</label>
                                <input type="text" name="name" placeholder="Full Name" class="form-control" required />
                                @error('name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Email*</label>
                                <input type="email" name="email" placeholder="Email" class="form-control" required />
                                @error('email')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Phone*</label>
                                <input type="tel" name="number"  placeholder="Phone" class="form-control" required />
                                @error('number')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Looking for</label>
                                <select class="form-select" name="looking_for" >
                                    <?php foreach ($all_solution as $solution) {
                                        ?>

                                    <option value="<?php echo $solution->title; ?>"><?php echo $solution->title; ?></option>
                                    <?php } ?>

                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Message</label>
                                <textarea class="form-control" name="message" placeholder="Message"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row mt-5 pt-4">
            <div class="col-lg-5">
                <div class="title">
                    <h3>Corporate/Regd. Office</h3>
                </div>
                <div class="contact-info">
                    <p><?php echo $wconfig['config_address']; ?></p>
                    <!-- <p>Cosmo Films<br />1008, DLF Tower- A,<br />Jasola District Centre New Delhi- 110025</p> -->
                    <hr />
                    <p>Ph: <a href="tel:<?php echo $wconfig['telephone2']; ?>"><?php echo $wconfig['telephone2']; ?></a> </p>
                    <p>Email: <a href="mailto:<?php echo $wconfig['config_email']; ?>"><?php echo $wconfig['config_email']; ?></a></p>
                </div>
            </div>
            <div class="col-lg-7 mt-lg-0 mt-4">
                <div class="full-map">
                <?php echo $wconfig['config_google_iframe']; ?>
                    <!-- <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3505.0318631700993!2d77.28718207542191!3d28.538761975716138!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390ce401d6a51d87%3A0x66c293a6a4f15f75!2sCosmo%20First%20Limited!5e0!3m2!1sen!2sin!4v1689752566604!5m2!1sen!2sin" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe> -->
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
