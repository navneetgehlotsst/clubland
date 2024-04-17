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
                                                    <h4>Event Category List</h4>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <a href="{{route('event_category_add')}}" class="btn" style="float: right; color: #fff; background-color: #1E532E; border-color: #1E532E;">
                                                Add Event Category
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
                                            <table id="Event" class="table w-100">
                                                    <thead>
                                                        <tr>
                                                        <th>Name</th>
                                                            <th>Created BY</th>
                                                            <th>Status</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($data as $val)
                                                        <tr>
                                                        <td>{{$val->name}}</td>
                                                        @if($val->getBusinessName)
                                                            <td>{{$val->getBusinessName->full_name}}</td>
                                                        @else
                                                            <td>Admin</td>
                                                        @endif
                                                            <td>
                                                                <div>
                                                                    <input data-id="{{$val->id}}" class="toggle-class" type="checkbox" class="user" onchange="EventChange({{$val->id}})" id="event{{$val->id}}" data-switch="success" {{ $val->status ? 'checked' : '' }}/>
                                                                    <label for="event{{$val->id}}" data-on-label="Active" data-off-label="Deactive" class="mb-0 d-block"></label>
                                                                </div>
                                                            </td>
                                                            <td class="table-action">
                                                                <a href="{{route('event_category_edit',$val->id)}}" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
                                                                <a href="javascript:void(0);" class="action-icon swal"  onclick="return EventConfirm({{$val->id}})"> <i class="mdi mdi-delete"></i></a>
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

