@extends('layouts.master_admin')
@section('page')
<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <div class="pull-right">
                <button type="submit" form="form-user" data-toggle="tooltip" title="Save" class="btn btn-primary"><i class="fa fa-save"></i></button>
                <a href="<?php echo url('admin/product_category'); ?>" data-toggle="tooltip" title="Cancel" class="btn btn-default"><i class="fa fa-reply"></i></a>
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
                            <div class="form-group required">
                                <label class="col-sm-2 control-label" for="input-username">Heading</label>
                                <div class="col-sm-10">
                                    <input type="text" name="name" value="<?php echo old('name', $name); ?>" placeholder="Heading" class="form-control" />
                                    @error('name')
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
                            <div class="form-group required">
                                <label class="col-sm-2 control-label" for="input-username">Sort Order</label>
                                <div class="col-sm-10">
                                    <input type="number" name="sort_order" value="<?php echo old('sort_order', $sort_order); ?>" placeholder="Sort Order" class="form-control" />
                                    @error('sort_order')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror

                                </div>
                            </div>
                            <div class="form-group ">
                                <label class="col-sm-2 control-label" for="input-username">Show on Home Page</label>
                                <div class="col-sm-10">
                                    <input type="checkbox" name="show_on_home" value="1" placeholder="" class="form-control" <?php echo $show_on_home && $show_on_home == 1 ? 'checked' : '' ?> />
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
                        <div id="tab-feature" class="tab-pane">

                            <div class="table-responsive">
                                <table id="ingredient" class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <td class="text-left">Title </td>
                                            <td class="text-right">Sort Order</td>
                                            <td class="text-right">Status</td>
                                            <td></td>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php if (!empty($all_details)) {
                                            foreach ($all_details as $key => $row) { ?>

                                                <tr id="image-ing<?php echo $row->id; ?>">
                                                    <td class="text-right">
                                                        <input type="text" name="ing_title[]" value="<?php echo $row->title; ?>" placeholder="Title" class="form-control">
                                                    </td>

                                                    <td class="text-right">
                                                        <input type="number" name="ing_sort_order[]" value="<?php echo $row->sort_order; ?>" placeholder="Sort Order" class="form-control">
                                                    </td>
                                                    <td class="text-right">
                                                        <select class="form-control" name="ing_status[]" style="padding: 0px;">
                                                            <option value="1" <?php echo $row->status == 1 ? 'selected' : ''; ?>>Show</option>
                                                            <option value="0" <?php echo $row->status == 0 ? 'selected' : ''; ?>>Hide</option>
                                                        </select>

                                                    </td>

                                                    <td class="text-left">
                                                        <button type="button" onclick="$('#image-ing<?php echo $row->id; ?>').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button>
                                                    </td>
                                                </tr>

                                        <?php }
                                        } ?>
                                    </tbody>

                                    <tfoot>
                                        <tr>
                                            <td colspan="3"></td>
                                            <td class="text-left">
                                                <button type="button" onclick="addingredient();" data-toggle="tooltip" title="Add Ingredient Image" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>

                        </div>
                        <div id="tab-image" class="tab-pane">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <td class="text-left">Main Image</td>
                                            <td class="text-left">Thumbnail Image</td>
                                            <td class="text-left">Banner Image</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-left">
                                                <?php if ($image) : ?>
                                                    <img src="<?php echo url($image); ?>" width="100" height="100">
                                                <?php endif ?>
                                                <input type="file" name="image" class="form-control">
                                                @error('image')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </td>
                                            <td class="text-left">
                                                <?php if ($thumbnail) : ?>
                                                    <img src="<?php echo url($thumbnail); ?>" width="100" height="100">
                                                <?php endif ?>
                                                <input type="file" name="thumbnail" class="form-control">
                                                @error('thumbnail')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </td>
                                            <td class="text-left">
                                                <?php if ($banner_image) : ?>
                                                    <img src="<?php echo url($banner_image); ?>" width="100" height="100">
                                                <?php endif ?>
                                                <input type="file" name="banner_image" class="form-control">
                                                @error('banner_image')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <td class="text-left">Video Image</td>
                                            <td class="text-left">Video</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-left">
                                                <?php if ($video_image) : ?>
                                                    <img src="<?php echo url($video_image); ?>" width="100" height="100">
                                                <?php endif ?>
                                                <input type="file" name="video_image" class="form-control">
                                                @error('video_image')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </td>
                                            <td class="text-left">
                                                <?php if ($video) : ?>
                                                    <video width="320" height="90" controls>
                                                        <source src="<?php echo url($video); ?>" type="video/mp4">
                                                    </video>
                                                <?php endif ?>
                                                <input type="file" name="video" class="form-control">
                                                @error('video')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <td class="text-left">Before Image</td>
                                            <td class="text-left">After Image</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-left">
                                                <?php if ($before_image) : ?>
                                                    <img src="<?php echo url($before_image); ?>" width="100" height="100">
                                                <?php endif ?>
                                                <input type="file" name="before_image" class="form-control">
                                                @error('before_image')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </td>
                                            <td class="text-left">
                                                <?php if ($after_image) : ?>
                                                    <img src="<?php echo url($after_image); ?>" width="100" height="100">
                                                <?php endif ?>
                                                <input type="file" name="after_image" class="form-control">
                                                @error('after_image')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div id="tab-data" class="tab-pane ">

                            <legend>Working Principle</legend>
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
                                <label class="col-sm-2 control-label" for="input-firstname"> Description</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name="description1"><?php echo old('description1', $description1); ?></textarea>

                                    @error('description1')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="col-sm-2 control-label" for="input-firstname"> Image</label>
                                <div class="col-sm-10">
                                    <?php if ($image1) : ?>
                                        <img src="<?php echo url($image1); ?>" width="100" height="100">
                                    <?php endif ?>
                                    <input type="file" name="image1" class="form-control">
                                    @error('image1')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <legend>Products</legend>
                            <div class="form-group required">
                                <label class="col-sm-2 control-label" for="input-username">Heading</label>
                                <div class="col-sm-10">
                                    <input type="text" name="heading2" value="<?php echo old('heading2', $heading2); ?>" placeholder="Heading" class="form-control" />
                                    @error('heading2')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror

                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="col-sm-2 control-label" for="input-firstname"> Description</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name="description2"><?php echo old('description2', $description2); ?></textarea>

                                    @error('description2')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <legend>Product Benefits</legend>
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
                                <label class="col-sm-2 control-label" for="input-firstname"> Image</label>
                                <div class="col-sm-10">
                                    <?php if ($image3) : ?>
                                        <img src="<?php echo url($image3); ?>" width="100" height="100">
                                    <?php endif ?>
                                    <input type="file" name="image3" class="form-control">
                                    @error('image3')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <legend>Resources Download</legend>
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
                                <label class="col-sm-2 control-label" for="input-firstname"> Description</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name="description4"><?php echo old('description4', $description4); ?></textarea>

                                    @error('description4')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="col-sm-2 control-label" for="input-firstname"> Catalog</label>
                                <div class="col-sm-10">
                                    <?php if ($catalog) : ?>
                                        <a href="<?php echo url($catalog); ?>" target="_blank"><i class="fa fa-file fa-2x" aria-hidden="true"></i></a>

                                    <?php endif ?>
                                    <input type="file" name="catalog" class="form-control">
                                    @error('catalog')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <legend>Looking for a Better Solution?</legend>
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
                                <label class="col-sm-2 control-label" for="input-username">Button Link</label>
                                <div class="col-sm-10">
                                    <input type="text" name="link5" value="<?php echo old('link5', $link5); ?>" placeholder="Heading" class="form-control" />
                                    @error('link5')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror

                                </div>
                            </div>
                        </div>

                        <div id="tab-seo" class="tab-pane">
                            <div class="form-group ">
                                <label class="col-sm-2 control-label" for="input-username">Slug (optional)</label>
                                <div class="col-sm-10">
                                    <input type="text" name="slug" value="<?php echo old('slug', $slug); ?>" placeholder="Slug" class="form-control" />

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
        html = '<tr id="image-ing' + room + '">';
        html += '  <td class="text-right"><input type="text" name="ing_title[]" value="" placeholder="Title" class="form-control" /></td>';
        html += '  <td class="text-right"><input type="number" name="ing_sort_order[]" placeholder="Sort Order" value="1" class="form-control" required /></td>';
        html += ' <td class="text-left"> <select name="ing_status[]" class="form-control"> <option value="1">Show</option> <option value="0">Hide</option> </select> </td>';

        html += '  <td class="text-left"><button type="button" onclick="$(\'#image-ing' + room + '\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
        html += '</tr>';

        $('#ingredient tbody').append(html);
        room++;

    }
</script>
@endSection
