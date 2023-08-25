@extends('layouts.master_admin')
@section('page')

<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <div class="pull-right">
                <!-- <a href="<?php echo url('admin/add_blog'); ?>" data-toggle="tooltip" title="Add New" class="btn btn-primary"><i class="fa fa-plus"></i></a> &nbsp;
                <button type="button" data-toggle="tooltip" title="Delete" class="btn btn-danger" onclick="confirm('Are you sure?') ? $('#form-user').submit() : false;"><i class="fa fa-trash-o"></i></button> -->
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

                <form action="admin/delete_blog" method="post" enctype="multipart/form-data" id="form-user" class="form-horizontal">
                    @csrf

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                <td style="width: 1px;" class="text-center">S.No</td>
                                    <td class="text-left">Full Name</td>
                                    <td class="text-left">Email Address</td>
                                    <td class="text-left">Number</td>
                                    <td class="text-left">Apply For</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($detail)) {
                                    $i=1;
                                    foreach ($detail as $key => $value) {

                                    ?>
                                        <tr>
                                            <td class="text-center"><?php echo $i++; ?></td>
                                            <td class="text-left"><?= $value->name; ?></td>
                                            <td class="text-left"><?= $value->email; ?></td>
                                            <td class="text-left"><?= $value->number; ?></td>
                                            <td class="text-left"><?= $value->applied_for; ?></td>
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
