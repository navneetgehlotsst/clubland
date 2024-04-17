@extends('admin.layouts.master')
@section('content')
<!-- Start Content-->
<style>
    select.custom-select.custom-select-sm.form-control.form-control-sm {
        width: 53px !important;
    }
</style>
    <div class="container-fluid">
        <div class="col-12">
             &nbsp;
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="">
                            <div class="page-title-box">
                                <div class="title-left">
                                    <h4>Contact Us List</h4>
                                </div>
                                <div class="title-right"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane show active">
                                <table id="inquerdata" class="table w-100">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th style="width: 150.703px !important;">Email</th>
                                            <th>Content</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $key => $val)
                                            <tr>
                                                <td>{{$val->name}}</td>
                                                <td>{{$val->email}}</td>
                                                <td>{{$val->description}}</td>
                                                <td class="table-action">
                                                    <a href="javascript:void(0);" class="action-icon swal"  onclick="return confirmContactUs({{$val->id}})"> <i class="mdi mdi-delete"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div> <!-- end tab-content-->

                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div><!-- end col-->
        </div>
        <!-- end row-->
    </div>
<!-- container -->
@endsection


