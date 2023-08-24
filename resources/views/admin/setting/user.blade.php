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
        <a href="<?php echo url('admin/add_user'); ?>" data-toggle="tooltip" title="Add New" class="btn btn-primary"><i class="fa fa-plus"></i></a> &nbsp;
        <button type="button" data-toggle="tooltip" title="Delete" class="btn btn-danger" onclick="confirm('Are you sure?') ? $('#form-user').submit() : false;"><i class="fa fa-trash-o"></i></button>
      </div>
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
        <h3 class="panel-title"><i class="fa fa-list"></i> User List</h3>
      </div>
      <div class="panel-body">

      <form action="{{ url('admin/delete_users')}}" method="post" enctype="multipart/form-data" id="form-user" class="form-horizontal">
      @csrf

          <div class="table-responsive">
            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  <td style="width: 1px;" class="text-center"><input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" /></td>
                  <td class="text-left">First Name</td>
                  <td class="text-left">Last Name</td>
                  <td class="text-left">Username</td>
                  <!-- <td class="text-left">Email</td> -->
                  <td class="text-left">User Group</td>
                  <td class="text-left">Status</td>
                  <td class="text-left">Date Added </td>
                  <td class="text-left">Action</td>
                </tr>
              </thead>
              <tbody>
                <?php if(!empty($detail)){
                  foreach ($detail as $key => $value) { ?>
                  <tr>
                  <td class="text-center">
                  <input type="checkbox" name="selected[]" value="<?php echo $value->id; ?>" />
                    </td>
                   <td class="text-left"><?= $value->firstname; ?></td>
                    <td class="text-left"><?= $value->lastname; ?></td>
                    <td class="text-left"><?= $value->username; ?></td>
                  <!-- <td class="text-left"><?php echo  $value->email; ?></td> -->
                  <td class="text-left"><?php echo  $user_list[$value->user_group_id]; ?></td>
                  <td class="text-left"><?php echo  $value->status==1?'Active':'Deactive'; ?></td>
                  <td class="text-left"><?php echo  $value->create_date; ?></td>
                  <td class="text-left"><a href="<?php echo url('admin/add_user/'.$value->id); ?>"><button type="button" class="btn btn-info"><i class="fa fa-pencil"></i>&nbsp; Edit</button></a></td>
                </tr>
              <?php } } ?>
              </tbody>
            </table>
          </div>
        </form>

      </div>
    </div>
  </div>
</div>

@endSection

