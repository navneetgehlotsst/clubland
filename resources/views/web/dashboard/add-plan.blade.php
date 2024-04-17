@extends('web.layout.master')
@section('content')
<style>
  .planoptino{
    display:none;
  }
  .add-btn-class{
    position: relative;
  }
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
                <li>Plan Add</li>
              </ul>
            </div>
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
            <div class="feature_box d-block add_membership_plan">
                <div class="title_div d-flex align-items-center justify-content-between mb-20">
                    <div class="titile_content">
                      <h2 class="border_bottom">Add Plan</h2>
                    </div>
                    <div class="add_new">
                      <div class="button_div"><a class="btn mr-1" href="{{route('member_ship')}}"><i class="icon-membership"></i> View Plans</a></div>
                    </div>
                </div>
                <form class="dashboard_form" action="{{route('plan_store')}}" name="addPlanform" enctype="multipart/form-data" method="post">
                  @csrf
                  <div class="form-group comments_form membership-type">
                    <label>Membership Type</label>
                    <div class="custom-control custom-radio custom-control-inline">
                      <input type="radio" checked id="plan_type_individual" value="individual" name="membership-type" required class="custom-control-input">
                      <label class="custom-control-label" for="plan_type_individual">Individual</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                      <input type="radio" required id="plan_type_family" value="family" name="membership-type" class="custom-control-input">
                      <label class="custom-control-label" for="plan_type_family">Family</label>
                      <div class="maximum-people">
                        <label>Maximum People Allowed</label>
                        <div class="comments_form mb-0">
                          <select class="form-control form-select small" required name="maximum_people" aria-label="Default select example">
                            <option value="2">Upto 2 people</option>
                            <option value="3">Upto 3 people</option>
                            <option value="4">Upto 4 people</option>
                            <option value="5">Upto 5 people</option>
                            <option value="6">Upto 6 people</option>
                            <option value="7">Upto 7 people</option>
                            <option value="8">Upto 8 people</option>
                            <option value="9">Upto 9 people</option>
                            <option value="10">Upto 10 people</option>
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="form-group comments_form">
                    <div class="row">
                      <div class="col-lg-6">
                        <label>Plan Name</label>
                        <input type="text" required class="form-control" name="plan_name" placeholder="Enter Plan Name">
                      </div>
                      <div class="col-lg-6">
                        <label>Select Type</label>
                        <select class="form-control form-select w-100" name="ticket_type" required id="PlanType" aria-label="Default select example">
                          <option value="Free">Free</option>
                          <option value="Paid">Paid</option>
                        </select>
                      </div>

                      <div class="col-lg-6 mt-2 mt-lg-2 planoptino">
                            <label>Price</label>
                            <input type="number" min="1" required name="price" class="form-control number priceAmount" placeholder="Enter Price" onkeyup="changequantity()">
                            <!-- <p class="mt-2 text-danger" style="font-size:13px;" >Note : (3.75% + 50c) will be added to the total amount. </p> -->
                       </div>
                       <div class="col-lg-6 mt-2 mt-lg-2 planoptino">
                          <label>Discount (In %)</label>
                          <input type="number" name="discount" id="discountInput"  class="form-control number" placeholder="Enter Discount">
                          <p class="mt-2 text-danger Discount" style="display:none; font-size:13px;" >Discount value is not valid. Please enter a value between 1 and 99.</p>
                      
                        </div>
                        <!-- <div class="col-lg-6 mt-2 mt-lg-2 planoptino">
                          <label>Final Amount</label>
                          <input type="text" value=""  class="form-control finalamount" placeholder="Enter Discount" disabled>

                        </div> -->
                    </div>
                  </div>
                  <div class="form-group comments_form terms-of-plan">
                    <label>Terms of Plan</label>
                    <div class="custom-control custom-radio custom-control-inline">
                      <input type="radio" required id="plan_terms_monthly" value="monthly" checked name="plan_terms" class="custom-control-input">
                      <label class="custom-control-label" for="plan_terms_monthly">Monthly</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                      <input type="radio" required id="plan_terms_quarterly" value="quarterly" name="plan_terms" class="custom-control-input">
                      <label class="custom-control-label" for="plan_terms_quarterly">Quarterly</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                      <input type="radio" required id="plan_terms_half_yearly" value="half yearly" name="plan_terms" class="custom-control-input">
                      <label class="custom-control-label" for="plan_terms_half_yearly">Half Yearly</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                      <input type="radio" required id="plan_terms_annually" value="annually" name="plan_terms" class="custom-control-input">
                      <label class="custom-control-label" for="plan_terms_annually">Annually</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                      <input type="radio" required id="plan_terms_custom" name="plan_terms" value="custom" class="custom-control-input">
                      <label class="custom-control-label" for="plan_terms_custom"><span>Custom</span></label>
                      <input type="text" required class="custom_input form-control" name="custome_month" placeholder="Eg.: 4 months">
                    </div>
                  </div>
                  
                  <div class="form-group comments_form benefits_group">
                    <label>Benefits</label>
                    <div class="add_more_benefit">
                      <input type="text" required class="form-control" name="benefit[0]" placeholder="Enter benefits">
                      <div class="icon_div bg-gray" id="plan_benefits" data-count="1">
                        <a href="javascript:void(0)">
                          <i class="icon-plus"></i>
                        </a>
                      </div>
                    </div>
                    <div id="paln_append">
                    </div>
                  </div>
                  <div class="form-group comments_form">
                    <label>Short Description</label>
                    <textarea class="form-control" required maxlength="250" name="sort_description" placeholder="Enter Short Description"></textarea>
                  </div>

                  <div class="form-group comments_form">
                    <label>Plan Summary</label>
                    <textarea class="form-control" name="plan_summary" id="editor2" placeholder="Enter Plan Summary"></textarea>
                  </div>
                  <div class="form-group comments_form">
                    <label>Terms & Conditions</label>
                    <textarea class="form-control" name="term_condition" id="editor1" placeholder="Enter Terms and Conditions"></textarea>
                  </div>
                
                  <div class="form-group comments_form benefits_group">
                    <label>Own Question</label>
                    <div class="add_more_benefit">
                      <input type="text" class="form-control" name="own_question[0]" placeholder="Enter Own Question">
                      <div class="icon_div bg-gray" id="own_question" data-count="1">
                        <a href="javascript:void(0)">
                          <i class="icon-plus"></i>
                        </a>
                      </div>
                    </div>
                    <div id="own_question_append">
                    </div>
                  </div>
                  <div class="button_div float-end mt-30">
                    <button type="submit" class="btn btn-50 discountsubmit" >Publish Plan</button>
                  </div>
                  
                </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Dashboard Inner Content Section End -->
  @endsection
