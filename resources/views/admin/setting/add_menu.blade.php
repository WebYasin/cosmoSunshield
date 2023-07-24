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
        <a href="<?php echo url('admin/menu'); ?>" data-toggle="tooltip" title="Cancel" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
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
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $page_title; ?></h3>
      </div>
      <div class="panel-body">
        <form action="<?php echo $form_action; ?>" method="post" enctype="multipart/form-data" id="form-user" class="form-horizontal">
          @csrf

          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-user-group"> Select Menu</label>
            <div class="col-sm-10">
              <select name="parent_id" id="input-user-group" class="form-control">
                 <option value="">select option</option>
              
                  <?php
          if(!empty($menu_list)){

           foreach ($menu_list as $key => $value){ ?>
            <option value="<?php echo $value->id; ?>" <?php echo $value->id==$parent_id?'selected':''; ?>><?php echo $value->name; ?></option>
             <?php 
             $level1 = $AdminModel->all_fetch('menu',array('parent_id'=>$value->id));

            if ($level1) {
            foreach ($level1 as $key => $l1) {?>

                <option value="<?php echo @$l1->id; ?>" <?php echo $l1->id==$parent_id?'selected':''; ?>><?php echo $value->name.' > '.@$l1->name; ?></option>


           <?php 
           $level2 = $AdminModel->all_fetch('menu',array('parent_id'=>$l1->id));
           if ($level2) {
          foreach ($level2 as $key => $l2) {?>     

            <option value="<?php echo $l2->id; ?>" <?php echo $l2->id==$parent_id?'selected':''; ?>><?php echo $value->name.' > '.$l1->name.' > '.$l2->name; ?></option>

        <?php 
        $level3 = $AdminModel->all_fetch('menu',array('parent_id'=>$l2->id));
        if ($level3) {
          foreach ($level3 as $key => $l3) {?>

          <option value="<?php echo @$l3->id; ?>" <?php echo @$l3->id==$parent_id?'selected':''; ?>><?php echo $value->name.' > '.$l1->name.' > '.$l2->name.' > '.@$l3->name; ?></option>


        <?php } } ?>

        <?php }} ?>

        <?php }} ?> 

        <?php }} ?>



              </select>
            </div>
          </div>
          
          <div class="form-group ">
            <label class="col-sm-2 control-label" for="input-firstname">Menu Name</label>
            <div class="col-sm-10">
              <input type="text" name="name" value="<?php echo old('name',$name); ?>" placeholder="First Name" class="form-control" />
             
               @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
              @enderror

             </div>
          </div>
               

          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-image">Fa fa class</label>
            <div class="col-sm-10">
            
              <input type="text" name="fafa"  value="<?php echo old('fafa',$fafa); ?>" id="input-image" class="form-control" placeholder="<i class='fa fa-pencil'></i>" />
            </div>
          </div>
          
          <div class="form-group ">
            <label class="col-sm-2 control-label" for="input-password">Link</label>
            <div class="col-sm-10">
              <input type="text" name="link" value="<?php echo old('link',$link); ?>"  placeholder="Link"  class="form-control" autocomplete="off"  />
              </div>
              
          </div>

          <div class="form-group ">
            <label class="col-sm-2 control-label" for="input-confirm">Sort Order</label>
            <div class="col-sm-10">
              <input type="number" name="sort_order" value="<?php echo old('sort_order',$sort_order); ?>"  placeholder="Sort Order" class="form-control" autocomplete="off" />

       
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