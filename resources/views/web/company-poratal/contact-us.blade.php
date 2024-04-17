@extends('web.layout.portal-master')
@section('content')
<div class="blog_wrapper pb-3 jb_cover">
  <div class="container pb-5">
    <div class="row">
    <div class="col-lg-3 col-md-12 col-sm-12">
</div>
      <div class="col-lg-6 col-md-12 col-sm-12">
        <div class="blog_newsleeter jb_cover">
          <div class="animation-circle-inverse"><i></i><i></i><i></i></div>
              <form action="#" method="post">
                @csrf
                <h1>CONTACT US</h1>
               
                <div class="contect_form3 blog_letter">
                  <input type="text" required name="name" placeholder="Enter Your Name">
                </div>
                <div class="contect_form3 blog_letter">
                  <input type="email" required name="email" placeholder="Enter Your Email">
                </div>
                <div class="contect_form3 blog_letter" style="padding-bottom: 15px;">
                  <textarea class="form-control" required name="content" placeholder="Your message" ></textarea>
                </div>
                <br>
                <div class="header_btn search_btn submit_btn jb_cover">
                   <button type="submit" class="submit_btn btn btn-50 w-100 d-flex align-items-center justify-content-center" style="width: 100%;background: #d97333;border: 1px solid #d97333;">submit</button> 
                  </div>
              </form>
        </div>
      </div>
    
    </div>
  </div>
</div>
@endsection