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
                            <img src="{{asset('web/images/stripe-payment.png')}}" height="100">
                        </div>
                    </div>
                </article>
            
                <article class="card">
                    <div class="card-header">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12 text-right">
                                <div class="card-body">                     
                                    <div class="d-flex justify-content-between">
                                            <p class="mb-2 h5">Amount</p>
                                        @if($booking->discount == 0)
                                            <p class="mb-2 h5">${{number_format($booking->price,2)}}</p>
                                        @else
                                            <p class="mb-2 h5">${{$booking->fixed_amount}}</p>
                                        @endif
                                    </div>

                                    <div class="d-flex justify-content-between">
                                        <p class="mb-2 h5">Platform fee</p>
                                        <p class="mb-2 h5">${{number_format($platformFee,2)}}</p>
                                    </div>
                                    <hr class="my-4">
                                    @if($booking->discount == 0)
                                    <div class="d-flex justify-content-between mb-4">
                                        <p class="mb-2 h5">Total(Incl. Platform fee)</p>
                                        <p class="mb-2 font-weight-bold h5">${{number_format($booking->price,2) + number_format($platformFee,2)}}</p>
                                    </div>
                                    @else
                                    <div class="d-flex justify-content-between mb-4">
                                        <p class="mb-2 h5">Total(Incl. Platform fee)</p>
                                        <p class="mb-2 font-weight-bold h5">${{number_format($booking->fixed_amount,2) + number_format($platformFee,2)}}</p>
                                    </div>
                                    @endif

                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-5">
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="nav-tab-card">
                                <form id="payment-form">
                                    @csrf
                                    <input type="hidden" name="booking_id" value="{{$booking->id}}">
                                    <input type="hidden" name="user_name" value="{{@$data['user_name']}}">
                                    <input type="hidden" name="email" value="{{@$data['email']}}">
                                    <input type="hidden" name="phone_number" value="{{@$data['phone_number']}}">
                                    <input type="hidden" name="address" value="{{@$data['address'] ?? ''}}">
                                    <input type="hidden" name="business_slug" value="{{$businessSlug}}">
                                    <input type="hidden" name="ans" value="{{@$ans}}">
                                    <input type="hidden" name="name" value="{{@$peoplename}}">
                                    <input type="hidden" name="phone" value="{{@$peoplephone}}">
                                    <input type="hidden" name="people_email" value="{{@$peopleemail}}">
                                    <input type="hidden" name="type" value="{{@$type}}">
                                    <input type="hidden" name="customer_id" value="{{@$customer}}">
                               

                                    <input type="hidden" name="card_token" id="card_token" value="">
                                    <!-- Your form fields for card details, e.g., card number, expiration date, CVC -->
                                    <div id="card-element"></div>
                                    <!-- Used to display card errors -->
                                    <div id="card-errors" role="alert" class="text-danger mt-2"></div>
                                    <div class="mt-5"></div>

                                    @if($booking->discount == 0)
                                        <button class="subscribe btn btn-primary btn-block "  type="submit">Pay&nbsp;${{number_format($booking->price,2) + number_format($platformFee,2)}}</button>
                                    @else
                                    <button class="subscribe btn btn-primary btn-block" type="submit">Pay&nbsp;${{number_format(((3.75 / 100) * $booking->fixed_amount) + 0.50 + $booking->fixed_amount,2)}}</button>
                                       
                                        
                                    @endif
                                    
                                </form>
                            </div>
                        </div>
                    </div>
                </article>
            </aside>
            <div class="col-sm-3"></div>

        </div>
</section>
  @endsection
  @section('script')
<script src="https://js.stripe.com/v3/"></script>

<script>
    const stripe_key = @json(env('STRIPE_KEY'));

    const stripe = Stripe(stripe_key);

    // Create an instance of the Stripe elements
    const elements = stripe.elements();
    const cardElement = elements.create('card');

    // Add the card element to the DOM
    cardElement.mount('#card-element');

    const form = document.getElementById('payment-form');

    form.addEventListener('submit', async function (event) {
        event.preventDefault();
        $(".jb_preloader").removeClass("loaded");

        // Create a token from the card element
        const { token, error } = await stripe.createToken(cardElement);
        if (error) {
            // Display errors to the user
            const errorElement = document.getElementById('card-errors');
            errorElement.textContent = error.message;
            $('.jb_preloader').addClass('loaded')
        } else {
                $('#card-errors').hide();
                let card_token = token.id;
                $('#card_token').val(card_token);
                makePayment();
        }
    });

    function makePayment() {
        let form = $('#payment-form')[0];
        let data = new FormData(form);
        let url = "/thank-you";
        $.ajax({
            url: "{{url('/payment/')}}",
            type: "POST",
            data:data,
            processData : false,
            contentType:false,
            
            success: function(response) {
                $('.jb_preloader').addClass('loaded')
                if (response.errors) {
                    Toast.fire({
                        icon: 'error',
                        title: response.errors
                    });
                } else {
                    window.location.href = url;
                }
                
            },
            error: function(xhr, status, error) {
             $('.jb_preloader').addClass('loaded')
                Toast.fire({
                    icon: 'error',
                    title: error
                });
            }
        });
    }
</script>


@endsection