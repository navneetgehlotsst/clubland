        <div class="col-lg-3">
          <div class="left_menu" id="left_menu">
            <div class="close_menu" id="close-icon"><i class="uil uil-times"></i></div>
            <div class="feature_box text-center border-bottom-0">
              <div class="media_div mb-3">
               
                  <img src="{{asset('/web/images/customcolor_logo.png')}}" alt="profile-img">
              </div>
              <h3 class="name_breack">
                {{Auth::user()->business_info->club_name}}</h3>
              <div class="progress_div">
                <span>Profile</span>
                @php $pcount =  Helper::GetProfilePrcentage(); 
                     $Hcount =  Helper::GetHomePrcentage(); 
                      $total = 50 + $pcount + $Hcount;
                      $checkhomesecation = Helper::checkHomeSecation();
                @endphp

                <span>{{ $total }}%</span>
                <span class="progress" style="width: {{ $total}}%;">&nbsp;</span>
              </div>
            </div>
            <div class="feature_box pt-0">
              <ul class="menu-list" id="drop_menu">
                <li class="dropdown {{ request()->is('business/dashboard') ? 'active' : '' }}"><a class="link" href="{{route('b_dashboard')}}"><i class="icon-dashboard"></i> Dashboard</a></li>
                <li class="dropdown {{ request()->is('business/edit-profile') ? 'active' : '' }}"><a class="link" href="{{route('business_profile')}}"><i class="icon-profile"></i> Profile</a></li>
                <li class="dropdown {{ request()->is('business/member-ship*') ? 'active' : '' }}">
                  <span class="link drop_link"><i class="icon-membership"></i></i> Membership</span>
                  <ul class="submenu dropdown-menu">
                    <li><a class="dropdown-item" href="{{route('member_ship')}}">Membership Plans</a></li>
                    <li><a class="dropdown-item" href="{{route('member_list')}}">Members</a></li>
                  </ul>
                </li>
                <li class="dropdown {{ request()->is('business/event*') ? 'active' : '' }}">
                  <span class="link drop_link"><i class="icon-events"></i> Events</span>
                  <ul class="submenu dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <li><a class="dropdown-item" href="{{route('event_add')}}">Add New Event</a></li>
                    <li><a class="dropdown-item" href="{{route('event_list')}}">All Events</a></li>
                    <li><a class="dropdown-item" href="{{route('event_history')}}">Event History</a></li>

                  </ul>
                </li>
                <li class="dropdown {{ request()->is('business/product*') ? 'active' : '' }}">

                  <span class="link drop_link"><i class="icon-shop"></i> Club/Shop</span>
                  <ul class="submenu dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <li><a class="dropdown-item" href="{{route('product_add')}}">Add New Product</a></li>
                    <li><a class="dropdown-item" href="{{route('product_list')}}">All Product</a></li>
                    <li><a class="dropdown-item" href="{{route('product_history')}}">Product History</a></li>

                  </ul>
                </li>
                <li class="dropdown {{ request()->is('business/facility*') ? 'active' : '' }}">
                  <span class="link drop_link"><i class="icon-facility"></i> Facility</span>
                  <ul class="submenu dropdown-menu" aria-labelledby="dropdownMenuLink">
                  <li><a class="dropdown-item" href="{{route('add_facility')}}">Add New Facility</a></li>
                  <li><a class="dropdown-item" href="{{route('all_facility')}}">All Facility</a></li>
                    <li><a class="dropdown-item" href="{{route('facility_history')}}">Facility History</a></li>
                  </ul>
                </li>
                <!-- <li class="dropdown">
                <span class="link drop_link" ><i class="fas fa-chart-bar"></i> Finance</span>
                <ul class="submenu dropdown-menu" aria-labelledby="dropdownMenuLink">
                  <li><a class="dropdown-item" href="#">Action</a></li>
                  <li><a class="dropdown-item" href="#">Another action</a></li>
                  <li><a class="dropdown-item" href="#">Action</a></li>
                </ul>
              </li> -->
                <li class="dropdown {{ request()->is('business/secation*') ? 'active' : '' }}">
                  <span class="link drop_link"><i class="icon-file"></i> Web Pages</span>
                  <ul class="submenu dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <li><a class="dropdown-item" href="{{route('home_secation')}}">Home</a></li>
                    <li><a class="dropdown-item" href="{{route('about_secation')}}">About us</a></li>
                    <li><a class="dropdown-item" href="{{route('header_secation')}}">Header</a></li>
                    <li><a class="dropdown-item" href="{{route('footer_secation')}}">Footer</a></li>
                  </ul>
                </li>
                <li class="dropdown {{ request()->is('business/mailchimp') ? 'active' : '' }}"><a class="link" href="{{route('mailchimp')}}"><i class="fas fa-envelope" style='font-size:20px; margin-left: 4px;'></i> Mailchimp</a></li>
                @if(auth()->user()->stripe_account_status == '3' && !empty($checkhomesecation))
                      <li><a class="link" target="_blank" href="{{env('HTTP_TYPE').auth()->user()->slug.'.'.env('BASE_DOMAIN')}}"><i class="icon-company"></i> Company Preview</a></li>
                @elseif(empty($checkhomesecation))
                <li><a class="link" target="_blank" href="{{route('home_secation')}}"><i class="icon-company"></i> Company Preview</a></li>
                
                @else
                <li><a class="link" target="_blank" href="{{route('bank.index')}}"><i class="icon-company"></i>Company Preview</a></li>

                @endif
                

              </ul>
            </div>
            <div class="feature_box border-bottom-0">
              <ul class="menu-list">
              @if(auth()->user()->stripe_account_status == '2' || auth()->user()->stripe_account_status == '1' || auth()->user()->stripe_account_status == '3')
              <li><a class="link" target="_blank" href="{{route('bank.manage_account')}}"><i class="fas fa-university"></i></i> Manage Account</a></li>
              @else
              <li><a class="link" target="_blank" href="{{route('bank.index')}}"><i class="fas fa-university"></i></i> Add Bank Account</a></li>
              
              @endif
                <li class="dropdown {{ request()->is('business/change-password') ? 'active' : '' }}"><a href="{{ route('business_change_password')}}"><i class="icon-key"></i> Change Password</a></li>
                <li>
                <a href="{{ route('user.logout') }}"
                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                        <i class="icon-power-off"></i> Log out</a>
                    <form id="logout-form" action="{{ route('user.logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
                <li>
                  <a href="javascript:void(0);" class="py-2 px-1" data-toggle="modal" data-target="#AccountdeleteModal" onclick="return DeleteAccount({{auth()->user()->id}})"><i class="icon-delete"></i> Delete Account</a>

                
                </li>
              </ul>
            </div>
          </div>
        </div>

        