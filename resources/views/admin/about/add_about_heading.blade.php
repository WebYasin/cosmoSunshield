@extends('layouts.master_admin')
@section('page')
<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <div class="pull-right">
                <button type="submit" form="form-user" data-toggle="tooltip" title="Save" class="btn btn-primary"><i class="fa fa-save"></i></button>
                <a href="<?php echo url('admin/about_heading'); ?>" data-toggle="tooltip" title="Cancel" class="btn btn-default"><i class="fa fa-reply"></i></a>
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
                            <legend>We are Cosmo Sunshield</legend>
                            <div class="form-group required">
                                <label class="col-sm-2 control-label" for="input-username">Heading</label>
                                <div class="col-sm-10">
                                    <input type="text" name="heading1" value="<?php echo old('heading1', $heading1); ?>" placeholder="Heading" class="form-control" />
                                    @error('heading1')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror

                                </div>
                            </div>

                            <div class="form-group required">
                                <label class="col-sm-2 control-label" for="input-firstname">Description</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control ckeditor" name="description1"><?php echo old('description1', $description1); ?></textarea>

                                    @error('description1')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group ">
                                <label class="col-sm-2 control-label" for="input-image">Image</label>
                                <div class="col-sm-10">
                                    <?php if (@$image1) : ?>
                                        <img src="<?php echo url($image1); ?>" width="100" height="100">
                                    <?php endif ?>
                                    <input type="file" name="image1" id="input-image" class="form-control" />
                                    @error('image1')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <legend>Introducing the Shield</legend>
                            <div class="form-group required">
                                <label class="col-sm-2 control-label" for="input-username">Heading</label>
                                <div class="col-sm-10">
                                    <input type="text" name="heading2" value='<?php echo old("heading2", $heading2); ?>' placeholder="Heading" class="form-control" />
                                    @error('heading2')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror

                                </div>
                            </div>

                            <div class="form-group required">
                                <label class="col-sm-2 control-label" for="input-firstname">Short Description</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name="short_description2"><?php echo old('short_description2', $short_description2); ?></textarea>
                                    @error('short_description2')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group required">
                                <label class="col-sm-2 control-label" for="input-firstname">Description</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name="description2"><?php echo old('description2', $description2); ?></textarea>
                                    @error('description2')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group ">
                                <label class="col-sm-2 control-label" for="input-image">Image</label>
                                <div class="col-sm-10">
                                    <?php if (@$image2) : ?>
                                        <img src="<?php echo url($image2); ?>" width="100" height="100">
                                    <?php endif ?>
                                    <input type="file" name="image2" id="input-image" class="form-control" />
                                    @error('image2')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group ">
                                <label class="col-sm-2 control-label" for="input-image">Video Image</label>
                                <div class="col-sm-10">
                                    <?php if (@$video_thumbnail) : ?>
                                        <img src="<?php echo url($video_thumbnail); ?>" width="100" height="100">
                                    <?php endif ?>
                                    <input type="file" name="video_thumbnail" id="input-image" class="form-control" />
                                    @error('video_thumbnail')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group ">
                                <label class="col-sm-2 control-label" for="input-image">Video</label>
                                <div class="col-sm-10">
                                    <?php if (@$video2) : ?>
                                        <img src="<?php echo url($video2); ?>" width="100" height="100">
                                    <?php endif ?>
                                    <input type="file" name="video2" id="input-image" class="form-control" />
                                    @error('video2')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <legend>Our Values</legend>
                            <div class="form-group required">
                                <label class="col-sm-2 control-label" for="input-username">Heading</label>
                                <div class="col-sm-10">
                                    <input type="text" name="heading3" value="<?php echo old('heading3', $heading3); ?>" placeholder="Heading" class="form-control" />
                                    @error('heading3')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror

                                </div>
                            </div>

                            <div class="form-group required">
                                <label class="col-sm-2 control-label" for="input-firstname">Description</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name="description3"><?php echo old('description3', $description3); ?></textarea>
                                    @error('description3')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <legend>Sustainability</legend>
                            <div class="form-group required">
                                <label class="col-sm-2 control-label" for="input-username">Heading</label>
                                <div class="col-sm-10">
                                    <input type="text" name="heading4" value="<?php echo old('heading4', $heading4); ?>" placeholder="Heading" class="form-control" />
                                    @error('heading4')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror

                                </div>
                            </div>

                            <div class="form-group required">
                                <label class="col-sm-2 control-label" for="input-firstname">Description</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control ckeditor" name="description4"><?php echo old('description4', $description4); ?></textarea>
                                    @error('description4')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group ">
                                <label class="col-sm-2 control-label" for="input-image">Image</label>
                                <div class="col-sm-10">
                                    <?php if (@$image4) : ?>
                                        <img src="<?php echo url($image4); ?>" width="100" height="100">
                                    <?php endif ?>
                                    <input type="file" name="image4" id="input-image" class="form-control" />
                                    @error('image4')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <legend>Leadership</legend>
                            <div class="form-group required">
                                <label class="col-sm-2 control-label" for="input-username">Heading</label>
                                <div class="col-sm-10">
                                    <input type="text" name="heading5" value="<?php echo old('heading5', $heading5); ?>" placeholder="Heading" class="form-control" />
                                    @error('heading5')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror

                                </div>
                            </div>

                            <div class="form-group required">
                                <label class="col-sm-2 control-label" for="input-firstname">Description</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name="description5"><?php echo old('description5', $description5); ?></textarea>
                                    @error('description5')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group ">
                                <label class="col-sm-2 control-label" for="input-image">Image</label>
                                <div class="col-sm-10">
                                    <?php if (@$image5) : ?>
                                        <img src="<?php echo url($image5); ?>" width="100" height="100">
                                    <?php endif ?>
                                    <input type="file" name="image5" id="input-image" class="form-control" />
                                    @error('image5')
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

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endSection
