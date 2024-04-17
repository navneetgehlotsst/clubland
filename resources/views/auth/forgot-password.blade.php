<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Reset Password | Clubland Service</title>
        
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Clubland Service" name="description" />
        <meta content="Clubland Service" name="author" />
        <link rel="shortcut icon" href="{{asset('/web/images/customcolor_logo.png')}}">
       
        <!-- App css -->
        <link href="{{ asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/app.min.css')}}" rel="stylesheet" type="text/css" id="light-style" />
        <link href="{{ asset('assets/css/app-dark.min.css')}}" rel="stylesheet" type="text/css" id="dark-style" />

    </head>

    <body class="loading authentication-bg" data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": true}'>
        <div class="account-pages" style="display: flex;justify-content: center;align-items: center; max-height: 100%;
    min-height: 100vh;">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5 m-auto">
                        <div class="card">

                            <!-- Logo -->
                            <div class="card-header pt-20 pb-20 text-center">
                                <a href="">
                                    <span style="color:#f9fafe">
                                    <img src="{{asset('/web/images/logo.png')}}" alt="" width="260">
                                    </span>
                                </a>
                            </div>

                            <div class="card-body p-4">
                                <div class="text-center w-75 m-auto">
                                <h4 class="text-dark-50 text-center mt-0 font-weight-bold">Forgot Password</h4>
                                    <p class="text-muted mb-4">Retrieve your password here.</p>
                                </div>
                                @yield('script') 
                                @include('admin.layouts.sweet_alerts')
                                <!-- @if(session('error'))
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
                                    </div>
                                @endif

                                @if(session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif -->
                                @if($errors->has('email'))
                                    <div class="alert alert-danger">{{ $errors->first('email') }}</div>
                                @endif
                                <form action="{{route('password_email')}}">
                                    @csrf
                                    <div class="form-group mb-3">
                                        <label for="emailaddress">Email address</label>
                                        <input class="form-control" type="email" name="email" id="emailaddress" required="" placeholder="Enter your email">
                                    </div>

                                    <div class="form-group mb-0 text-center">
                                        <button class="btn btn-primary" type="submit">Submit</button>
                                    </div>
                                </form>
                                
                            </div> <!-- end card-body -->
                            
                        </div>
                        <div class="row mt-3">
                            <div class="col-12 text-center">
                                <p class="text-muted">Back to <a href="{{url('admin')}}" class="text-muted ml-1"><b>Log In</b></a></p>
                            </div> <!-- end col -->
                        </div>
                    </div> <!-- end col -->
                    
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end page -->

        <footer class="footer footer-alt">
            <script>document.write(new Date().getFullYear())</script> © Clubland Service
        </footer>

        <!-- bundle -->
        <script src="{{ asset('assets/js/vendor.min.js')}}"></script>
        <script src="{{ asset('assets/js/app.min.js')}}"></script>
        
    </body>
</html>
