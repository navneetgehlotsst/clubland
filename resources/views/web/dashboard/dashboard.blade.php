@extends('web.layout.master')

@section('content')

<style>

.error{

    color:red;

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

          <div class="col-lg-3 col-md-4 col-12 col-sm-5">

            <div class="sub_title_section">

              <ul class="sub_title">

                <li> <a href="{{route('website-home')}}"> Home </a>&nbsp; / &nbsp; </li>

                <li>Dashboard</li>

              </ul>

            </div>

          </div>

        </div>

      </div>

    </div>

  </div>


  <!-- Title Section End -->

  <!-- Dashboard Inner Content Section Start -->
  @php               
                      $checkhomesecation = Helper::checkHomeSecation();
                @endphp
  <section class="dashboard_inner_content">

    <div class="container">

    <div class="py-3">
        @if(empty($checkhomesecation))
              <div class="alert alert-info mb-3" role="alert">
              <p class="card-text"><i class="fas fa-info-circle"></i> For getting your clubs public url first you need to complete Homepage and header.<br>*Instruction:* Click on the Web Pages and then open the home tab. <a href="{{ route('home_secation') }}" class="text-danger fw-bold">Click to Add</a></p>
                 
              </div>
        @endif
        @if(auth()->user()->stripe_account_status == '0')
            <div class="alert alert-warning mb-3" role="alert">
            <p class="card-text"><i class="fas fa-info-circle"></i> Please add your bank account for activate your public url and starting payouts directly to your bank account.  <a href="{{ route('bank.index') }}" class="text-danger fw-bold">Click to Add</a></p>
            </div>
        @endif
        @if(auth()->user()->stripe_account_status == '2' || auth()->user()->stripe_account_status == '1')
            <div class="alert alert-warning mb-3" role="alert">
            <p class="card-text"><i class="fas fa-info-circle"></i> Please complete your bank account for activate your public url and starting payouts directly to your bank account. <a href="{{ route('bank.index') }}" class="text-danger fw-bold">Click to Update</a></p>
            </div>
        @endif
        
    </div>

      <div class="row">

        @include('web.layout.sidebar')

        <div class="col-lg-9">

          <div class="right_menu">

            <div class="title_div d-flex align-items-center justify-content-between mb-20">

              <h2>Hello {{Auth::user()->full_name ?? ''}}</h2>

              <div class="comments_form select_filter mb-0">
                <form action="{{route('b_dashboard')}}" method="get" id="filter">
                  
                <select class="form-control form-select" name="filter" onchange="FilterData(this.value)" aria-label="Default select example">

                  <option selected>Default</option>
                  <option  value="week" {{ @$_GET['filter'] == 'week' ? 'selected' : '' }}>This Week</option>

                  <option value="month" {{ @$_GET['filter'] == 'month' ? 'selected' : '' }}>This Month</option>

                  <option value="year" {{ @$_GET['filter'] == 'year' ? 'selected' : '' }}>This Year</option>

                </select>
              </form>

              </div>

            </div>

            <div class="dashboard_orverview">

              <div class="row">

                <div class="col-6">

                  <div class="feature_box sky_blue">

                    <div class="feature_icon">

                      <img src="{{asset('/web/images/icon/membership_icon.svg')}}">

                    </div>

                    <div class="feature_content">

                      <span>{{$membership}}</span>

                      <h3>New Memberships</h3>

                    </div>

                  </div>

                </div>

                <div class="col-6">

                  <div class="feature_box green">

                    <div class="feature_icon">

                      <img src="{{asset('/web/images/icon/product_icon.svg')}}">

                    </div>

                    <div class="feature_content">

                      <span>{{$product}}</span>

                      <h3>Product Sale</h3>

                    </div>

                  </div>

                </div>

                <div class="col-6">

                  <div class="feature_box purple">

                    <div class="feature_icon">

                      <img src="{{asset('/web/images/icon/ticket_icon.svg')}}">

                    </div>

                    <div class="feature_content">

                      <span>{{$event}}</span>

                      <h3>Event Ticket Sale</h3>

                    </div>

                  </div>

                </div>

                <div class="col-6">
                  <a href="{{route('transaction_history')}}">
                  <div class="feature_box blue">

                    <div class="feature_icon">

                      <img src="{{asset('/web/images/icon/doller_icon.svg')}}">

                    </div>

                    <div class="feature_content">

                      <span>${{$reneue}}</span>

                      <h3>Total Revenue</h3>

                    </div>

                  </div>
                  </a>
                </div>

              </div>

            </div>

            <div class="reminder">

              <div class="row">

                <div class="col-lg-12">

                  <div class="feature_box clander_feature_box d-block">

                    <div class="_title">

                      <h3>Reminders</h3> <span>To add reminder click on calender</span>

                    </div>

                    <!-- <div id='calendar' class="calendar_div"></div> -->

                    <div id="calendar"></div>

                  </div>

                </div>

              </div>

            </div>

            <!-- <div class="row recent_sales_documents">

              <div class="col-lg-12">

                <div class="feature_box d-block">

                  <div class="feature_header">

                    <h3>Recent Sales</h3>

                  </div>

                  <div class="feature_content">

                    <div class="notification">

                      <div class="status"><span class="bordered">Membership</span> <span class="time">2 hours ago</span>

                      </div>

                      <a href="#" class="link">Amanda Joseph subscribed 'Premium Package' Family membership plan</a>

                    </div>

                    <div class="notification">

                      <div class="status"><span class="bordered">Events</span> <span class="time">2 hours ago</span>

                      </div>

                      <a href="#" class="link">Amanda Joseph subscribed 'Premium Package' Family membership plan</a>

                    </div>

                    <div class="notification">

                      <div class="status"><span class="bordered">Faciilty</span> <span class="time">2 hours ago</span>

                      </div>

                      <a href="#" class="link">Amanda Joseph subscribed 'Premium Package' Family membership plan</a>

                    </div>

                  </div>

                </div>

              </div>

             

            </div> -->

          </div>

        </div>

      </div>

    </div>

  </section>

  <div id="modal-view-event-add" class="modal modal-top fade calendar-modal">

    <div class="modal-dialog modal-dialog-centered">

      <div class="modal-content">

        <form id="add-event" action="{{route('add_reminder')}}" name="add_reminder" method="post">

          @csrf

          <div class="modal-body">

            <h4>Add Event Detail</h4>

            <div class="form-group">

              <label>Event name</label>

              <input type="text" required class="form-control" name="ename">

            </div>

            <div class="row">

            <div class="col-sm-6">

              <label>Event Start Date</label>

              <input type='text' readonly required class="datetimepicker form-control" name="e_start_date">

              

            </div>

            <div class="col-sm-6">

              <label>Event End Date</label>

              <input type='text' required readonly class="datetimepicker form-control" name="e_end_date">

            </div>

            </div>

            <div class="form-group">

              <label>Event Description</label>

              <textarea class="form-control" required  name="edesc"></textarea>

              @if ($errors->has('edesc'))

                      <span class="text-danger" style="float: left;">{{ $errors->first('edesc') }}</span>

                    @endif

            </div>

          </div>

          <div class="modal-footer">

            <div class="button_div float-end mt-30">

              <button type="submit" class="btn btn">Save</button>

              <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>

            </div>

          </div>

        </form>

      </div>

    </div>

  </div>

  <div id="modal-view-event-edit" class="modal modal-top fade calendar-modal">

    <div class="modal-dialog modal-dialog-centered">

      <div class="modal-content">

        <form id="edit-event" action="{{route('update_reminder')}}" name="edit_reminder" method="post">

          @csrf

          <input type="hidden" id="remindereditID" name="id" value="">

          <div class="modal-body">

            <h4>Edit Event Detail</h4>

            <div class="form-group">

              <label>Event name</label>

              <input type="text" required class="form-control" id="ename" name="ename">

            </div>

            <div class="row">

            <div class="col-sm-6">

              <label>Event Start Date</label>

              <input type='text' readonly required class="datetimepicker form-control" id="e_start_date" name="e_start_date">

            </div>

            <div class="col-sm-6">

              <label>Event End Date</label>

              <input type='text' required readonly class="datetimepicker form-control" id="e_end_date" name="e_end_date">



            </div>

            </div>

            <div class="form-group">

              <label>Event Description</label>

              <textarea class="form-control" id="edesc" required  name="edesc"></textarea>

              @if ($errors->has('edesc'))

                      <span class="text-danger" style="float: left;">{{ $errors->first('edesc') }}</span>

                    @endif

            </div>

          </div>

          <div class="modal-footer">

            <div class="button_div float-end mt-30">

              <button type="submit" class="btn btn">Update</button>

              <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>

            </div>

          </div>

        </form>

      </div>

    </div>

  </div>

  <!-- Dashboard Inner Content Section End -->

  @endsection