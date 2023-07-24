@extends('layouts.master_admin')
@section('page')
<?php
use App\Models\CommonModel;
$AdminModel = new CommonModel();

?>

<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-user" data-toggle="tooltip" title="Save" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <a href="<?php echo url('admin/users');?>" data-toggle="tooltip" title="Cancel" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
      <h1>Users</h1>
      <ul class="breadcrumb">
               <li><a href="<?php echo url('admin/dashboard'); ?>">Home</a></li>
        <li><a href="javascript:void();"><?php echo $page_title; ?></a></li>
              </ul>
    </div>
  </div>
  <div class="container-fluid">
        <div class="panel panel-default">
      <div class="panel-heading">
      <?php if ($success = session()->flash('success')): ?>
        <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <strong><?php echo $success; ?></strong> </a>
      </div>
      <?php endif ?>

      <?php if ($error = session()->flash('error')): ?>
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
      
           <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-username">Username</label>
            <div class="col-sm-10">
              <input type="text" name="username" value="<?php echo old('username',$username); ?>" placeholder="Username"  class="form-control" />
               @error('username')
                <div class="alert alert-danger">{{ $message }}</div>
              @enderror
             
           </div>
          </div>

          <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-username">User Type</label>
            <div class="col-sm-10">
             
              <select name="user_group_id" class="form-control" required="required">
                <option value="">Select</option>
                <?php foreach ($user_list as $key => $value): ?>
                  <option value="<?php echo $value->id; ?>" <?php echo $user_group_id==$value->id?'selected':''; ?> ><?php echo $value->name; ?></option>
                <?php endforeach ?>
              </select>

           </div>
          </div>
      
          
          <div class="form-group ">
            <label class="col-sm-2 control-label" for="input-firstname">First Name</label>
            <div class="col-sm-10">
              <input type="text" name="firstname" value="<?php echo old('firstname',$firstname); ?>" placeholder="First Name" class="form-control" />
             @error('firstname')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            </div>
          </div>
          <div class="form-group ">
            <label class="col-sm-2 control-label" for="input-lastname">Last Name</label>
            <div class="col-sm-10">
              <input type="text" name="lastname" value="<?php echo old('lastname',$lastname); ?>" placeholder="Last Name"  class="form-control" />
               
            </div>
          </div>
          <div class="form-group ">
            <label class="col-sm-2 control-label" for="input-email">E-Mail</label>
            <div class="col-sm-10">
              <input type="text" name="email" value="<?php echo old('email',$email); ?>" placeholder="E-Mail"  class="form-control" />

              
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-image">Image</label>
            <div class="col-sm-10">
              <?php if (@$photo): ?>
                <img src="<?php echo url($photo); ?>" width="100" height="100">
              <?php endif ?>
              <input type="file" name="photo"  id="input-image" class="form-control" />
            </div>
          </div>
             <div class="form-group ">
            <label class="col-sm-2 control-label" for="input-password">Password</label>
            <div class="col-sm-10">
              <input type="password" name="password" value="<?php echo old('password'); ?>"  placeholder="Password"  class="form-control" autocomplete="off"  />
              </div>
              
          </div>
          <div class="form-group ">
            <label class="col-sm-2 control-label" for="input-confirm">Confirm</label>
            <div class="col-sm-10">
              <input type="password" name="confirm" value="<?php echo old('confirm'); ?>"  placeholder="Confirm" class="form-control" autocomplete="off" />
             
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-status">Status</label>
            <div class="col-sm-10">
              <select name="status" id="input-status" class="form-control">
                <option value="0" <?php echo $status==0?'selected':''; ?>>Disabled</option>
                <option value="1" <?php echo $status==1?'selected':''; ?>>Enabled</option>
              </select>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endSection