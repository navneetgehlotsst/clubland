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
                                                    <h4>Club/Business List</h4>
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
                                <table id="user_datas" class="table w-100">
                                    <thead>
                                        <tr>
                                            <th>Club Name</th>
                                            <th>Club Type</th>
                                            <th>Person Name</th>
                                            <th>Email</th>
                                            <th>Profile Status</th>
                                            <th>Public Url</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($user as $key => $val)
                                        <tr>
                                        <td>{{$val->business_info->club_name}}</td>
                                        <td>{{@$val->business_info->get_club_type->name}}</td>
                                        <td>{{$val->full_name}}</td>
                                        <td>{{$val->email}}</td>
                                        
                                        <td>
                                                @if(!empty(Helper::checkHomeSecation($val->id)))
                                                    Home Secation : <b class="text-success">Complete</b>
                                                @else
                                                    Home Secation : <b class="text-warning ">Pending</b>
                                                @endif 
                                                <br>
                                                @if($val->stripe_account_status == '3')
                                                    Bank Account :<b class="text-success">Complete</b>
                                                @else
                                                    Bank Account :<b class="text-warning ">Pending</b>
                                                @endif 
                                        </td>
                                        <td>
                                                {{env('HTTP_TYPE').$val->slug.'.'.env('BASE_DOMAIN')}}
                                        </td>
                                        <td>
                                            <div>
                                                <input data-id="{{$val->id}}" class="toggle-class" type="checkbox" class="user" onchange="UserTypeChange({{$val->id}})" id="event{{$val->id}}" data-switch="success" {{ $val->status ? 'checked' : '' }}/>
                                                <label for="event{{$val->id}}" data-on-label="Active" data-off-label="Deactive" class="mb-0 d-block"></label>
                                            </div>
                                        </td>
                                            
                                            <td class="table-action">
                                                @if($val->stripe_account_status == '3' && !empty(Helper::checkHomeSecation($val->id)))
                                                    <a href="{{route('welcome_message',$val->id)}}" class="action-icon" title="send welcome mail"> <i class="mdi mdi-gmail"></i></a>
                                                @endif 
                                                <a href="{{route('business_detail',$val->id)}}" class="action-icon"> <i class="mdi mdi-eye"></i></a>
                                                <a href="javascript:void(0);" class="action-icon swal"  onclick="return confirm({{$val->id}})"> <i class="mdi mdi-delete"></i></a>
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


