@extends('layouts.master_admin')
@section('page')


<div id="content">
 <div class="page-header">
  <div class="container-fluid">
   <div class="pull-right">
    <button type="submit" form="form-store" data-toggle="tooltip" title="Save" class="btn btn-primary"><i class="fa fa-save"></i></button>
    <a href="<?php echo url('admin/store'); ?>" data-toggle="tooltip" title="Cancel" class="btn btn-default"><i class="fa fa-reply"></i></a>
   </div>
   <h1>Stores</h1>
   <ul class="breadcrumb">
    <li><a href="">Home</a></li>
    <li><a href="">Stores</a></li>
    <li><a href="">Settings</a></li>
   </ul>
  </div>
 </div>
 <div class="container-fluid">
  <div class="panel panel-default">
   <div class="panel-heading">

      <?php if ($success = session()->get('success')): ?>
        <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <strong><?php echo $success; ?></strong> </a>
      </div>
      <?php endif ?>

      <?php if ($error = session()->get('error')): ?>
        <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <strong><?php echo $error; ?></strong> </a>
      </div>
      <?php endif ?>
    <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $page_title; ?></h3>
   </div>
   <div class="panel-body">

     <form action="<?php echo $form_action; ?>" method="post" enctype="multipart/form-data" id="form-user" class="form-horizontal">
      @csrf


     <ul class="nav nav-tabs">
      <li class="active"><a href="#tab-general" data-toggle="tab">General</a></li>
      <li><a href="#tab-store" data-toggle="tab">Store</a></li>
      <!--<li><a href="#tab-local" data-toggle="tab">Local</a></li>-->
       <!--<li><a href="#tab-distributor" data-toggle="tab">Distributer</a></li> -->
      <li><a href="#tab-image" data-toggle="tab">Image</a></li>
      <li><a href="#tab-server" data-toggle="tab">Social</a></li>
       <li><a href="#tab-mail" data-toggle="tab">Mail</a></li>
     </ul>

     <div class="tab-content">
      <div class="tab-pane active" id="tab-general">

       <div class="form-group required">
        <label class="col-sm-2 control-label" for="input-meta-title">Meta Title</label>
        <div class="col-sm-10">
         <input type="text" name="config_meta_title" value="<?php echo $config['config_meta_title']; ?>" placeholder="Meta Title" id="input-meta-title" class="form-control" />
        </div>
       </div>
       <div class="form-group">
        <label class="col-sm-2 control-label" for="input-meta-description">Meta Tag Description</label>
        <div class="col-sm-10">
         <textarea name="config_meta_description" rows="5" placeholder="Meta Tag Description" id="input-meta-description" class="form-control"><?php echo $config['config_meta_description']; ?></textarea>
        </div>
       </div>
       <div class="form-group">
        <label class="col-sm-2 control-label" for="input-meta-keyword">Meta Tag Keywords</label>
        <div class="col-sm-10">
         <textarea name="config_meta_keyword" rows="5" placeholder="Meta Tag Keywords" id="input-meta-keyword" class="form-control"><?php echo $config['config_meta_keyword']; ?></textarea>
        </div>
       </div>



        <div class="form-group">
        <label class="col-sm-2 control-label" for="input-meta-keyword">Tawk To Script</label>
        <div class="col-sm-10">
         <textarea name="config_tawkto" rows="5" placeholder="Tawk To Script" id="input-meta-keyword" class="form-control"><?php echo $config['config_tawkto']; ?></textarea>
        </div>
       </div>


      </div>

      <div class="tab-pane" id="tab-store">

       <div class="form-group required">
        <label class="col-sm-2 control-label" for="input-name">Store Name</label>
        <div class="col-sm-10">
         <input type="text" name="config_name" value="<?php echo $config['config_name']; ?>" placeholder="Store Name" id="input-name" class="form-control" />

             @error('config_name')
                <div class="alert alert-danger">{{ $message }}</div>
              @enderror

        </div>
       </div>

        <div class="form-group">
        <label class="col-sm-2 control-label" for="input-name">Store Breadcum Name</label>
        <div class="col-sm-10">
         <input type="text" name="store_breadcum" value="" placeholder="Store Name" id="input-name" class="form-control" />

        </div>
       </div>

       <div class="form-group">
        <label class="col-sm-2 control-label" for="input-owner">Store Owner</label>
        <div class="col-sm-10">
         <input type="text" name="config_owner" value="<?php echo $config['config_owner']; ?>" placeholder="Store Owner" id="input-owner" class="form-control" />
        </div>
       </div>


         <div class="form-group">
        <label class="col-sm-2 control-label" for="input-name">Invoice Prefix</label>
        <div class="col-sm-10">
         <input type="text" name="invoice_prefix" value="" placeholder="Store Name" id="input-name" class="form-control" />

        </div>
       </div>


       <div class="form-group">
        <label class="col-sm-2 control-label" for="input-owner">GSTIN NO.</label>
        <div class="col-sm-10">
         <input type="text" name="gstin" value="<?php echo @$config['gstin']; ?>" placeholder="GSTIN Number" id="input-owner" class="form-control" />
        </div>
       </div>

      <div class="form-group">
        <label class="col-sm-2 control-label" for="input-owner">PAN NO.</label>
        <div class="col-sm-10">
         <input type="text" name="pan" value="<?php echo @$config['pan']; ?>" placeholder="Pan number" id="input-owner" class="form-control" />
        </div>
       </div>
       <div class="form-group">
        <label class="col-sm-2 control-label" for="input-address">Address</label>
        <div class="col-sm-10">
         <textarea name="config_address" rows="5" placeholder="Address" id="input-address" class="form-control"><?php echo $config['config_address']; ?></textarea>
        </div>
       </div>
       <div class="form-group">
        <label class="col-sm-2 control-label" for="input-geocode"><span data-toggle="tooltip" data-container="#tab-general" title="Please enter your store location geocode manually.">Geocode</span></label>
        <div class="col-sm-10">
         <input type="text" name="config_geocode" value="<?php echo $config['config_geocode']; ?>" placeholder="Geocode" id="input-geocode" class="form-control" />
        </div>
       </div>

        <div class="form-group">
        <label class="col-sm-2 control-label" for="input-geocode"><span data-toggle="tooltip" data-container="#tab-general" title="Please enter your store location geocode manually.">Google Iframe</span></label>
        <div class="col-sm-10">
         <textarea name="config_google_iframe" class="form-control" rows="5"> <?php echo $config['config_google_iframe']; ?></textarea>
        </div>
       </div>


       <div class="form-group">
        <label class="col-sm-2 control-label" for="input-email">E-Mail</label>
        <div class="col-sm-10">
         <input type="text" name="config_email" value="<?php echo $config['config_email']; ?>" placeholder="E-Mail" id="input-email" class="form-control" />
        </div>
       </div>
       <div class="form-group">
        <label class="col-sm-2 control-label" for="input-telephone">Telephone</label>
        <div class="col-sm-10">
         <input type="text" name="config_telephone" value="<?php echo $config['config_telephone']; ?>" placeholder="Telephone" id="input-telephone" class="form-control" />
        </div>
       </div>
       <div class="form-group">
        <label class="col-sm-2 control-label" for="input-fax">Alternate No</label>
        <div class="col-sm-10">
         <input type="text" name="telephone2" value="<?php echo $config['telephone2']; ?>" placeholder="Telephone 2" id="input-fax" class="form-control" />
        </div>
       </div>

       <div class="form-group">
        <label class="col-sm-2 control-label" for="input-open"><span data-toggle="tooltip" title="Fill in your stores opening times.">Opening Times</span></label>
        <div class="col-sm-10">
         <textarea name="config_open" rows="5" placeholder="Opening Times" id="input-open" class="form-control"><?php echo $config['config_open']; ?></textarea>
        </div>
       </div>
       <div class="form-group">
        <label class="col-sm-2 control-label" for="input-comment"><span data-toggle="tooltip" title="This field is for any special notes you would like to tell the customer i.e. Store does not accept cheques.">Comment</span></label>
        <div class="col-sm-10">
         <textarea name="config_comment" rows="5" placeholder="Comment" id="input-comment" class="form-control"><?php echo $config['config_comment']; ?></textarea>
        </div>
       </div>

        <div class="form-group">
        <label class="col-sm-2 control-label" for="input-comment"><span data-toggle="tooltip" title="Footer Note">Footer Note</span></label>
        <div class="col-sm-10">
         <textarea name="config_footer_note" rows="5" placeholder="Comment" id="input-comment" class="form-control"><?php echo $config['config_footer_note']; ?></textarea>
        </div>
       </div>

       <div class="form-group">
        <label class="col-sm-2 control-label" for="input-comment"><span data-toggle="tooltip" title="Copywrite Line">Copywrite</span></label>
        <div class="col-sm-10">
         <textarea name="config_copywrite" rows="5" placeholder="Comment" id="input-comment" class="form-control"><?php echo $config['config_copywrite']; ?></textarea>
        </div>
       </div>

      </div>
      <div class="tab-pane" id="tab-local">
       <div class="form-group">
        <label class="col-sm-2 control-label" for="input-country">Country</label>
        <div class="col-sm-10">
         <select name="config_country_id" id="country_id" class="form-control">

          <option value="">select option </option>
          <?php foreach ($country_list as $key => $value): ?>
           <option value="<?php echo $value->id; ?>" <?php echo $config['config_country_id']==$value->id?'selected':''; ?>><?php echo $value->name; ?></option>
          <?php endforeach ?>
         </select>
        </div>
       </div>
       <div class="form-group">
        <label class="col-sm-2 control-label" for="input-zone">Region / State</label>
        <div class="col-sm-10">
          <select name="config_state_id" id="state_id" class="form-control">
            <?php if (!empty($config['config_state_id'])) {?>
              <?php foreach ($state_list as $key => $value): ?>
                <option value="<?php echo $value->id; ?>" <?php echo $config['config_state_id']==$value->id?'selected':''; ?>><?php echo $value->name; ?></option>
              <?php endforeach ?>
            <?php }else{ ?>
              <option value="">select state</option>
            <?php } ?>
          </select>
        </div>
       </div>




        <div class="form-group">
        <label class="col-sm-2 control-label" for="input-fax"><span data-toggle="tooltip" title="Enter target amount of order when reach then its apply! ">Free COD Shipping</span></label>
        <div class="col-sm-10">
         <input type="text" name="cod_limit" value="<?php echo @$config['cod_limit']; ?>" placeholder="Cod Limit" id="input-fax" class="form-control" />
        </div>
       </div>

        <div class="form-group">
        <label class="col-sm-2 control-label" for="input-fax">COD Shipping Charges</label>
        <div class="col-sm-10">
         <input type="text" name="cod_charges" value="<?php echo @$config['cod_charges']; ?>" placeholder="Cod Shipping charges" id="input-fax" class="form-control" />
        </div>
       </div>

      <div class="form-group">
        <label class="col-sm-2 control-label" for="input-fax">COD Token Type</label>
        <div class="col-sm-10">
         <select name="token_type" class="form-control">
             <option value="P" <?php echo @$config['token_type']=='P'?'selected':'';  ?>>Percentage</option>
             <option value="F" <?php echo @$config['token_type']=='F'?'selected':'';  ?>>Fixed</option>
         </select>
        </div>
       </div>

       <div class="form-group">
        <label class="col-sm-2 control-label" for="input-fax">COD Token Amount </label>
        <div class="col-sm-10">
         <input type="text" name="token_charges" value="<?php echo @$config['token_charges']; ?>" placeholder="100" id="input-fax" class="form-control" />
        </div>
       </div>

       <div class="form-group">
        <label class="col-sm-2 control-label" for="input-fax">COD Token Status </label>
        <div class="col-sm-10">
        <select name="token_status" class="form-control">

          <option value="1" <?php echo @$config['token_status']==1?'selected':''; ?>>Enable</option>
          <option value="0" <?php echo @$config['token_status']=='0'?'selected':''; ?>>Disable</option>
        </select>

        </div>
       </div>

        <div class="form-group">
        <label class="col-sm-2 control-label" for="input-fax">COD Payment Status </label>
        <div class="col-sm-10">
        <select name="cod_status" class="form-control">

          <option value="1" <?php echo @$config['cod_status']==1?'selected':''; ?>>Enable</option>
          <option value="0" <?php echo @$config['cod_status']=='0'?'selected':''; ?>>Disable</option>
        </select>

        </div>
       </div>

        <div class="form-group">
        <label class="col-sm-2 control-label" for="input-fax">Payu Payment Status </label>
        <div class="col-sm-10">
        <select name="payu_status" class="form-control">

          <option value="1" <?php echo @$config['payu_status']==1?'selected':''; ?>>Enable</option>
          <option value="0" <?php echo @$config['payu_status']=='0'?'selected':''; ?>>Disable</option>
        </select>

        </div>
       </div>


       <div class="form-group">
        <label class="col-sm-2 control-label" for="input-fax">COD Checkout General Message </label>
        <div class="col-sm-10">
        <input type="text" name="cod_message" value="<?php echo @$config['cod_message']; ?>" placeholder="" id="input-fax" class="form-control" />

        </div>
       </div>

        <div class="form-group">
        <label class="col-sm-2 control-label" for="input-fax"><span data-toggle="tooltip" title="Enter target amount of order can purchase! ">COD Limit to buy</span></label>
        <div class="col-sm-10">
         <input type="text" name="cod_amount" value="<?php echo @$config['cod_amount']; ?>" placeholder="Cod Limit" id="input-fax" class="form-control" />
        </div>
       </div>


      </div>



      <div class="tab-pane" id="tab-image">
       <div class="form-group">
        <label class="col-sm-2 control-label" for="input-logo">Store Logo</label>
        <div class="col-sm-10">
          <?php if (!empty($config['config_logo'])): ?>
            <img src="<?php echo url($config['config_logo']); ?>" width="100" height="100">
          <?php endif ?>
          <input type="file" name="config_logo" class="form-control" id="input-logo" />
           <input type="hidden" name="old_config_logo" value="<?php echo $config['config_logo'] ?>">
        </div>
       </div>


       <div class="form-group">
        <label class="col-sm-2 control-label" for="input-icon"><span data-toggle="tooltip" title="The icon should be a PNG that is 16px x 16px.">Default Icon</span></label>
        <div class="col-sm-10">

         <?php if (!empty($config['config_icon'])): ?>
            <img src="<?php echo url($config['config_icon']); ?>" width="100" height="100">
          <?php endif ?>

         <input type="file" name="config_icon" class="form-control" id="input-icon" />
         <input type="hidden" name="old_config_icon" value="<?php echo $config['config_icon'] ?>">
        </div>
       </div>

       <div class="form-group">
        <label class="col-sm-2 control-label" for="input-icon"><span data-toggle="tooltip" title="The icon should be a PNG that is 16px x 16px.">Favicon icon</span></label>
        <div class="col-sm-10">

         <?php if (!empty($config['config_favicon'])): ?>
            <img src="<?php echo url($config['config_favicon']); ?>" width="100" height="100">
          <?php endif ?>

         <input type="file" name="config_favicon" class="form-control" id="input-icon" />
         <input type="hidden" name="old_config_favicon" value="<?php echo $config['config_favicon'] ?>">
        </div>
       </div>

         <div class="form-group">
        <label class="col-sm-2 control-label" for="input-icon"><span data-toggle="tooltip" title="The image shown in checkout page">Footer Logo</span></label>
        <div class="col-sm-10">

         <?php if (!empty($config['checkout_image'])): ?>

            <img src="<?php echo url($config['checkout_image']); ?>" width="100" height="100">

          <?php endif ?>

         <input type="file" name="checkout_image" class="form-control" id="input-icon" />
         <input type="hidden" name="old_checkout_image" value="<?php echo @$config['checkout_image'] ?>">
        </div>
       </div>

       <!-- <div class="form-group">-->
       <!-- <label class="col-sm-2 control-label" for="input-icon"><span data-toggle="tooltip" >Checkout image Link</span></label>-->
       <!-- <div class="col-sm-10">-->


       <!--  <input type="text" name="checkout_image_link" class="form-control" id="input-icon" value="<?php echo @$config['checkout_image_link']; ?>" />-->

       <!-- </div>-->
       <!--</div>-->

      </div>
      <div class="tab-pane" id="tab-server">

       <div class="form-group">
        <label class="col-sm-2 control-label">Facebook</label>
        <div class="col-sm-10">
          <input type="text" name="config_facebook" class="form-control" id="input-logo" value="<?php echo $config['config_facebook']; ?>" />
        </div>
       </div>
      <div class="form-group">
        <label class="col-sm-2 control-label">Twitter</label>
        <div class="col-sm-10">
          <input type="text" name="config_twitter" class="form-control" id="input-logo" value="<?php echo $config['config_twitter']; ?>" />
        </div>
       </div>
           <div class="form-group">
        <label class="col-sm-2 control-label">Linkedin</label>
        <div class="col-sm-10">
          <input type="text" name="config_linkedin" class="form-control" id="input-logo" value="<?php echo $config['config_linkedin']; ?>" />
        </div>
       </div>

       <div class="form-group">
        <label class="col-sm-2 control-label">Instagram</label>
        <div class="col-sm-10">
          <input type="text" name="config_instagram" class="form-control" id="input-logo" value="<?php echo $config['config_instagram']; ?>" />
        </div>
       </div>
      <div class="form-group">
        <label class="col-sm-2 control-label">Pinterest</label>
        <div class="col-sm-10">
          <input type="text" name="config_pinterest" class="form-control" id="input-logo" value="<?php echo $config['config_pinterest']; ?>" />
        </div>
       </div>

        <div class="form-group">
        <label class="col-sm-2 control-label">Youtube</label>
        <div class="col-sm-10">
          <input type="text" name="config_youtube" class="form-control" id="input-logo" value="<?php echo $config['config_youtube']; ?>" />
        </div>
       </div>

      <div class="form-group">
        <label class="col-sm-2 control-label">WhatssApp </label>
        <div class="col-sm-10">
          <input type="text" name="whatsapp" class="form-control" value="<?php echo $config['whatsapp']; ?>" />
        </div>
       </div>

      </div>
         <div class="tab-pane" id="tab-mail">
              <fieldset>
                <legend>General</legend>
               <!--  <div class="form-group">
                  <label class="col-sm-2 control-label" for="input-mail-engine"><span data-toggle="tooltip" title="Only choose 'Mail' unless your host has disabled the php mail function.">Mail Engine</span></label>
                  <div class="col-sm-10">
                    <select name="config_mail_engine" id="input-mail-engine" class="form-control">
                      <option value="mail">Mail</option>
                      <option value="smtp">SMTP</option>
                    </select>
                  </div>
                </div> -->
               <div class="form-group">
                  <label class="col-sm-2 control-label" for="input-mail-parameter"><span data-toggle="tooltip" title="This is using for sending for all emails  (e.g. -f email@storeaddress.com).">Sending Email address</span></label>

                  <div class="col-sm-10">
                    <input type="text" name="sending_email" value="<?php echo $config['sending_email']; ?>" placeholder="Mail Parameters" class="form-control" />
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label" for="input-mail-smtp-hostname"><span data-toggle="tooltip" title="Add 'tls://' or 'ssl://' prefix if security connection is required. (e.g. tls://smtp.gmail.com, ssl://smtp.gmail.com).">SMTP Hostname</span></label>
                  <div class="col-sm-10">
                    <input type="text" name="config_mail_smtp_hostname" value="<?php echo $config['config_mail_smtp_hostname']; ?>" placeholder="SMTP Hostname ex: ssl://smtp.gmail.com" id="input-mail-smtp-hostname" class="form-control" />
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label" for="input-mail-smtp-username">SMTP Username</label>
                  <div class="col-sm-10">
                    <input type="text" name="config_mail_smtp_username" value="<?php echo $config['config_mail_smtp_username']; ?>" placeholder="SMTP Username" id="input-mail-smtp-username" class="form-control" />
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label" for="input-mail-smtp-password"><span data-toggle="tooltip" title="For gmail you might need to setup a application specific password here: https://security.google.com/settings/security/apppasswords.">SMTP Password</span></label>
                  <div class="col-sm-10">
                    <input type="text" name="config_mail_smtp_password" value="<?php echo $config['config_mail_smtp_password']; ?>" placeholder="SMTP Password" id="input-mail-smtp-password" class="form-control" />
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label" for="input-mail-smtp-port">SMTP Port</label>
                  <div class="col-sm-10">
                    <input type="text" name="config_mail_smtp_port" value="<?php echo $config['config_mail_smtp_port']; ?>" placeholder="SMTP Port" id="input-mail-smtp-port" class="form-control" />
                  </div>
                </div>

              </fieldset>
            <!--   <fieldset>
                <legend>Mail Alerts</legend>
                <div class="form-group">
                  <label class="col-sm-2 control-label"><span data-toggle="tooltip" title="Select which features you would like to receive an alert email on when a customer uses them.">Alert Mail</span></label>
                  <div class="col-sm-10">
                    <div class="well well-sm" style="height: 150px; overflow: auto;">                       <div class="checkbox">
                        <label>                           <input type="checkbox" name="config_mail_alert[]" value="account" />
                          Register
                           </label>
                      </div>
                                            <div class="checkbox">
                        <label>                           <input type="checkbox" name="config_mail_alert[]" value="affiliate" />
                          Affiliate
                           </label>
                      </div>
                                            <div class="checkbox">
                        <label>                           <input type="checkbox" name="config_mail_alert[]" value="order" checked="checked" />
                          Orders
                           </label>
                      </div>
                                            <div class="checkbox">
                        <label>                           <input type="checkbox" name="config_mail_alert[]" value="review" />
                          Reviews
                           </label>
                      </div>
                       </div>
                  </div>
                </div>

              </fieldset> -->
            </div>
     </div>
    </form>
   </div>
  </div>
 </div>

 <script type="text/javascript">

  $('select#country_id').on('change', function() {
    var val = $(this).val();
    $.ajax({
        url:"<?php echo url('admin/get_state_list'); ?>",
        type:"POST",
        data:{country_id:val},
       success: function(data) {
        var obj = JSON.parse(data);
        if (obj.status==1) {
          $('#state_id').html(obj.ss);
        }else{
          $('#state_id').html(obj.ss);
        }
      },

    });
  });

  //-->
 </script>
</div>


@endSection
