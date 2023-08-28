@extends('layouts.master_admin')
@section('page')
<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <div class="pull-right">
                <button type="submit" form="form-user" data-toggle="tooltip" title="Save" class="btn btn-primary"><i class="fa fa-save"></i></button>
                <a href="<?php echo url('admin/gallery'); ?>" data-toggle="tooltip" title="Cancel" class="btn btn-default"><i class="fa fa-reply"></i></a>
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

                    </ul>
                    <div class="tab-content">
                        <div id="tab-general" class="tab-pane active">
                            <div class="form-group ">
                                <label class="col-sm-2 control-label" for="input-image">Image</label>
                                <div class="col-sm-10">
                                    <?php if (@$image) : ?>
                                        <img src="<?php echo url($image); ?>" width="100" height="100">
                                    <?php endif ?>
                                    <input type="file" name="image" id="input-image" class="form-control" />
                                    @error('image')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
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

                            <div class="form-group ">
                        <label class="col-sm-2 control-label" for="input-username">Feature</label>
                        <div class="col-sm-10">
                            <input type="checkbox" name="feature" value="1" placeholder="" class="form-control" <?php echo $feature && $feature == 1 ? 'checked':''?> />
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

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endSection
