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
        <a href="<?php echo url('admin/add_menu'); ?>" data-toggle="tooltip" title="Add New" class="btn btn-primary"><i class="fa fa-plus"></i></a> &nbsp;
        <button type="button" data-toggle="tooltip" title="Delete" class="btn btn-danger" onclick="confirm('Are you sure?') ? $('#form-user').submit() : false;"><i class="fa fa-trash-o"></i></button>
      </div>
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

        <h3 class="panel-title"><i class="fa fa-list"></i> <?php echo $page_title; ?></h3>
      </div>
      <div class="panel-body">
   
      <form action="{{ url('admin/delete_menu')}}" method="post" enctype="multipart/form-data" id="form-user" class="form-horizontal">
      @csrf
          <div class="table-responsive">
            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  <td style="width: 1px;" class="text-center"><input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" /></td>
                  <td class="text-left">Name</td>
                  <td class="text-left">Link</td>
                  <td class="text-left">Status</td>
                  <td class="text-left">Sort Order</td>
                  <td class="text-left">Action</td>
                </tr>
              </thead>
              <tbody>
                 <?php if (!empty($menu)): ?>
         <?php foreach ($menu as $key => $value){  ?>
           
         <tr>
         <td class="text-center"><input type="checkbox" name="selected[]" value="<?php echo $value->id; ?>" /></td>
         <td class="text-left"><?php echo $value->name; ?></td>
         <td class="text-left"><?php echo $value->link; ?></td>
         <td class="text-left"><?php echo $value->status==1?'Active':'Deactive'; ?></td>

         <td class="text-right"><?php echo $value->sort_order; ?></td>
         <td class="text-right">
          <a href="<?php echo url('admin/add_menu/'.$value->id); ?>" data-toggle="tooltip" title="Edit" class="btn btn-primary">
           <i class="fa fa-pencil"></i>
          </a>
         </td>
        </tr>

        <?php 
        $level1 = $AdminModel->all_fetch('menu',array('parent_id'=>$value->id,'visible'=>1));
        if ($level1) {
          foreach ($level1 as $key => $l1) {?>
            
        <tr>
         <td class="text-center"><input type="checkbox" name="selected[]" value="<?php echo $l1->id; ?>" /></td>
         <td class="text-left"><?php echo $value->name.'  >  '.$l1->name; ?></td>
          <td class="text-left"><?php echo $l1->link; ?></td>
         <td class="text-left"><?php echo $l1->status==1?'Active':'Deactive'; ?></td>
      
         <td class="text-right"><?php echo $l1->sort_order; ?></td>
         <td class="text-right">
          <a href="<?php echo url('admin/add_menu/'.$l1->id); ?>" data-toggle="tooltip" title="Edit" class="btn btn-primary">
           <i class="fa fa-pencil"></i>
          </a>
         </td>
        </tr>

        <?php 
        $level2 = $AdminModel->all_fetch('menu',array('parent_id'=>$l1->id,'visible'=>1));
        if ($level2) {
          foreach ($level2 as $key => $l2) {?>
            
        <tr>
         <td class="text-center"><input type="checkbox" name="selected[]" value="<?php echo $l2->id; ?>" /></td>
         <td class="text-left"><?php echo $value->name.'  >  '.$l1->name.' > '.$l2->name; ?></td>
          <td class="text-left"><?php echo $l2->link; ?></td>
         <td class="text-left"><?php echo $l2->status==1?'Active':'Deactive'; ?></td>
      
         <td class="text-right"><?php echo $l2->sort_order; ?></td>
         <td class="text-right">
          <a href="<?php echo url('admin/add_menu/'.$l2->id); ?>" data-toggle="tooltip" title="Edit" class="btn btn-primary">
           <i class="fa fa-pencil"></i>
          </a>
         </td>
        </tr>


         <?php 
        $level3 = $AdminModel->all_fetch('menu',array('parent_id'=>$l2->id,'visible'=>1));
        if ($level3) {
          foreach ($level3 as $key => $l3) {?>
            
        <tr>
         <td class="text-center"><input type="checkbox" name="selected[]" value="<?php echo $l2->id; ?>" /></td>
         <td class="text-left"><?php echo $value->name.'  >  '.$l1->name.' > '.$l2->name.' > '.$l3->name; ?></td>
          <td class="text-left"><?php echo $l3->link; ?></td>
         <td class="text-left"><?php echo $l3->status==1?'Active':'Deactive'; ?></td>
      
         <td class="text-right"><?php echo $l3->sort_order; ?></td>
         <td class="text-right">
          <a href="<?php echo url('admin/add_menu/'.$l3->id); ?>" data-toggle="tooltip" title="Edit" class="btn btn-primary">
           <i class="fa fa-pencil"></i>
          </a>
         </td>
        </tr>
         <?php } } ?> 

        <?php } } ?>

        <?php } } ?>

       <?php } ?>

       <?php endif ?>
              </tbody>
            </table>
          </div>
        </form>
        
      </div>
    </div>
  </div>
</div>

@endSection