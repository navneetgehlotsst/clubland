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
                                        <div class="row">
                                            <div class="col-sm-6 page-title-box">
                                                <div class="title-left">
                                                    <h4>Faq List</h4>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <a href="{{route('faq_add')}}" class="btn" style="float: right; color: #fff; background-color: #1E532E; border-color: #1E532E;">
                                                Add Faq
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="tab-content">
                                            <div class="tab-pane show active">
                                            <table id="faq" class="table w-100">
                                                    <thead>
                                                        <tr>
                                                            <th>Question</th>
                                                            <th>Answer</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($data as $val)
                                                        <tr>
                                                            <td>{{$val->question}}</td>
                                                            <td>{{$val->answer}}</td>
                                                            <td class="table-action">
                                                                <!-- <a href="{{route('faq_view',$val->id)}}" class="action-icon"> <i class="mdi mdi-eye"></i></a> -->
                                                                <a href="{{route('faq_edit',$val->id)}}" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
                                                                <a href="javascript:void(0);" class="action-icon swal"  onclick="return faqconfirm({{$val->id}})"> <i class="mdi mdi-delete"></i></a>
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

