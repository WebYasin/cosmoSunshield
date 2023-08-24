@extends('layouts.master_admin')
@section('page')
<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <div class="pull-right">
                <button type="submit" form="form-user" data-toggle="tooltip" title="Save" class="btn btn-primary"><i class="fa fa-save"></i></button>
                <a href="<?php echo url('admin/banner'); ?>" data-toggle="tooltip" title="Cancel" class="btn btn-default"><i class="fa fa-reply"></i></a>
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

                    <div class="form-group required">
                        <label class="col-sm-2 control-label" for="input-username">Heading</label>
                        <div class="col-sm-10">
                            <input type="text" name="title" value="<?php echo old('title', $title); ?>" placeholder="Title" class="form-control" />
                            @error('title')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                        </div>
                    </div>


                    <div class="form-group required">
                        <label class="col-sm-2 control-label" for="input-firstname">Description</label>
                        <div class="col-sm-10">
                            <input type="text" name="content" value="<?php echo old('content', $content); ?>" placeholder="Description" class="form-control" />
                            @error('content')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group ">
                        <label class="col-sm-2 control-label" for="input-lastname">Button Name</label>
                        <div class="col-sm-10">
                            <input type="text" name="btn_name" value="<?php echo old('btn_name', $btn_name); ?>" placeholder="Button Name" class="form-control" />

                        </div>
                    </div>
                    <div class="form-group ">
                        <label class="col-sm-2 control-label" for="input-email">Button Link</label>
                        <div class="col-sm-10">
                            <input type="text" name="btn_link" value="<?php echo old('btn_link', $btn_link); ?>" placeholder="Button Link" class="form-control" />


                        </div>
                    </div>
                    <div class="form-group required">
                        <label class="col-sm-2 control-label" for="input-image">Banner Video</label>
                        <div class="col-sm-10">
                            <?php if (@$video) : ?>
                                <a href="<?php echo url($video); ?>" target="_blank"><i class="fa fa-file fa-2x" aria-hidden="true"></i></a>

                            <?php endif ?>
                            <input type="file" name="video" id="input-image" class="form-control" accept="video/mp4,video/x-m4v,video/*" />
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
                </form>
            </div>
        </div>
    </div>
</div>
@endSection
