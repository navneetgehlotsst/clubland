@extends('web.layout.portal-master')
@section('content')


<div class="top_company_wrapper theme-bg jb_cover how-it-works">
  <div class="overlay-bg">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="top_hiring_cpmpany_heading jb_cover">
            <div class="jb_heading_wraper left_jb_jeading">
              <h3 class="text-white text-center">{{$page->name}}</h3>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="grow_next_wrapper jb_cover bg-white">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-12 col-sm-12 align-self-center">
        <div class="grow_next_img jb_cover"> 
        {!! $page->content !!}
        </div>
      </div>
      
    </div>
  </div>
</div>

@endsection