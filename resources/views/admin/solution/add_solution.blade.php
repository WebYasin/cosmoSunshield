@extends('layouts.master_admin')
@section('page')
<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <div class="pull-right">
                <button type="submit" form="form-user" data-toggle="tooltip" title="Save" class="btn btn-primary"><i class="fa fa-save"></i></button>
                <a href="<?php echo url('admin/solution'); ?>" data-toggle="tooltip" title="Cancel" class="btn btn-default"><i class="fa fa-reply"></i></a>
            </div>
            <h1><?php echo $page_title; ?></h1>
        </div>
    </div>
    <div class="container-fluid">
        <div class="panel panel-default">
            <div class="panel-heading">
                @if(session()->has('success'))
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <strong> {{ session()->get('success') }}</strong> </a>
                </div>
                @endif

                @if(session()->has('error'))
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <strong> {{ session()->get('error') }}</strong> </a>
                </div>
                @endif
                <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $page_title; ?></h3>
            </div>


            <div class="panel-body">


                <form action="<?php echo $form_action; ?>" method="post" enctype="multipart/form-data" id="form-user" class="form-horizontal">
                    @csrf
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab-general" data-toggle="tab">General</a></li>
                        <li><a href="#tab-data" data-toggle="tab">Data</a></li>
                    </ul>
                    <div class="tab-content">
                        <div id="tab-general" class="tab-pane active">
                            <div class="form-group required">
                                <label class="col-sm-2 control-label" for="input-username">Heading</label>
                                <div class="col-sm-10">
                                    <input type="text" name="title" value="<?php echo old('title', $title); ?>" placeholder="Heading" class="form-control" />
                                    @error('title')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror

                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="col-sm-2 control-label" for="input-firstname">Short Description</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name="short_description"><?php echo old('short_description', $short_description); ?></textarea>

                                    @error('short_description')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="col-sm-2 control-label" for="input-firstname">Description</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name="description"><?php echo old('description', $description); ?></textarea>

                                    @error('description')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group ">
                                <label class="col-sm-2 control-label" for="input-image">Image</label>
                                <div class="col-sm-10">
                                    <?php if (@$image) : ?>
                                        <img src="<?php echo url($image); ?>" width="100" height="100">
                                    <?php endif ?>
                                    <input type="file" name="image" id="input-image" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="col-sm-2 control-label" for="input-confirm">Sort Order</label>
                                <div class="col-sm-10">
                                    <input type="number" name="sort_order" value="<?php echo old('sort_order', $sort_order); ?>" placeholder="Sort Order" class="form-control" autocomplete="off" />
                                    @error('sort_order')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group required">
                                <label class="col-sm-2 control-label" for="input-status">Status</label>
                                <div class="col-sm-10">
                                    <select name="status" id="input-status" class="form-control">
                                        <option value="0" <?php echo $status == 0 ? 'selected' : ''; ?>>Disabled</option>
                                        <option value="1" <?php echo $status == 1 ? 'selected' : ''; ?>>Enabled</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div id="tab-data" class="tab-pane ">

                        <div class="table-responsive">
                            <table id="ingredient" class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr>
                            <td class="text-left">Images</td>
                            <td class="text-left">Title </td>
                            <td class="text-right">Sort Order</td>
                            <td class="text-right">Status</td>
                            <td></td>
                            </tr>
                            </thead>
                        <tbody>

                        <?php if (!empty($all_details)){foreach ($all_details as $key => $row) {?>

                        <tr id="image-ing<?php echo $row->id; ?>">
                        <td class="text-left">
                        <?php if ($row->image): ?>
                            <img src="<?php echo url($row->image); ?>" width="100" height="100">
                        <?php endif ?>
                        <input type="file" name="ing_image[]" value="" id="input-image0" class="form-control">
                        <input type="hidden" name="old_ing_image[]" value="<?php echo $row->image; ?>">

                        </td>
                        <td class="text-right">

                        <input type="text" name="ing_title[]" value="<?php echo $row->title; ?>" placeholder="Title" class="form-control">
                        </td>




                        <td class="text-right">
                        <input type="number" name="ing_sort_order[]" value="<?php echo $row->sort_order; ?>" placeholder="Sort Order" class="form-control">
                        </td>
                               <td class="text-right">
                        <select class="form-control" name="ing_status[]" style="padding: 0px;">
                            <option value="1" <?php echo $row->status==1?'selected':'' ;?>>Show</option>
                            <option value="0" <?php echo $row->status==0?'selected':'' ;?>>Hide</option>
                        </select>

                        </td>

                        <td class="text-left">
                        <button type="button" onclick="$('#image-ing<?php echo $row->id; ?>').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button>
                        </td>
                    </tr>

                        <?php } } ?>
                        </tbody>

                        <tfoot>
                        <tr>
                        <td colspan="4"></td>
                        <td class="text-left">
                            <button type="button" onclick="addingredient();" data-toggle="tooltip" title="Add Ingredient Image" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button>
                        </td>
                        </tr>
                        </tfoot>
                        </table>
                    </div>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>

  var room = 0;

function addingredient() {
  html  = '<tr id="image-ing' + room + '">';
  html += '  <td class="text-left"><input type="file" name="ing_image[]" value="" id="input-ing' + room + '" class="form-control" /></td>';
  html += '  <td class="text-right"><input type="text" name="ing_title[]" value="" placeholder="Title" class="form-control" /></td>';
  html += '  <td class="text-right"><input type="number" name="ing_sort_order[]" placeholder="Sort Order" value="1" class="form-control" required /></td>';
  html += ' <td class="text-left"> <select name="ing_status[]" class="form-control"> <option value="1">Show</option> <option value="0">Hide</option> </select> </td>';

  html += '  <td class="text-left"><button type="button" onclick="$(\'#image-ing' + room  + '\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
  html += '</tr>';

  $('#ingredient tbody').append(html);
  room++;

}
    </script>
@endSection
