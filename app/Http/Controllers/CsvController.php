<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{MembershipPlan,MembershipPlanAppend,Payment,Event};
use Mail,Hash,File,Http,DB,Auth,Session,Stripe;
use Carbon\Carbon;

class CsvController extends Controller
{
    public function generateCsv(Request $request,$type)
    {
        try {
            $currentDate = Carbon::now();
            if($type == 'active'){
                $data = Payment::with(['getMemeberShip' => function ($q) {
                    $q->withTrashed();
                }])
                ->where('type', 'membership')
                ->where('autorenew', '1')
                ->where('expire_date', '>=', $currentDate)
                ->where('destination', Auth::user()->stripe_connect_id)
                ->orderBy('id','DESC')
                ->get();
            }else{
                $data = Payment::with(['getMemeberShip' => function ($q) {
                    $q->withTrashed();
                }])
                ->where('type', 'membership')
                ->where('expire_date', '<', $currentDate)
                ->where('destination', Auth::user()->stripe_connect_id)
                ->orwhere('autorenew', '0')
                ->orderBy('id','DESC')
                ->get();
            }
            $headers = array(
                "Content-type" => "member-ship-history/csv",
                "Content-Disposition" => "attachment; filename=member-ship-history.csv",
                "Pragma" => "no-cache",
                "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
                "Expires" => "0"
            );
            $columns = array('OrderId', 'Name', 'Email' , 'Plan Name' , 'Price' , 'Expiry Date' , 'Terms of Plan' , 'Membership Type' , 'Auto Renewal' );
        
            $callback = function() use ($data, $columns)
            {
                $file = fopen('php://output', 'w');
                fputcsv($file, $columns);
        
                foreach($data as $items) {
                    if($items->getMemeberShip->custome_month != 0){
                       $terms = $items->getMemeberShip->custome_month;
                    }else{
                        $terms = $items->getMemeberShip->plan_terms;
                    }
                  
                    if($items->card_token){
                       $price = '$'.$items->destination_amount;
                    }else{
                       $price = 'Free';
                    }
                    fputcsv($file, array('#ORDERID00'.$items->id, $items->user_name,$items->user_email, $items->getMemeberShip->plan_name,$price,date('d-m-Y', strtotime($items->expire_date)),$terms,$items->getMemeberShip->membership_type,'Available'));
        
                }
                fclose($file);
            };
        return response()->stream($callback, 200, $headers)->send();
        } catch (\Throwable $th) {
            dd($th);
        }
        
    }

    public function generateTicketCsv(Request $request){
        try {
          
            $data = Payment::where('type', 'event')
            ->where('destination', Auth::user()->stripe_connect_id)->orderBy('id','DESC')
            ->get();
               
            $headers = array(
                "Content-type" => "ticket-history/csv",
                "Content-Disposition" => "attachment; filename=ticket-history.csv",
                "Pragma" => "no-cache",
                "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
                "Expires" => "0"
            );
            $columns = array('OrderId', 'Event Name', 'Name', 'Email' , 'Booking Date');
        
            $callback = function() use ($data, $columns)
            {
                $file = fopen('php://output', 'w');
                fputcsv($file, $columns);
                foreach($data as $items) {
                    if(!empty($items->geteventOrderItemHistory)) {
                        foreach ($items->geteventOrderItemHistory as $key => $value) {
                            if($items->payment_status == ''){
                                $orderId = '#ORDERID00' . $items->id;
                            }else{
                                $orderId = '#ORDERID00' . $items->booking_id;

                            }
                            fputcsv($file, [
                                $orderId,
                                $value->getEvent->name,
                                $items->user_name,
                                $items->user_email,
                                date('d-m-Y', strtotime($items->created_at))
                            ]);
                        }
                    }
                }
                fclose($file);
            };
        return response()->stream($callback, 200, $headers)->send();
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function generateProductCsv(Request $request){
        try {
          
            $data = Payment::where('type', 'product')
            ->where('destination', Auth::user()->stripe_connect_id)
            ->orderBy('id','DESC')
            ->get();
            $headers = array(
                "Content-type" => "product-history/csv",
                "Content-Disposition" => "attachment; filename=product-history.csv",
                "Pragma" => "no-cache",
                "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
                "Expires" => "0"
            );
            $columns = array('OrderId','Product Name' , 'Quantity' ,'Size', 'Color' , 'Name', 'Email' , 'Booking Date');
        
            $callback = function() use ($data, $columns)
            {
                $file = fopen('php://output', 'w');
                fputcsv($file, $columns);
        
                foreach ($data as $items) {
                    if(!empty($items->getproductOrderItemHistory)) {
                        foreach ($items->getproductOrderItemHistory as $key => $value) {
                            $size = isset($value->variation_id) && isset($value->getProductVariation->size) ? ucfirst($value->getProductVariation->size) : '';
                            $color = isset($value->variation_id) && isset($value->getProductVariation->color) ? ucfirst($value->getProductVariation->color) : '';
                            fputcsv($file, [
                                '#ORDERID00' . $items->id,
                                $value->getProduct->product_name,
                                $value->quantity,
                                $size,
                                $color,
                                $items->user_name,
                                $items->user_email,
                                date('d-m-Y', strtotime($items->created_at))
                            ]);
                        }
                    } else {
                        fputcsv($file, [
                            '#ORDERID00' . $items->id,
                            '', // No product name available when there are no order items
                            '', // Quantity is not available
                            '', // Size not available
                            '', // Color not available
                            $items->user_name,
                            $items->user_email,
                            date('d-m-Y', strtotime($items->created_at))
                        ]);
                    }
                }
                fclose($file);
            };
        return response()->stream($callback, 200, $headers)->send();
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function generateFacilityCsv(Request $request){
        try {
          
            $data = Payment::with(['getFacility' => function ($q) {
                $q->withTrashed();
            }])
            ->where('type', 'facility')
            ->where('destination', Auth::user()->stripe_connect_id)
            ->orderBy('id','DESC')
            ->get();
            // dd($data[0]['getProduct']);
            $headers = array(
                "Content-type" => "facility-history/csv",
                "Content-Disposition" => "attachment; filename=facility-history.csv",
                "Pragma" => "no-cache",
                "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
                "Expires" => "0"
            );
            $columns = array('OrderId', 'Facility Name', 'Name', 'Email' , 'Booking Date');
        
            $callback = function() use ($data, $columns)
            {
                $file = fopen('php://output', 'w');
                fputcsv($file, $columns);
        
                foreach($data as $items) {
                    fputcsv($file, array('#ORDERID00'.$items->id, $items->getFacility->name,$items->user_name,$items->user_email,date('d-m-Y', strtotime($items->created_at))));
                }
                fclose($file);
            };
        return response()->stream($callback, 200, $headers)->send();
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    public function generateTransactionCsv(Request $request){
        try {
          
            $data = Payment::where('destination', Auth::user()->stripe_connect_id)
            ->orderBy('id','DESC')->where('charge_id','!=','')
            ->get();
            // dd($data[0]['getProduct']);
            $headers = array(
                "Content-type" => "transaction-history/csv",
                "Content-Disposition" => "attachment; filename=transaction-history.csv",
                "Pragma" => "no-cache",
                "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
                "Expires" => "0"
            );
            $columns = array('OrderId', 'Name', 'Email' , 'Amount');
        
            $callback = function() use ($data, $columns)
            {
                $file = fopen('php://output', 'w');
                fputcsv($file, $columns);
        
                foreach($data as $items) {
                    fputcsv($file, array('#ORDERID00'.$items->id, $items->user_name,$items->user_email,$items->destination_amount));
                }
                fclose($file);
            };
        return response()->stream($callback, 200, $headers)->send();
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    
}