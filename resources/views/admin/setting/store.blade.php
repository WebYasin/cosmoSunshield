@extends('layouts.master_admin')
@section('page')

<div id="content">
  <div class="page-header">
    <div class="container-fluid">
    
      <h1><?php echo $page_title; ?></h1>
      <ul class="breadcrumb">
       <li><a href="<?php echo url('admin/dashboard'); ?>">Home</a></li>
      <li><a href="javascript:void();"><?php echo $page_title; ?></a></li>
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
        <h3 class="panel-title"><i class="fa fa-list"></i> Store List</h3>
      </div>
      <div class="panel-body">
      
        
      <form action="" method="post" enctype="multipart/form-data" id="form-user" class="form-horizontal">
      @csrf

          <div class="table-responsive">
            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  <td style="width: 1px;" class="text-center"><input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" /></td>
                  <td class="text-left">Store Name</td>
                  <td class="text-left">Store Email</td>
                  <td class="text-right">Action</td>
                </tr>
              </thead>
              <tbody>
              
              <?php if (!empty($config)) {?>
                <tr>
                  <td class="text-center"> 
                    <input type="checkbox" name="selected[]" value="0" />
                  </td>
                  <td class="text-left"><?php echo $config['config_name']; ?></td>
                  <td class="text-left"><?php echo $config['config_email']; ?></td>
                  <td class="text-right"><a href="<?php echo url('admin/add_store'); ?>" data-toggle="tooltip" title="Edit" class="btn btn-primary"><i class="fa fa-pencil"></i></a></td>
                </tr>
              <?php } ?>
             </tbody>
            </table>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

@endSection
 