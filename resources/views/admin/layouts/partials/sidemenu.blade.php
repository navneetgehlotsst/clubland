  <!-- ========== Left Sidebar Start ========== -->
  <style>
    select.custom-select.custom-select-sm.form-control.form-control-sm {
    width: 50px;
}
body[data-leftbar-theme=dark] .left-side-menu .logo {
    background: #ffffff!important;
}
    </style>
  <div class="left-side-menu">
    
                <!-- LOGO -->
                <a href="{{route('dashboard')}}" class="logo text-center">
                 
                     <span class="logo-lg"> 
                   
                        <img src="{{asset('/web/images/logo.png')}}" alt="" width="260">
                    </span> 
                 </a>

                <!-- LOGO -->
               
                <div class="h-100" id="left-side-menu-container" data-simplebar>

                    <!--- Sidemenu -->
                    <ul class="metismenu side-nav">

                        <li class="side-nav-title side-nav-item"></li>

                        <li class="side-nav-item">
                            <a href="{{route('dashboard')}}" class="side-nav-link">
                                <i class="uil-home-alt"></i>
                              
                                <span> Dashboard</span>
                            </a>
                           
                        </li>
                        <li class="side-nav-item {{ request()->is('admin/business*') ? 'mm-active' : '' }}">
                            <a href="{{route('business_list')}}" class="side-nav-link">
                                <i class="dripicons-briefcase"></i>
                                <span> Club/Business </span>
                            </a>
                        </li>

                        <li class="side-nav-item {{ request()->is('admin/club-type*') ? 'mm-active' : '' }}">
                            <a href="{{route('clubtype_page')}}" class="side-nav-link">
                                <i class="dripicons-view-list-large"></i>
                                <span> Club/Business Type </span>
                            </a>
                        </li>

                        <li class="side-nav-item {{ request()->is('admin/event-category*') ? 'mm-active' : '' }}">
                            <a href="{{route('event_category_page')}}" class="side-nav-link">
                                <i class="dripicons-media-shuffle"></i>
                                <span> Event Category </span>
                            </a>
                        </li>

                      
                        <li class="side-nav-item {{ request()->is('admin/cms*') ? 'mm-active' : '' }}">
                            <a href="{{route('cms_page')}}" class="side-nav-link">
                                <i class="uil-copy-alt"></i>
                                <span>Cms Pages </span>
                            </a>
                        </li>
                        <li class="side-nav-item {{ request()->is('admin/faq*') ? 'mm-active' : '' }}">
                            <a href="{{route('faq_page')}}" class="side-nav-link">
                                <i class="dripicons-question"></i>
                                <span>Faq </span>
                            </a>
                        </li>

                        <li class="side-nav-item {{ request()->is('admin/get-tuch*') ? 'mm-active' : '' }}">
                            <a href="{{route('inquiry_list')}}" class="side-nav-link">
                                <i class="dripicons-document"></i>
                                <span>Get In Tuch </span>
                            </a>
                        </li>
                        <li class="side-nav-item {{ request()->is('admin/contact-us*') ? 'mm-active' : '' }}">
                            <a href="{{route('contact_us_list')}}" class="side-nav-link">
                                <i class="dripicons-document-edit"></i>
                                <span>Contact Us </span>
                            </a>
                        </li>
                        

            
                    </ul>
                    <div class="clearfix"></div>
                </div>
            </div>
<!-- Left Sidebar End -->