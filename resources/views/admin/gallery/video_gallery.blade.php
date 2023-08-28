@extends('layouts.master_admin')
@section('page')
<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <div class="pull-right">
                <a href="<?php echo url('admin/add_video_gallery'); ?>" data-toggle="tooltip" title="Add New" class="btn btn-primary"><i class="fa fa-plus"></i></a> &nbsp;
                <button type="button" data-toggle="tooltip" title="Delete" class="btn btn-danger" onclick="confirm('Are you sure?') ? $('#form-user').submit() : false;"><i class="fa fa-trash-o"></i></button>
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
                <h3 class="panel-title"><i class="fa fa-list"></i> <?php echo $page_title; ?></h3>
            </div>
            <div class="panel-body">

                <form action="admin/delete_video_gallery" method="post" enctype="multipart/form-data" id="form-user" class="form-horizontal">
                    @csrf

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                <td style="width: 1px;" class="text-center"><input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" /></td>
                                    <td class="text-left">Video Thumbnail</td>
                                    <td class="text-left">Sort Order</td>
                                    <td class="text-left">Status</td>
                                    <td class="text-left">Action</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($detail)) {
                                    $i=1;
                                    foreach ($detail as $key => $value) { ?>
                                        <tr>
                                            <td class="text-center"><input type="checkbox" name="selected[]" value="<?php echo $value->id; ?>" /></td>
                                            <td class="text-left"><img src="<?php echo url($value->image ? $value->image : $noImage); ?>" width="70" height="70"></td>
                                            <td class="text-left"><?= $value->sort_order; ?></td>
                                            <td class="text-left"><?php echo  $value->status == 1 ? 'Active' : 'Deactive'; ?></td>
                                            <td class="text-left"><a href="<?php echo url('admin/add_video_gallery/' . $value->id); ?>"><button type="button" class="btn btn-info"><i class="fa fa-pencil"></i>&nbsp; Edit</button></a></td>
                                        </tr>
                                <?php }
                                } ?>
                            </tbody>
                        </table>
                        {{ $detail->links() }}
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

@endSection
