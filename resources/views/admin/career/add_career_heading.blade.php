@extends('layouts.master_admin')
@section('page')
<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <div class="pull-right">
                <button type="submit" form="form-user" data-toggle="tooltip" title="Save" class="btn btn-primary"><i class="fa fa-save"></i></button>
                <a href="<?php echo url('admin/career_heading'); ?>" data-toggle="tooltip" title="Cancel" class="btn btn-default"><i class="fa fa-reply"></i></a>
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
                            <legend>We at Cosmo Sunshield</legend>
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
                                    <textarea class="form-control" name="description1"><?php echo old('description1', $description1); ?></textarea>

                                    @error('description1')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <legend>Business Head’s Message</legend>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-username">Heading</label>
                                <div class="col-sm-10">
                                    <input type="text" name="heading2" value="<?php echo old('heading2', $heading2); ?>" placeholder="Heading" class="form-control" />

                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-username">Title</label>
                                <div class="col-sm-10">
                                    <input type="text" name="heading2_1" value="<?php echo old('heading2_1', $heading2_1); ?>" placeholder="Title" class="form-control" />

                                </div>
                            </div>
                            <div class="form-group ">
                                <label class="col-sm-2 control-label" for="input-firstname">Description</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name="description2"><?php echo old('description2', $description2); ?></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-username">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" name="name2" value="<?php echo old('name2', $name2); ?>" placeholder="Name" class="form-control" />
                                    @error('name2')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror

                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-username">Designation</label>
                                <div class="col-sm-10">
                                    <input type="text" name="designation2" value="<?php echo old('designation2', $designation2); ?>" placeholder="Designation" class="form-control" />
                                    @error('designation2')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror

                                </div>
                            </div>


                            <div class="form-group ">
                                <label class="col-sm-2 control-label" for="input-image">Image</label>
                                <div class="col-sm-10">
                                    <?php if (@$img2) : ?>
                                        <img src="<?php echo url($img2); ?>" width="100" height="100">
                                    <?php endif ?>
                                    <input type="file" name="img2" id="input-image" class="form-control" />
                                </div>
                            </div>
                            <legend>Work @Cosmo Sunshield</legend>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-username">Heading</label>
                                <div class="col-sm-10">
                                    <input type="text" name="heading3" value="<?php echo old('heading3', $heading3); ?>" placeholder="Heading" class="form-control" />

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-firstname">Description</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name="description3"><?php echo old('description3', $description3); ?></textarea>
                                </div>
                            </div>
                            <legend>Current Openings</legend>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-username">Heading</label>
                                <div class="col-sm-10">
                                    <input type="text" name="heading4" value="<?php echo old('heading4', $heading4); ?>" placeholder="Heading" class="form-control" />

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-firstname">Description</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name="description4"><?php echo old('description4', $description4); ?></textarea>
                                </div>
                            </div>

                            <legend>Didn’t find the job matching your profile? Submit your resume directly</legend>
                            <div class="form-group ">
                                <label class="col-sm-2 control-label" for="input-username">Heading</label>
                                <div class="col-sm-10">
                                    <input type="text" name="heading5" value="<?php echo old('heading5', $heading5); ?>" placeholder="Heading" class="form-control" />

                                </div>
                            </div>
                            <div class="form-group ">
                                <label class="col-sm-2 control-label" for="input-username">Button Name</label>
                                <div class="col-sm-10">
                                    <input type="text" name="btn_name" value="<?php echo old('btn_name', $btn_name); ?>" placeholder="Button Name" class="form-control" />

                                </div>
                            </div>
                            <div class="form-group ">
                                <label class="col-sm-2 control-label" for="input-username">Button Link</label>
                                <div class="col-sm-10">
                                    <input type="text" name="btn_link" value="<?php echo old('btn_link', $btn_link); ?>" placeholder="Button Link" class="form-control" />

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
