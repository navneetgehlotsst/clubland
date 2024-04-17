@extends('admin.layouts.master')
@section('content')
<!-- Start Content-->
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
                                                    <h4>Cms List</h4>
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
                                            <table id="cms" class="table w-100">
                                                    <thead>
                                                        <tr>
                                                            <th>Name</th>
                                                            <th>Content</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($data as $val)
                                                        <tr>
                                                            <td>{{$val->name}}</td>
                                                            <?php $ctnent = str_replace('&nbsp;', ' ', $val->content); ?>
                                                            <td>{{strip_tags(substr($ctnent, 0, 100))}}...</td>
                                                            <td class="table-action">
                                                                <a href="{{route('cms_view',$val->id)}}" class="action-icon"> <i class="mdi mdi-eye"></i></a>
                                                                <a href="{{route('cms_edit',$val->id)}}" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
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

                    </div> <!-- container -->
                    
@endsection

