@extends('web.layout.portal-master')
@section('content')
<style>
    .btn-primary {
    background-color: #1E532E !important;
    border-color: #1E532E !important;
}

</style>
<section class="sptb">
         <div class="row">
            <div class="col-sm-4"></div>
            <aside class="col-sm-4 offset-3">
                <article class="card">
                    <div class="card-body p-3">
                        <div class="col-md-12 text-center">
                            <img src="{{asset('web/images/bg.png')}}" height="100">
                            <div class="text-center mt-3">
                                <h1>Thank You !</h1>
                                <p>We have forwarded the details to your email</p>
                                <div class="button_div">
                                    <a href="{{env('HTTP_TYPE').request('username').'.'.env('BASE_DOMAIN')}}" class="btn btn-50 mt-4">Back Home</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>
            
                
            </aside>
            <div class="col-sm-3"></div>

        </div>
</section>
  @endsection
