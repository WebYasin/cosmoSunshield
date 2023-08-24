@extends('layouts.master_admin')
@section('page')
<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <div class="pull-right">
                <button type="submit" form="form-user" data-toggle="tooltip" title="Save" class="btn btn-primary"><i class="fa fa-save"></i></button>
                <a href="<?php echo url('admin/blogs'); ?>" data-toggle="tooltip" title="Cancel" class="btn btn-default"><i class="fa fa-reply"></i></a>
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
                        <label class="col-sm-2 control-label" for="input-username">Category</label>
                        <div class="col-sm-10">
                            <select name="cat_id" class="form-control">
                                <option value="">Select Category</option>
                                @foreach($all_category as $k=>$v)
                                   <option value="{{$v->id}}" {{$cat_id == $v->id ? 'selected' :''}}>{{$v->name}}</option>
                                @endforeach
                            </select>
                            @error('title')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                        </div>
                    </div>
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
                            <textarea class="form-control ckeditor" name="description"><?php echo old('description', $description); ?></textarea>

                            @error('description')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group ">
                        <label class="col-sm-2 control-label" for="input-username">Publish Date</label>
                        <div class="col-sm-10">
                            <input type="date" name="publish_date" value="<?php echo old('publish_date', $publish_date); ?>" placeholder=">Publish Date" class="form-control" />

                        </div>
                    </div>

                    <div class="form-group ">
                        <label class="col-sm-2 control-label" for="input-username">Meta Title</label>
                        <div class="col-sm-10">
                            <input type="text" name="meta_title" value="<?php echo old('meta_title', $meta_title); ?>" placeholder="Meta Title" class="form-control" />

                        </div>
                    </div>
                    <div class="form-group ">
                        <label class="col-sm-2 control-label" for="input-username">Meta Keyword</label>
                        <div class="col-sm-10">
                            <input type="text" name="meta_keyword" value="<?php echo old('meta_keyword', $meta_keyword); ?>" placeholder="Meta Keyword" class="form-control" />

                        </div>
                    </div>
                    <div class="form-group ">
                        <label class="col-sm-2 control-label" for="input-username">Meta Description</label>
                        <div class="col-sm-10">
                            <input type="text" name="meta_description" value="<?php echo old('meta_description', $meta_description); ?>" placeholder="Meta Description" class="form-control" />

                        </div>
                    </div>

                    <div class="form-group ">
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
                    <div class="form-group ">
                        <label class="col-sm-2 control-label" for="input-image">Image</label>
                        <div class="col-sm-10">
                            <?php if (@$image) : ?>
                                <img src="<?php echo url($image); ?>" width="100" height="100">
                            <?php endif ?>
                            <input type="file" name="image" id="input-image" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group ">
                        <label class="col-sm-2 control-label" for="input-image">Thumbnail Image</label>
                        <div class="col-sm-10">
                            <?php if (@$thumbnail) : ?>
                                <img src="<?php echo url($thumbnail); ?>" width="100" height="100">
                            <?php endif ?>
                            <input type="file" name="thumbnail" id="input-image" class="form-control" />
                        </div>
                    </div>

                    <div class="form-group ">
                        <label class="col-sm-2 control-label" for="input-username">Slug (optional)</label>
                        <div class="col-sm-10">
                            <input type="text" name="slug" value="<?php echo old('slug', $slug); ?>" placeholder="Slug" class="form-control" />

                        </div>
                    </div>

                    <div class="form-group ">
                        <label class="col-sm-2 control-label" for="input-username">Feature</label>
                        <div class="col-sm-10">
                            <input type="checkbox" name="featured" value="1" placeholder="" class="form-control" <?php echo $featured && $featured == 1 ? 'checked':''?> />
                        </div>
                    </div>

                    <div class="form-group ">
                        <label class="col-sm-2 control-label" for="input-username">Show on Home Page</label>
                        <div class="col-sm-10">
                            <input type="checkbox" name="show_on_home" value="1" placeholder="" class="form-control" <?php echo $show_on_home && $show_on_home == 1 ? 'checked':''?> />
                        </div>
                    </div>

                    <div class="form-group ">
                        <label class="col-sm-2 control-label" for="input-username">Related Blogs</label>
                        <div class="col-sm-10">
                            <input type="checkbox" name="related" value="1" placeholder="" class="form-control" <?php echo $related && $related == 1 ? 'checked':''?> />
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
