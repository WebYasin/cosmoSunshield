@extends("layouts.master_admin")
@section('page')


<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-attribute" data-toggle="tooltip" title="Save" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <a href="<?php echo url('admin/dashboard'); ?>" data-toggle="tooltip" title="Cancel" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
      <h1><?php echo $page_title; ?></h1>
      <ul class="breadcrumb">
                <li><a href="<?php echo url('admin/dashboard'); ?>">Home</a></li>
<li><a href="javascript:void();"><?php echo $page_title; ?></a></li>
              </ul>
    </div>
  </div>
  <div class="container-fluid">    <div class="panel panel-default">
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
  
        <form action="{{ $form_action }}" method="post" enctype="multipart/form-data" id="form-user" class="form-horizontal">
        @csrf
          

          @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach

          <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-username">Username</label>
            <div class="col-sm-10">
              <input type="text" name="username" value="<?php echo old('username',$detail->username); ?>" placeholder="Username"  class="form-control" />
                @error('username')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                @if ($errors->has('username'))
                    <span class="text-danger">{{ $errors->first('username') }}</span>
                @endif
            
           </div>
          </div>
          <div class="form-group ">
            <label class="col-sm-2 control-label" for="input-firstname">First Name</label>
            <div class="col-sm-10">
              <input type="text" name="firstname" value="<?php echo old('firstname',$detail->firstname); ?>" placeholder="First Name" class="form-control" />
               @error('firstname')
                <div class="alert alert-danger">{{ $message }}</div>
              @enderror
            </div>
          </div>
          <div class="form-group ">
            <label class="col-sm-2 control-label" for="input-lastname">Last Name</label>
            <div class="col-sm-10">
              <input type="text" name="lastname" value="<?php echo old('lastname',$detail->lastname); ?>" placeholder="Last Name"  class="form-control" />
            
            </div>
          </div>
          <div class="form-group ">
            <label class="col-sm-2 control-label" for="input-email">E-Mail</label>
            <div class="col-sm-10">
              <input type="text" name="email" value="<?php echo old('email',$detail->email); ?>" placeholder="E-Mail"  class="form-control" />

               @error('email')
                <div class="alert alert-danger">{{ $message }}</div>
              @enderror
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-image">Image</label>
            <div class="col-sm-10">
              <?php if (@$detail->photo): ?>
                <img src="<?php echo url($detail->photo); ?>" width="100" height="100">
              <?php endif ?>
              <input type="file" name="photo"  id="input-image" class="form-control" />
            </div>
          </div>
          <div class="form-group ">
            <label class="col-sm-2 control-label" for="input-password">Password</label>
            <div class="col-sm-10">
              <input type="password" name="password" value="<?php echo old('password'); ?>"  placeholder="Password"  class="form-control" autocomplete="off"  />

                @error('password')
                <div class="alert alert-danger">{{ $message }}</div>
              @enderror
              
              </div>
              
          </div>
          <div class="form-group ">
            <label class="col-sm-2 control-label" for="input-confirm">Confirm</label>
            <div class="col-sm-10">
              <input type="password" name="confirm" value="<?php echo old('confirm'); ?>"  placeholder="Confirm" class="form-control" autocomplete="off" />

              @error('confirm')
                <div class="alert alert-danger">{{ $message }}</div>
              @enderror
            </div>
          </div>

        
         
        </form>
      </div>
    </div>
  </div>
</div>

 @endsection
