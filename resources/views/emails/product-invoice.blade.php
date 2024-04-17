<!DOCTYPE html>

<html lang="zxx">



<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <title> Order confirmation </title>

    <meta name="robots" content="noindex,nofollow" />

    <meta name="viewport" content="width=device-width; initial-scale=1.0;" />

    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.9/semantic.min.css"> -->

</head>



<style type="text/css">

    @import url(https://fonts.googleapis.com/css?family=Open+Sans:400,700);



    body {

        margin: 0;

        padding: 0;

        background: #e1e1e1;

    }



    div,

    p,

    a,

    li,

    td {

        -webkit-text-size-adjust: none;

    }



    .ReadMsgBody {

        width: 100%;

        background-color: #ffffff;

    }



    .ExternalClass {

        width: 100%;

        background-color: #ffffff;

    }



    body {

        width: 100%;

        height: 100%;

        background-color: #e1e1e1;

        margin: 0;

        padding: 0;

        -webkit-font-smoothing: antialiased;

    }



    html {

        width: 100%;

    }



    p {

        padding: 0 !important;

        margin-top: 0 !important;

        margin-right: 0 !important;

        margin-bottom: 0 !important;

        margin-left: 0 !important;

    }



    .visibleMobile {

        display: none;

    }



    .hiddenMobile {

        display: block;

    }



    @media only screen and (max-width: 600px) {

        body {

            width: auto !important;

        }



        table[class=fullTable] {

            width: 96% !important;

            clear: both;

        }



        table[class=fullPadding] {

            width: 85% !important;

            clear: both;

        }



        table[class=col] {

            width: 45% !important;

        }



        .erase {

            display: none;

        }

    }



    @media only screen and (max-width: 420px) {

        table[class=fullTable] {

            width: 100% !important;

            clear: both;

        }



        table[class=fullPadding] {

            width: 85% !important;

            clear: both;

        }



        table[class=col] {

            width: 100% !important;

            clear: both;

        }



        table[class=col] td {

            text-align: left !important;

        }



        .erase {

            display: none;

            font-size: 0;

            max-height: 0;

            line-height: 0;

            padding: 0;

        }



        .visibleMobile {

            display: block !important;

        }



        .hiddenMobile {

            display: none !important;

        }

    

    }

</style>

<body> 

    <!-- Header -->

<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="fullTable" bgcolor="#e1e1e1">

    <tr>

      <td height="20"></td>

    </tr>

    <tr>

      <td>

        <table width="600" border="0" cellpadding="0" cellspacing="0" align="center" class="fullTable" bgcolor="#ffffff" style="border-radius: 10px 10px 0 0;">

          <tr class="hiddenMobile">

            <td height="40"></td>

          </tr>

          <tr class="visibleMobile">

            <td height="30"></td>

          </tr>

  

          <tr>

            <td>

              <table width="480" border="0" cellpadding="0" cellspacing="0" align="center" class="fullPadding">

                <tbody>

                  <tr>

                    <td>

                      <table width="220" border="0" cellpadding="0" cellspacing="0" align="left" class="col">

                        <tbody>

                          <tr>

                            <td align="left"> <img src="https://clublandservices.com/web/images/logo.png" width="200" height="" alt="logo" border="0" /></td>

                          </tr>

                          <tr class="hiddenMobile">

                            <td height="40"></td>

                          </tr>

                          <tr class="visibleMobile">

                            <td height="20"></td>

                          </tr>

                        </tbody>

                      </table>

                      <table width="220" border="0" cellpadding="0" cellspacing="0" align="right" class="col">

                        <tbody>

                          <tr class="visibleMobile">

                            <td height="20"></td>

                          </tr>

                          <tr>

                            <td height="5"></td>

                          </tr>

                          <tr>

                            <td style="font-size: 21px; color: #000; letter-spacing: -1px; font-weight: 600; font-family: 'Open Sans', sans-serif; line-height: 1; vertical-align: top; text-align: right;">

                              Invoice

                            </td>

                          </tr>

                          <tr>

                            <td style="font-size: 12px; color: #5b5b5b; font-family: 'Open Sans', sans-serif; line-height: 18px; vertical-align: top; text-align: right; padding-top: 10px;">

                              <small>#ORDERID00{{$data['orderId']}}</small><br />

                              <small>{{\Carbon\Carbon::parse($data['orderDate'])->format('d/m/Y')}}</small>

                            </td>

                          </tr>

                          <tr>

                          <tr class="hiddenMobile">

                            <td height="50"></td>

                          </tr>

                          <tr class="visibleMobile">

                            <td height="20"></td>

                          </tr>

                        </tbody>

                      </table>

                    </td>

                  </tr>

                </tbody>

              </table>

            </td>

          </tr>

          <tr>

            <td>

                <table width="480" border="0" cellpadding="0" cellspacing="0" align="center"

                    class="fullPadding">

                    <tbody>

                        <tr>

                            <td style="padding-top: 20px;">

                                <table width="220" border="0" cellpadding="0" cellspacing="0"

                                    align="left" class="col">



                                    <tbody>

                                        <tr>

                                            <td

                                                style="font-size: 11px; font-family: 'Open Sans', sans-serif; color: #5b5b5b; line-height: 1; vertical-align: top; ">

                                                <strong>BILLING INFORMATION</strong>

                                            </td>

                                        </tr>

                                        <tr>

                                            <td width="100%" height="10"></td>

                                        </tr>

                                        <tr>

                                            <td

                                                style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #5b5b5b; line-height: 20px; vertical-align: top; ">

                                                {{$data['user_name']}}

                                                @if($data['address'])

                                                <br> {{$data['address'] ?? ''}}

                                                @endif

                                                <br> {{$data['phone_number']}}

                                            </td>

                                        </tr>

                                    </tbody>

                                </table>





                                <table width="220" border="0" cellpadding="0" cellspacing="0"

                                    align="right" class="col">

                                    <tbody>

                                        

                                        <tr style="font-size: 12px; color: #5b5b5b; font-family: 'Open Sans', sans-serif; line-height: 18px; vertical-align: top; text-align: right;">

                                            <td

                                                style="font-size: 11px; font-family: 'Open Sans', sans-serif; color: #5b5b5b; line-height: 1; vertical-align: top; text-align: right;">

                                                <strong>BUSINESS INFORMATION</strong>

                                            </td>

                                        </tr>

                                        <tr>

                                            <td width="100%" height="10"></td>

                                        </tr>

                                        <tr>

                                            <td

                                                style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #5b5b5b; line-height: 20px; vertical-align: top; text-align: right;">

                                                {{$data['business_name']}}<br> {{$data['business_email']}}<br>

                                                +{{$data['business_country_code']}}{{$data['business_phone']}}

                                            </td>

                                        </tr>

                                    </tbody>

                                </table>

                            </td>

                        </tr>

                    </tbody>

                </table>

            </td>

        </tr>

        </table>

      </td>

    </tr>

  </table>

  <!-- /Header -->

    <!-- Order Details -->
    @if(count($data['orderdata']) != 0)
    <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="fullTable" bgcolor="#e1e1e1">

        <tbody>

            <tr>

                <td>

                    <table width="600" border="0" cellpadding="0" cellspacing="0" align="center" class="fullTable"

                        bgcolor="#ffffff">

                        <tbody>

                            <tr>

                            <tr class="hiddenMobile">

                                <td height="30"></td>

                            </tr>

                            <tr class="visibleMobile">

                                <td height="20"></td>

                            </tr>

                            <tr>

                                <td>

                                    <table width="480" border="0" cellpadding="0" cellspacing="0" align="center"

                                        class="fullPadding">

                                        <tbody>
                                            <tr>
                                                <td style="font-size: 16px; font-family: 'Open Sans', sans-serif; color: #000; font-weight: normal; line-height: 1; vertical-align: top; padding: 5px 0;">Products </td>
                                            </tr>
                                            <tr class="hiddenMobile">
                                                <td height="20"></td>
                                            </tr>
                                            <tr class="visibleMobile">
                                                <td height="10"></td>
                                            </tr>

                                            <tr>

                                                <th style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #5b5b5b; font-weight: normal; line-height: 1; vertical-align: top; padding: 0 10px 7px 0;"

                                                    width="52%" align="left">

                                                    <small>Item</small>

                                                </th>

                                                <th style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #5b5b5b; font-weight: normal; line-height: 1; vertical-align: top; padding: 0 0 7px;"

                                                    align="left">

                                                    <small>Rate</small>

                                                </th>

                                                <th style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #5b5b5b; font-weight: normal; line-height: 1; vertical-align: top; padding: 0 0 7px;"

                                                    align="left">

                                                    <small>SKU</small>

                                                </th>

                                                <th style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #5b5b5b; font-weight: normal; line-height: 1; vertical-align: top; padding: 0 0 7px;"

                                                    align="center">

                                                    <small>Quantity</small>

                                                </th>

                                                <th style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #1e2b33; font-weight: normal; line-height: 1; vertical-align: top; padding: 0 0 7px;"

                                                    align="right">

                                                    <small>Total</small>

                                                </th>

                                            </tr>

                                            @foreach($data['orderdata'] as $val)

                                                    <tr>
                                                        <td height="1" style="background: #bebebe;" colspan="5"></td>
                                                    </tr>
                                                    <tr>
                                                        <td height="10" colspan="5"></td>
                                                    </tr>
                                                    <tr>
                                                        <td style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #dc7433;  line-height: 18px;  vertical-align: top; padding:10px 0;" class="article">
                                                            {{$val->getProduct->product_name ?? ''}}
                                                            @if(isset($val->variation_id))
                                                                @if(isset($val->getProductVariation->size))
                                                                    &nbsp;<span class="spec">
                                                                    Size :  {{ucfirst($val->getProductVariation->size)}}
                                                                    </span>
                                                                @endif
                                                                @if(isset($val->getProductVariation->color))
                                                                    &nbsp;<span class="spec">
                                                                    Color :  {{ucfirst($val->getProductVariation->color)}}
                                                                    </span>
                                                                @endif
                                                            @endif
                                                        </td>
                                                        <td style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #646a6e;  line-height: 18px;  vertical-align: top; padding:10px 0;" align="center">

                                                            @if($val->variation_id)
                                                                @if($val->getProductVariation->discount_price == 0)
                                                                    ${{$val->getProductVariation->price}}
                                                                @else
                                                                    ${{$val->getProductVariation->discount_price}}
                                                                @endif
                                                            @else
                                                                @if($val->getProduct->product_discount != null && $val->getProduct->product_discount == 0)
                                                                    ${{$val->getProduct->product_price}}
                                                                @else
                                                                    ${{$val->getProduct->product_discount}}
                                                                @endif
                                                            @endif
                                                        </td>
                                                        <td style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #646a6e;  line-height: 18px;  vertical-align: top; padding:10px 0;">
                                                            {{$val->getProduct->product_sku}}
                                                        </td>
                                                        <td style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #646a6e;  line-height: 18px;  vertical-align: top; padding:10px 0;" align="center">{{$val->quantity}}
                                                        </td>
                                                        <td style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #1e2b33;  line-height: 18px;  vertical-align: top; padding:10px 0;" align="right">
                                                            <!-- ${{number_format($val->price,2)}} -->
                                                            @if($val->variation_id)
                                                                @if($val->getProductVariation->discount_price == 0)
                                                                    ${{$val->getProductVariation->price * $val->quantity}}
                                                                @else
                                                                    ${{$val->getProductVariation->discount_price * $val->quantity}}
                                                                @endif
                                                            @else
                                                                @if($val->getProduct->product_discount != null && $val->getProduct->product_discount == 0)
                                                                    ${{$val->getProduct->product_price * $val->quantity}}
                                                                @else
                                                                    ${{$val->getProduct->product_discount * $val->quantity}}
                                                                @endif
                                                            @endif
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td height="1" colspan="5" style="border-bottom:1px solid #e4e4e4"></td>
                                                    </tr>
                                            @endforeach

                                        </tbody>

                                    </table>
                                </td>

                            </tr>

                            <tr>

                                <td height="20"></td>

                            </tr>

                        </tbody>

                    </table>

                </td>

            </tr>

        </tbody>

    </table>
    @endif
    @if(count($data['ordereventdata']) != 0)
    <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="fullTable" bgcolor="#e1e1e1">

            <tbody>

                <tr>

                    <td>

                        <table width="600" border="0" cellpadding="0" cellspacing="0" align="center" class="fullTable"

                            bgcolor="#ffffff">

                            <tbody>

                                <tr>

                                <tr class="hiddenMobile">

                                    <td height="30"></td>

                                </tr>

                                <tr class="visibleMobile">

                                    <td height="20"></td>

                                </tr>

                                <tr>

                                    <td>

                                        <table width="480" border="0" cellpadding="0" cellspacing="0" align="center"

                                            class="fullPadding">

                                            <tbody>
                                                <tr>
                                                    <td style="font-size: 16px; font-family: 'Open Sans', sans-serif; color: #000; font-weight: normal; line-height: 1; vertical-align: top; padding: 5px 0;">Events </td>
                                                </tr>
                                                <tr class="hiddenMobile">
                                                    <td height="20"></td>
                                                </tr>
                                                <tr class="visibleMobile">
                                                    <td height="10"></td>
                                                </tr>

                                                <tr>

                                                    <th style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #5b5b5b; font-weight: normal; line-height: 1; vertical-align: top; padding: 0 10px 7px 0;"

                                                        width="52%" align="left">

                                                        <small>Event</small>

                                                    </th>

                                                    <th style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #5b5b5b; font-weight: normal; line-height: 1; vertical-align: top; padding: 0 0 7px;"

                                                        align="center">

                                                        <small>Rate</small>

                                                    </th>

                                                    <th style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #5b5b5b; font-weight: normal; line-height: 1; vertical-align: top; padding: 0 0 7px;"

                                                        align="center">

                                                        <small>Ticket Quantity</small>

                                                    </th>

                                                    <th style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #5b5b5b; font-weight: normal; line-height: 1; vertical-align: top; padding: 0 0 7px;"

                                                        align="left">

                                                        <small>Total</small>

                                                    </th>
                                                </tr>

                                                @foreach($data['ordereventdata'] as $keys => $value)

                                                        <tr>
                                                            <td height="1" style="background: #bebebe;" colspan="5"></td>
                                                        </tr>
                                                        <tr>
                                                            <td height="10" colspan="5"></td>
                                                        </tr>
                                                        
                                                        @if($value->ticket_type != 'Free')
                                                            @foreach($value['geteventTicket'] as $ke => $res)
                                                            <tr>
                                                                <td style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #dc7433;  line-height: 18px;  vertical-align: top; padding:10px 0;" class="article">
                                                                {{$value->name}} ({{$res->ticket_name}})
                                                                </td>
                                                                <td style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #646a6e;  line-height: 18px;  vertical-align: top; padding:10px 0;" align="center">
                                                                ${{$res->ticket_cost}}
                                                                </td>
                                                                <td style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #646a6e;  line-height: 18px;  vertical-align: top; padding:10px 0;" align="center">
                                                                {{$data['quanitiy'][$ke]['quantity']}}
                                                                </td>
                                                                <td style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #646a6e;  line-height: 18px;  vertical-align: top; padding:10px 0;">
                                                                ${{$res->ticket_cost * $data['quanitiy'][$ke]['quantity']}}
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                        @else
                                                            <tr>
                                                                <td style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #dc7433;  line-height: 18px;  vertical-align: top; padding:10px 0;" class="article">
                                                                {{$value->name}}
                                                                </td>
                                                                <td style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #646a6e;  line-height: 18px;  vertical-align: top; padding:10px 0;" align="center">
                                                                $0.00 (Free)
                                                                </td>
                                                                <td style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #646a6e;  line-height: 18px;  vertical-align: top; padding:10px 0;" align="center">
                                                                {{$data['quanitiy'][$keys]['quantity']}}
                                                                </td>
                                                                <td style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #646a6e;  line-height: 18px;  vertical-align: top; padding:10px 0;">
                                                                $0.00 (Free)
                                                                </td>
                                                            </tr>
                                                        @endif
                                                        

                                                        <tr>
                                                            <td height="1" colspan="5" style="border-bottom:1px solid #e4e4e4"></td>
                                                        </tr>
                                                @endforeach

                                            </tbody>

                                        </table>
                                    </td>

                                </tr>

                                <tr>

                                    <td height="20"></td>

                                </tr>

                            </tbody>

                        </table>

                    </td>

                </tr>

            </tbody>

    </table>
    @endif

    <!-- /Order Details -->

    <!-- Total -->

    <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="fullTable" bgcolor="#e1e1e1">

        <tbody>

            <tr>

                <td>

                    <table width="600" border="0" cellpadding="0" cellspacing="0" align="center" class="fullTable"

                        bgcolor="#ffffff">

                        <tbody>

                            <tr>

                                <td>



                                    <!-- Table Total -->

                                    <table width="480" border="0" cellpadding="0" cellspacing="0" align="center"

                                        class="fullPadding">

                                        <tbody>

                                            <tr>

                                                <td

                                                    style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #646a6e; line-height: 22px; vertical-align: top; text-align:right; ">

                                                    Subtotal

                                                </td>

                                                <td style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #646a6e; line-height: 22px; vertical-align: top; text-align:right; white-space:nowrap;" width="80">
                                                    ${{number_format($data['totalamount'],2)}}
                                                </td>

                                            </tr>

                                            <tr>

                                                <td style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #646a6e; line-height: 22px; vertical-align: top; text-align:right; ">
                                                    Platform Fees
                                                </td>

                                                <td style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #646a6e; line-height: 22px; vertical-align: top; text-align:right;">
                                                    ${{number_format($data['commission_amount'],2)}}
                                                </td>

                                            </tr>
                                            <tr>

                                                <td

                                                    style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #000; line-height: 22px; vertical-align: top; text-align:right; ">

                                                    <strong>Total(Incl. Platform fee)</strong>

                                                </td>

                                                <td

                                                    style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #000; line-height: 22px; vertical-align: top; text-align:right; ">

                                                    <strong class="totalIncAmount">${{number_format($data['destination_amount']['destination_amount'],2)}}</strong>

                                                </td>

                                            </tr>

                                        </tbody>

                                    </table>

                                    <!-- /Table Total -->



                                </td>

                            </tr>

                        </tbody>

                        <tr class="hiddenMobile">

                            <td height="60"></td>

                        </tr>

                        <tr class="visibleMobile">

                            <td height="30"></td>

                        </tr>

                    </table>

                </td>

            </tr>

            <td height="40"></td>

        </tbody>

    </table>

    

    <!-- /Total -->

</body>



</html>

<script src="{{asset('/web/js/jquery-3.3.1.min.js')}}"></script> 



<script>

   



  </script>