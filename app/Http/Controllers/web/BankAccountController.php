<?php

namespace App\Http\Controllers\web;

use Illuminate\Http\Request;
use App\Models\{User,UserDocument,UserBankAccount};
use Illuminate\Support\Facades\Validator;
use Mail,Hash,File,Auth,DB,Helper,Exception,Session,Redirect;
use Stripe;
use App\Mail\BusinessComapnyPortalLink;
use App\Http\Controllers\StripeTrait;
use App\Http\Controllers\Controller;


class BankAccountController extends Controller
{
    
    public function checkAccount(){
        
     
        $user = Auth::user();
        $data = UserBankAccount::where('user_id', Auth::user()->id)->first();
        $img = UserDocument::where('user_id',Auth::user()->id)->first();
        $countries = DB::table('countries')->where('id', '14')->first();
        $states = DB::table('states')->where('country_id', '14')->get();
        $stripe_connect_id = $user->stripe_connect_id;

        if(empty($stripe_connect_id)){
            return view('web.dashboard.bank_account',compact('stripe_connect_id','user','data','img','countries','states'));   
        }else{
            return view('web.dashboard.bank_account',compact('stripe_connect_id','user','data','img','countries','states'));
        }
    }

    public function AddBankAccount(Request $request) {
        $this->validate($request, [
          //  'id_number' => 'required',            
            'first_name' => 'required',
            'last_name' => 'required',
            'account_number' => 'required',
            'routing_number' => 'required',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
            'phone_number' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif',
        ]);
        $data = $request->all();
        try {
                $imagefupath = "";
                if ($request->hasFile('image')) {
                    $file= $request->file('image');
                    $extension= $file->getClientOriginalExtension();
                    $filename = time().'.'.$extension;
                    $file-> move('public/document', $filename);
                    $imagefupath = $filename;
                }
               
                $document_file = public_path('public/document/').$imagefupath;
                if(!file_exists($document_file)) {
                    return back()->withInput()->withError("Document failed.");
                }
                $document_file_obj = fopen($document_file, "r");
                $file = StripeTrait::createFile([
                    'file' => $document_file_obj,
                    'purpose' => 'identity_document',
                ]);
                if(isset($file['message']) && $file['message'] != "") {
                    return back()->withInput()->withError($file['message']);

                }
                $user = Auth::user();
                $state = DB::table('states')->where('id', $data['state'])->first();
                $file_id = $file['file_token'];
               // $country_code = '+'.$country_c->phonecode;
                //$currency = $country_c->currency;
                $account = StripeTrait::createAccount([
                "country" => 'AU',
                "email" => $user->email ?? '',
                "firstname" => $data['first_name'],
                "lastname" => $data['last_name'],
                "phone" => '+61'.$data['phone_number'],
                "dob_month" => date('m',strtotime($data['dob'])),
                "dob_day"   => date('d',strtotime($data['dob'])),
                "dob_year"  => date('Y',strtotime($data['dob'])),
                //"id_number" => $request->id_number,
                "address_line1" => $user->address,
                "address_line2" => $user->address,
                "postal_code" => '4008',
                "city" => $data['city'],
                "state" => $state->iso2,
                "business_url" => url('/'),
                "business_mcc" => '5521',
                "user_ip" => $request->ip(),
                "file_id" => $file_id,
                "external_account" => [
                    'object' => "bank_account",
                    'country' => 'AU',
                    'currency' =>  'AUD', // 'aud',
                    'account_holder_name' => $data['first_name'].' '.$data['last_name'],
                    'account_holder_type' => 'individual',
                    'routing_number' => $request->routing_number,
                    'account_number' => $request->account_number,
                ]
            ]);
            if(isset($account['message']) && $account['message'] != "") {
                $mess = $account['message']['message'];
                return redirect()->route('check')->withInput()->withError($mess);
            }
            $user = Auth::user();
            $user->stripe_connect_id = $account['account_token'];
            $user->stripe_account_status = 'active';
            $user->save();
            $document = new UserDocument;
            $document->user_id = auth()->user()->id;
            $document->image = $imagefupath;
            $document->status = 1;
            $document->save();
            $bank_account = new UserBankAccount;
            $bank_account->user_id = Auth::user()->id ?? '';
            $bank_account->custom_account_id = $account['account_token'];
            $bank_account->bank_account_id = $account['bank_account_token'];
            $bank_account->first_name = $data['first_name'];
            $bank_account->last_name  = $data['last_name'];
            $bank_account->bank_name  = $account['bank_name'];
            $bank_account->last4 = $account['last4'];
            $bank_account->routing_number = $request->routing_number;
            $bank_account->country = $data['country'];
            $bank_account->address_line1 = $user->address;
            $bank_account->address_line2 = $user->address;
            $bank_account->postal_code = '2000';
            $bank_account->city  = $data['city'];
            $bank_account->state = $data['state'];
            $bank_account->phone_number = $data['phone_number'];
            $bank_account->dob = $data['dob'];
          //  $bank_account->id_number = $request->id_number;        
            $bank_account->account_number = $request->account_number;
            $bank_account->save();
            $user = Auth::user();
            $strip_message = "Your bank account added successfully";
            $checkhomesecation= Helper::checkHomeSecation();
            if(!empty($checkhomesecation)){
            $data['user_slug'] = $user->slug;
            Mail::to($user->email)->send(new BusinessComapnyPortalLink($data));
            }
            return Redirect::route('b_dashboard')->with('success',$strip_message);

        
        } catch (\Throwable $e) {
            return back()->withInput()->withError($e->getMessage());
        }              
    }


    public function updateBankAccount(Request $request) {
        $data = $request->all();
        
        $this->validate($request, [
         //   'id_number' => 'required',            
            'first_name' => 'required',
            'last_name' => 'required',
            'account_number' => 'required',
            'routing_number' => 'required',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
            'phone_number' => 'required',
        ]);

        
        try {
            $bank_account = UserBankAccount::where('user_id', Auth::user()->id)->first();
            $user_id =  Auth::user()->id;
            $user = User::find($user_id);
            $state = DB::table('states')->where('id', $data['state'])->first();
            $account = StripeTrait::updateAccount([
                "custom_account_id" => $bank_account->custom_account_id,
                "country" =>'AU',
                "email" => $user->email,
                "account_number_send" => $request->account_number,
                "firstname" => $data['first_name'],
                "lastname" => $data['last_name'],
                "phone" => '+61'.$data['phone_number'],
                "dob_month" => date('m',strtotime($data['dob'])),
                "dob_day" => date('d',strtotime($data['dob'])),
                "dob_year" => date('Y',strtotime($data['dob'])),
             //   "id_number" => $request->id_number,
                "address_line1" => $user->address,
                "address_line2" => $user->address,
                "postal_code" => $user->zip_code,
                "city" => $data['city'],
                "state" => $state->iso2,
                "business_url" => url('/'),
                "business_mcc" => '5521',
                "user_ip" => $request->ip(),
                "external_account" => [
                    'object' => "bank_account",
                    'country' => 'AU',
                    'currency' => 'AUD', //'aud',
                    'account_holder_name' => $data['first_name'].''.$data['last_name'],
                    'account_holder_type' => 'individual',
                    'routing_number' => $request->routing_number,
                    'account_number' => $request->account_number,
                ]
            ]);
            if(isset($account['message']) && $account['message'] != "") {
                $mess = $account['message']['message'];
                return redirect()->route('check')->withInput()->withError($mess);
            }

            $bank_account->user_id = $user_id;
            $bank_account->custom_account_id = $account['account_token'];
            $bank_account->bank_account_id = $account['bank_account_token'];
            $bank_account->first_name = $data['first_name'];
            $bank_account->last_name  = $data['last_name'];
            $bank_account->bank_name = $account['bank_name'];
            $bank_account->last4 = $account['last4'];
            $bank_account->routing_number = $request->routing_number;
            
            $bank_account->country = $data['country'];
            $bank_account->address_line1 = $user->address;
            $bank_account->address_line2 = $user->address;
            $bank_account->postal_code = '2000';
            $bank_account->city  = $data['city'];
            $bank_account->state = $data['state'];
            $bank_account->phone_number = $data['phone_number'];
            $bank_account->dob = $data['dob'];
           // $bank_account->id_number = $request->id_number;        
            $bank_account->account_number = $request->account_number;
            
            $bank_account->save();
            $strip_message = "Your bank account updated successfully";
            return Redirect::route('b_dashboard')->with('success',$strip_message);
        } catch (\Throwable $e) {
            return back()->withInput()->withError($e->getMessage());
        }
        
    }



    public function createAccount()
    {  
        $user  =  Auth::user();
        $errMessage    =  "";
        try{
            $stripe = new \Stripe\StripeClient('sk_test_51LicFNFkV20vz5IvJAd9bcT6sMycEJeD8xdFG81Uzf3cyOJZYjacfP2sQ6ReUdaLYJLsq5VkDhFAtf2oNCktolvm00gXjMn7iA');
            // create stripe connected express account
            $accountResponse = $stripe->accounts->create([
                'type' => 'express',
                'email' => $user->email,
                'capabilities' => [
                    'card_payments' => ['requested' => true],
                    'transfers' => ['requested' => true],
                ],
                'business_type' => 'individual',
                'individual' => [
                    'first_name' => $user->first_name,
                    'last_name' => $user->last_name,
                    'email' => $user->email,
                //   /  'phone' => '+'.$user->country_code.''.$user->phone,
                ]
            ]);

            if($accountResponse){
                $user->stripe_connect_id = $accountResponse->id;
                $user->save();
                $accLinkResponse = $stripe->accountLinks->create([
                    'account' => $accountResponse->id,
                    'refresh_url' => route('check'),
                    'return_url' => route('response'),
                    'type' => 'account_onboarding',
                ]);

                if($accLinkResponse){
                    $account_link_url =  $accLinkResponse->url;
                    return Redirect::to($account_link_url);
                }else{
                    return redirect()->route('check')->withError('Something went wrong!Account not created');
                }

            }else{
                return redirect()->route('check')->withError('Something went wrong!Account not created');
            }
            
        }
        catch(\Stripe\Exception\InvalidRequestException $e) {
            $errMessage    =   $e->getMessage();
        }
        catch(\Stripe\Exception\CardException $e) {
            $errMessage    =   $e->getMessage();
        } catch (\Stripe\Error\InvalidRequest $e) {
            // Invalid parameters were supplied to Stripe's API
            $errMessage    =   $e->getMessage();
        } catch (\Stripe\Error\Authentication $e) {
            // Authentication with Stripe's API failed
            // (maybe you changed API keys recently)
            $errMessage    =   $e->getMessage();
        } catch (\Stripe\Error\ApiConnection $e) {
            // Network communication with Stripe failed
            $errMessage    =   $e->getMessage();
        } catch (\Stripe\Error\Base $e) {
            // Display a very generic error to the user, and maybe send
            // yourself an email
            $errMessage    =   $e->getMessage();
        } catch (\Stripe\Exception $e) {
            // Something else happened, completely unrelated to Stripe
            $errMessage    =   $e->getMessage();
        }catch(Exception $e){
            $errMessage    =   $e->getMessage();
        }

        return redirect()->route('check')->withError($errMessage);
    }


    public function updateAccount()
    {  
        $user  =  Auth::user();
        $errMessage    =  "";
        try{
            
            $stripe = new \Stripe\StripeClient('sk_test_51LicFNFkV20vz5IvJAd9bcT6sMycEJeD8xdFG81Uzf3cyOJZYjacfP2sQ6ReUdaLYJLsq5VkDhFAtf2oNCktolvm00gXjMn7iA');
            $accLinkResponse = $stripe->accountLinks->create([
                'account' => $user->stripe_connect_id,
                'refresh_url' => route('check'),
                'return_url' => route('response'),
                'type' => 'account_onboarding',
            ]);
            
            if($accLinkResponse){
                $account_link_url =  $accLinkResponse->url;
                return Redirect::to($account_link_url);
            }else{
                return redirect()->route('check')->withError('Something went wrong!Account not updated');
            }

        }
        catch(\Stripe\Exception\InvalidRequestException $e) {
            $errMessage    =   $e->getMessage();
        }
        catch(\Stripe\Exception\CardException $e) {
            $errMessage    =   $e->getMessage();
        } catch (\Stripe\Error\InvalidRequest $e) {
            // Invalid parameters were supplied to Stripe's API
            $errMessage    =   $e->getMessage();
        } catch (\Stripe\Error\Authentication $e) {
            // Authentication with Stripe's API failed
            // (maybe you changed API keys recently)
            $errMessage    =   $e->getMessage();
        } catch (\Stripe\Error\ApiConnection $e) {
            // Network communication with Stripe failed
            $errMessage    =   $e->getMessage();
        } catch (\Stripe\Error\Base $e) {
            // Display a very generic error to the user, and maybe send
            // yourself an email
            $errMessage    =   $e->getMessage();
        } catch (\Stripe\Exception $e) {
            // Something else happened, completely unrelated to Stripe
            $errMessage    =   $e->getMessage();
        }catch(Exception $e){
            $errMessage    =   $e->getMessage();
        }
        return redirect()->route('check')->withError($errMessage);
    }

    public function accountResponse(){
        $errMessage    =   "";
        try{
            $user = Auth::user();
            $stripe = new \Stripe\StripeClient('sk_test_51LicFNFkV20vz5IvJAd9bcT6sMycEJeD8xdFG81Uzf3cyOJZYjacfP2sQ6ReUdaLYJLsq5VkDhFAtf2oNCktolvm00gXjMn7iA');
            $user_stripe_account =  $stripe->accounts->retrieve($user->stripe_connect_id);
            if(!empty($user_stripe_account) && isset($user_stripe_account->id)){
                if($user_stripe_account->charges_enabled == 1){
                    $strip_message = "";
                    if($user_stripe_account->payouts_enabled == 1){
                        $user->stripe_account_status = 'active';
                        $user->save();
                        $strip_message = "Your bank account link successfully";
                        return Redirect::route('add_auction')->with('success',$strip_message);
                        
                    }else{
                        $user->stripe_account_status = 'in_process';
                        $user->save();
                        $strip_message = "Your bank account verification is still incomplete.Please fill all the details and documents.";
                        return Redirect::route('check')->with('warning',$strip_message);
                    }
                }else{
                    $errMessage = "Your bank account verification process is not completed yet!";
                }
            }else{
                $errMessage = "Opps Something went wrong!";
            }
        } catch(\Stripe\Exception\CardException $e) {
            $errMessage    =   $e->getMessage();
        } catch (\Stripe\Error\InvalidRequest $e) {
            // Invalid parameters were supplied to Stripe's API
            $errMessage    =   $e->getMessage();
        } catch (\Stripe\Error\Authentication $e) {
            // Authentication with Stripe's API failed
            // (maybe you changed API keys recently)
            $errMessage    =   $e->getMessage();
        } catch (\Stripe\Error\ApiConnection $e) {
            // Network communication with Stripe failed
            $errMessage    =   $e->getMessage();
        } catch (\Stripe\Error\Base $e) {
            // Display a very generic error to the user, and maybe send
            // yourself an email
            $errMessage    =   $e->getMessage();
        } catch (\Exception $e) {
            // Something else happened, completely unrelated to Stripe
            $errMessage    =   $e->getMessage();
        }
        if(empty($errMessage)){
            $errMessage = "Something went wrong!";
        }
        return redirect()->route('check')->with('error',$errMessage);
    }
}
