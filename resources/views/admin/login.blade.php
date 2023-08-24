
<!DOCTYPE html>
<html dir="ltr" lang="en">
<head>
<meta charset="UTF-8" />
<title><?php echo $page_title; ?></title>
<base href="<?php echo url(''); ?>/" id="base" data-base="<?php echo url(''); ?>/" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
<script type="text/javascript" src="<?php echo config('app.ADMIN_CATALOG'); ?>javascript/jquery/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="<?php echo config('app.ADMIN_CATALOG'); ?>javascript/bootstrap/js/bootstrap.min.js"></script>
<link href="<?php echo config('app.ADMIN_CATALOG'); ?>stylesheet/bootstrap.css" type="text/css" rel="stylesheet" />
<link href="<?php echo config('app.ADMIN_CATALOG'); ?>javascript/font-awesome/css/font-awesome.min.css" type="text/css" rel="stylesheet" />
<script src="<?php echo config('app.ADMIN_CATALOG'); ?>javascript/jquery/datetimepicker/moment/moment.min.js" type="text/javascript"></script>
<script src="<?php echo config('app.ADMIN_CATALOG'); ?>javascript/jquery/datetimepicker/moment/moment-with-locales.min.js" type="text/javascript"></script>
<script src="<?php echo config('app.ADMIN_CATALOG'); ?>javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
<link href="<?php echo config('app.ADMIN_CATALOG'); ?>javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.css" type="text/css" rel="stylesheet" media="screen" />
<link type="text/css" href="<?php echo config('app.ADMIN_CATALOG'); ?>stylesheet/stylesheet.css" rel="stylesheet" media="screen" />
<link type="text/css" href="<?php echo config('app.ADMIN_CATALOG'); ?>stylesheet/toastr.css" rel="stylesheet" media="screen" />

<script src="<?php echo config('app.ADMIN_CATALOG'); ?>javascript/common.js" type="text/javascript"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
<div id="container">
<header id="" class="navbar navbar-static-top text-center">
  <div class="container-fluid">


    <div id="header-logo" class="navbar-header">
    <a href="<?php echo url(''); ?>" class="navbar-brand">
    <img src="<?php echo config('app.CATALOG'); ?>images/logo.svg" alt="logo" title="cyberworx" style="margin-left: 548px;margin-top: 45px;  " /></a>
  </div>
    <a href="#" id="button-menu" class="hidden-md hidden-lg"><span class="fa fa-bars"></span></a> </div>
</header>

<div id="content">
  <div class="container-fluid"><br />
    <br />
    <div class="row">
      <div class="col-sm-offset-4 col-sm-4">
        <div class="panel panel-default" style="margin-top: 35px;">
          <div class="panel-heading">
            <h1 class="panel-title"><i class="fa fa-lock"></i> Please enter your login details.</h1>
          </div>
          <div class="panel-body">

            <form id="Login_Form">
              @csrf

              <div class="form-group">
                <label for="input-username">Username</label>
                <div class="input-group"><span class="input-group-addon"><i class="fa fa-user"></i></span>
                  <input type="text" name="username" placeholder="Username" id="input-username" class="form-control" autocomplete="off" />
                </div>

              </div>

           <div class="form-group">
                <label for="input-password">Password</label>
                <div class="input-group"><span class="input-group-addon"><i class="fa fa-lock"></i></span>
                  <input type="password" name="password"  placeholder="Password" id="input-password" class="form-control"  autocomplete="off" />
                </div>

             <!-- <span class="help-block"><a href="">Forgotten Password</a></span> -->
         </div>

            <div class="text-right">
              <button type="submit" class="btn btn-primary"><i class="fa fa-key"></i> Login</button>
            </div>


          </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="<?php echo config('app.ADMIN_CATALOG'); ?>javascript/jquery/toastr.min.js" type="text/javascript"></script>
<script src="<?php echo config('app.ADMIN_CATALOG'); ?>javascript/Login.js" type="text/javascript"></script>
<footer id="footer"><a href="">Cyberworx</a> &copy; 2009-<?php echo date('Y'); ?> All Rights Reserved.</footer></div>
</body>
</html>
