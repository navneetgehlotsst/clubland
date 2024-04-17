<div class="blog_wrapper pb-3 jb_cover">
  <div class="container pb-5">
    <div class="row">
      <div class="col-lg-4 col-md-12 col-sm-12">
        <div class="blog_newsleeter jb_cover">
          <div class="animation-circle-inverse"><i></i><i></i><i></i></div>
              <form action="{{route('inquiry.store')}}" method="post">
                @csrf
                <h1>Get in touch </h1>
                <p>To get in touch , please provide 
                  following information:</p>
                <div class="contect_form3 blog_letter">
                  <input type="text" required name="content" placeholder="How can we help ?">
                </div>
                <div class="contect_form3 blog_letter">
                  <input type="text" required name="name" placeholder="Your name">
                </div>
                <div class="contect_form3 blog_letter">
                  <input type="email" required name="email" placeholder="Your email">
                </div>
                <div class="header_btn search_btn submit_btn jb_cover">
                   <!-- <a href="#">submit</a> -->
                   <button type="submit" class="submit_btn btn btn-50 w-100 d-flex align-items-center justify-content-center" style="width: 100%;background: #d97333;border: 1px solid #d97333;">submit</button> 
                  </div>
              </form>
        </div>
      </div>
      <div class="col-lg-8 col-md-12 col-sm-12">
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12">
            <div id="accordion" role="tablist">
              <h1>Frequently Asked Question?</h1>
             
              @foreach ($faq as $key => $val )
                  <div class="card">
                    <div class="card_pagee" role="tab" id="heading{{$key}}">
                      <h5 class="h5-md"> <a class="collapsed" data-toggle="collapse" href="#collapse{{$key}}" role="button" aria-expanded="false" aria-controls="collapse{{$key}}"> {{$val->question}} </a> </h5>
                    </div>
                    <div id="collapse{{$key}}" class="collapse" role="tabpanel" aria-labelledby="heading{{$key}}" data-parent="#accordion" style="">
                      <div class="card-body">
                        <div class="card_cntnt">
                          <p>{{$val->answer}}</p>
                        </div>
                      </div>
                    </div>
                  </div>
              @endforeach
              
              
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>