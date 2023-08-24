<!DOCTYPE html>
<html dir="ltr" lang="en">
<head>
<meta charset="UTF-8" />
<title><?php echo $page_title; ?></title>
<base href="<?php echo url(''); ?>/">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
<meta name="description" content="">
<meta name="keywords" content="">
<meta name="author" content="Cyberworx">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="<?php echo config('app.ADMIN_CATALOG'); ?>stylesheet/bootstrap.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="<?php echo config('app.ADMIN_CATALOG'); ?>javascript/jquery/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="<?php echo config('app.ADMIN_CATALOG'); ?>javascript/bootstrap/js/bootstrap.min.js"></script>
<link href="<?php echo config('app.ADMIN_CATALOG'); ?>javascript/font-awesome/css/font-awesome.min.css" type="text/css" rel="stylesheet" />
<script src="<?php echo config('app.ADMIN_CATALOG'); ?>javascript/jquery/datetimepicker/moment/moment.min.js" type="text/javascript"></script>
<script src="<?php echo config('app.ADMIN_CATALOG'); ?>javascript/jquery/datetimepicker/moment/moment-with-locales.min.js" type="text/javascript"></script>
<script src="<?php echo config('app.ADMIN_CATALOG'); ?>javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
<link href="<?php echo config('app.ADMIN_CATALOG'); ?>javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.css" type="text/css" rel="stylesheet" media="screen" />
<link type="text/css" href="<?php echo config('app.ADMIN_CATALOG'); ?>stylesheet/stylesheet.css" rel="stylesheet" media="screen" />
<link type="text/css" href="<?php echo config('app.CATALOG'); ?>css/toastr.css" rel="stylesheet" />
 <script src="<?php echo config('app.ADMIN_CATALOG'); ?>javascript/common.js" type="text/javascript"></script>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->

<!-- ckeditor -->
<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
<!-- select 2 -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

<!-- datatable -->
<link href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css" rel="stylesheet" />

<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>

<link type="text/css" href="<?php echo config('app.ADMIN_CATALOG'); ?>stylesheet/custom.css" rel="stylesheet" media="screen" />

 </head>

<?php
use Illuminate\Support\Facades\DB;

$setting = DB::table('setting')->where('code','config')->get();
        foreach ($setting as $key => $value) {
          $config[$value->key] = $value->value;
        }
 $userr = DB::table('admin')->where('id',session('adminID'))->first();

 ?>


 <body>
  <div id="container">
   <header id="header" class="navbar navbar-static-top">
    <div class="container-fluid">
     <div id="header-logo" class="navbar-header">
      <a href="<?php echo url('admin/dashboard'); ?>" class="navbar-brand">
      <img src="<?php echo url($config['config_logo']); ?>" alt="cyberworx" title="cyberworx" style="margin-top: -16px;" /></a>
     </div>
     <a href="#" id="button-menu" class="hidden-md hidden-lg"><span class="fa fa-bars"></span></a>

     <ul class="nav navbar-nav navbar-right">
      <li class="dropdown">
       <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <img src="<?php echo url($userr->photo); ?>" alt="<?php echo $userr->username; ?>" title="admin" id="user-profile" class="img-circle"  style="width: 50px;" /><?php echo $userr->username; ?> <i class="fa fa-caret-down fa-fw"></i>
       </a>
       <ul class="dropdown-menu dropdown-menu-right">
        <li>
         <a href="<?php echo url('admin/profile'); ?>"><i class="fa fa-user-circle-o fa-fw"></i> Your Profile</a>
        </li>

        <li>
         <a href="<?php echo url('home'); ?>" target="_blank"><i class="fa fa-dashboard fa-fw"></i> Website Homepage</a>
        </li>

       </ul>
      </li>
      <li>
       <a href="<?php echo url('admin/logout'); ?>"><i class="fa fa-sign-out"></i> <span class="hidden-xs hidden-sm hidden-md">Logout</span></a>
      </li>
     </ul>
    </div>
   </header>
   <nav id="column-left">
    <div id="navigation"><span class="fa fa-bars"></span> Navigation</div>
    <ul id="menu">


<?php
use App\Models\CommonModel;
$AdminModel = new CommonModel();

$menu = $AdminModel->all_fetch('menu',array('parent_id'=>0,'status'=>1),'sort_order','asc');

foreach ($menu as $key => $value) {
  $level1 = $AdminModel->all_fetch('menu',array('parent_id'=>$value->id,'status'=>1),'sort_order','asc');

  if (!empty($level1) && count($level1) >0) { ?>


      <li id="menu-catalog">
      <a href="#collapse<?php echo $value->id; ?>" data-toggle="collapse" class="parent collapsed"><?php echo $value->fafa; ?> <?php echo $value->name; ?></a>
       <ul id="collapse<?php echo $value->id; ?>" class="collapse">

      <?php foreach ($level1 as $key => $l1) {?>


          <?php
          $level2  =  $AdminModel->all_fetch('menu',array('parent_id'=>$l1->id,'status'=>1),'sort_order','asc');

       if (!empty($level2) && count($level2) > 0) {?>

         <li>
          <a href="#collapse<?php echo $l1->id;?>" data-toggle="collapse" class="parent collapsed"><?php echo $l1->name; ?></a>
          <ul id="collapse<?php echo $l1->id;?>" class="collapse">
          <?php foreach ($level2 as $key => $l2) { if (@$AdminModel->hasPermission($l2->id)) {?>

           <li><a href="<?php echo url($l2->link); ?>"><?php echo $l2->name; ?></a></li>
          <?php } } ?>
          </ul>
         </li>

          <?php }else{ ?>

           <?php if (@$AdminModel->hasPermission($l1->id)) {?>
           <li><a href="<?php echo url($l1->link); ?>"><?php echo $l1->name; ?></a></li>

        <?php } } ?>
      <?php }  ?>
      </ul>

     </li>


  <?php }else{?>


     <li id="menu-dashboard">
      <a href="<?php echo url($value->link); ?>"><?php echo $value->fafa; ?> <?php echo $value->name; ?></a>
     </li>

  <?php  } ?>


<?php } ?>


    </ul>

 </nav>


@section('page')
@show


@section('javascript')
@show



<script type="text/javascript" src="<?php echo config('app.ADMIN_CATALOG'); ?>javascript/summernote/summernote.js"></script>
 <link href="<?php echo config('app.ADMIN_CATALOG'); ?>javascript/summernote/summernote.css" rel="stylesheet" />
 <script type="text/javascript" src="<?php echo config('app.ADMIN_CATALOG'); ?>javascript/summernote/summernote-image-attributes.js"></script>
 <script type="text/javascript" src="<?php echo config('app.ADMIN_CATALOG'); ?>javascript/summernote/opencart.js"></script>
  <script type="text/javascript" src="<?php echo config('app.CATALOG'); ?>js/toastr.min.js"></script>

<script type="text/javascript">
  $(document).ready(function() {
    $('#example').DataTable();
} );
</script>

<script type="text/javascript">
CKEDITOR.replace( 'ckeditor' );
$(document).ready(function() {
    $('.multiple').select2();
});

// CKEDITOR.replace( 'ckeditor' );
 $('#summernote').summernote({
    height: ($(window).height() - 300),
    callbacks: {
        onImageUpload: function(image) {
            uploadImage(image[0]);
        }
    }
});

function uploadImage(image) {
    var data = new FormData();
    data.append("image", image);
    $.ajax({
        url: "<?php echo url('admin/cms/upload_image'); ?>",
        cache: false,
        contentType: false,
        processData: false,
        data: data,
        type: "post",
        success: function(url) {
              var image = $('<img>').attr('src',url);
            $('#summernote').summernote("insertNode", image[0]);
        },
        error: function(data) {
            console.log(data);
        }
    });
}

</script>


<footer id="footer"><a href="">Cyberworx</a> &copy; 2019-<?php echo date('Y'); ?> All Rights Reserved.</footer></div>
<style>
    .toast-top-right .toast {
    background-color: #1d1d1d !important;
    box-shadow: 0 0 12px #484848 !important;
    border: 1px solid #3a3a3a;
}
</style>

</body>
</html>
