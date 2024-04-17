@extends('web.layout.master')

@section('content')

<style>

  .error{

    color:red;

  }

  .datepicker {

    display: none !important;

}

</style>

  <!-- Title Section Start -->

  <div class="page_title_section dashbord_title">

    <div class="page_header">

      <div class="container">

        <div class="row">

          <div class="col-lg-9 col-md-8 col-12 col-sm-7 align-items-center d-flex">

            <div class="left_menu_icon" id="left_menu_icon"></div>

            <h1>Dashboard</h1>

          </div>

          

        </div>

      </div>

    </div>

  </div>

  <!-- Title Section End -->

  <!-- Dashboard Inner Content Section Start -->

  <section class="dashboard_inner_content">

    <div class="container">

      <div class="row">

        @include('web.layout.sidebar')

        <div class="col-xl-9 col-lg-8">

        <div class="right_menu">
            <div class="title_div d-flex align-items-center justify-content-between mb-20">
              <div class="titile_content">
                &nbsp;
              </div>
              <div class="titile_content">
              <a href="{{route('transaction_csv')}}" class="btn orange-border-btn btn-50">Download CSV</a>
              </div>
            </div>
            <!--Event list start-->
            <div class="d-block add_membership_plan p-0 my-3">

              <div class="tickets-users-list">

                <div class="card border-0">

                  <h5 class="card-header hedding-top">Transaction History</h5>

                  <div class="card-body border p-0 border-top-0">

                      <div class="table-responsive">

                          <table class="table">

                              <thead>

                                  <tr>

                                      <th class="text-center">Order Id</th>
                                     
                                      <th>Name</th>
                                      <th>Email</th>
                                      <th>Amount</th>


                                  </tr>

                              </thead>

                              <tbody>
                                @forelse ($data as $val)
                                  <tr>
                                  @if($val->type == 'facility')
                                  <td class="align-middle text-center text-info"><a href="{{route('facility_order_details',$val->id)}}" class="py-2 px-1 text-info">#ORDERID00{{$val->id}}</a></td>  
                                  @elseif ($val->type == 'product')
                                  <td class="align-middle text-center text-info"><a href="{{route('product_history_details',$val->id)}}" class="py-2 px-1 text-info">#ORDERID00{{$val->id}}</a></td>  
                                  @elseif ($val->type == 'membership')
                                  <td class="align-middle text-center text-info"><a href="{{route('member_list')}}" class="py-2 px-1 text-info">#ORDERID00{{$val->id}}</a></td>  
                                  @else
                                  <td class="align-middle text-center text-info"><a href="{{route('event_ticket_list',$val->booking_id)}}" class="py-2 px-1 text-info">#ORDERID00{{$val->id}}</a></td>  
                                  @endif

                                  <td class="align-middle text-nowrap">{{$val->user_name}}</td>
                                      <td class="align-middle text-nowrap">{{$val->user_email}}</td>
                                      <td class="align-middle text-nowrap">${{$val->destination_amount}}</td>


                                  </tr>
                                @empty
                                     <tr>
                                      <td style="text-align: center;" colspan="6">No facility history yet.</td>
                                     </tr>
                                @endforelse

                                

                                  

                              </tbody>

                          </table>

                      </div>

                  </div>

                </div>

                <div class="mt-3" style="float: right;">

                  {{$data->links('pagination::bootstrap-4')}}

              </div>
              </div>

            </div>            

            <!--Event list End-->

          </div>

        </div>

      </div>

      </div>

    </div>

  </section>

  <!-- Dashboard Inner Content Section End -->

  @endsection
