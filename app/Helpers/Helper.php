<?php



namespace App\Helpers;

use Auth,Session;

use App\Models\{User,Cart,Faq,BusinessInfo,HomeSecation,Notification,EventReminder,AboutSecation,HeaderSecation,HeaderSecationAppend,FooterAddressSecation,FooterSecation,Payment};



class Helper

{



    public static function AllUserCount(){

        $user = User::whereNot('role',"admin")->count();

        return $user;

    }



    public static function GetFaqData(){

        $faq = Faq::orderBy('id','DESC')->get();

    }



    public static function GetProfilePrcentage(){

        $binfo = BusinessInfo::where('business_id',auth()->user()->id)->first();

        if($binfo->instagram || $binfo->facebook || $binfo->twitter || $binfo->linkedin){

            return 20;

        }

    }



    public static function GetHomePrcentage(){

        $homesecation = HomeSecation::where('business_id',auth()->user()->id)->first();

        

        if($homesecation){

            return 30;

        }

     

    }



    public static function GetEventReminder(){

        if(Auth::check()){

            return EventReminder::where('business_id',auth()->user()->id)->get();



        }

        return EventReminder::where('business_id',0)->get();

      

    }

    public static function GetAllNotification(){

        if(Auth::check()){

            return Notification::where('target_id',auth()->user()->id)->where('read_at','0')->orderBy('id','DESC')->paginate(5);
        }
        return 0;
    }

    public static function checkHomeSecation($id=null){

        if(Auth::check()){

            return HomeSecation::where('business_id',auth()->user()->id)->first();
        }elseif($id){
            return HomeSecation::where('business_id',$id)->first();

        }else{
            return 0;
        }
    }



    public static function Getheaderlogo(){

        $slug = request('username');
     

        $user = User::where('slug',$slug)->first();

        if($user){

            

            $banner = AboutSecation::where('business_id',$user->id)->where('secation_type','header_secation')->first();

            return $banner;

        }

        return AboutSecation::where('business_id',0)->where('secation_type','header_secation')->first();

      

    }

    public static function GetCompanyPoratalheader(){

        $slug = request('username');

        $user = User::where('slug',$slug)->first();

        if($user){

            $header = HeaderSecation::where('business_id',$user->id)->orderBy('order','ASC')->get();

            return $header;

        }

        return HeaderSecation::where('business_id',0)->get();

    }

    public static function GetCompanyPoratalheaderAppend(){

        $slug = request('username');

        $user = User::where('slug',$slug)->first();

        if($user){

            $appnedheader = HeaderSecationAppend::where('business_id',$user->id)->orderby('order','ASC')->get();

            return $appnedheader;

        }

        return HeaderSecationAppend::where('business_id',0)->get();

    }



    public static function GetCompanyPoratalFooterEmail(){

        $slug = request('username');

        $user = User::where('slug',$slug)->first();

        if($user){

                $appnedheader = FooterAddressSecation::where('business_id',$user->id)->whereNotNull('email')->get();

                return $appnedheader;

        }

        return FooterAddressSecation::where('business_id',0)->get();

    }



    public static function GetCompanyPoratalFooterPhone(){

        $slug = request('username');

        $user = User::where('slug',$slug)->first();

        if($user){

            $appnedheader = FooterAddressSecation::where('business_id',$user->id)->whereNotNull('number')->get();

            return $appnedheader;

        }

        return FooterAddressSecation::where('business_id',0)->get();

    }



    public static function GetCompanyPoratalFooterSecationFirst(){

        $slug = request('username');

        $user = User::where('slug',$slug)->first();

        if($user){

            $secationfirst = FooterSecation::where('business_id',$user->id)->where('key','second_secation')->orderBy('order','ASC')->get();

            return $secationfirst;

        }

        return FooterSecation::where('business_id',0)->get();

    }



    public static function GetCompanyPoratalFooterSecationSecond(){

        $slug = request('username');

        $user = User::where('slug',$slug)->first();

        if($user){

            $secationSecond = FooterSecation::where('business_id',$user->id)->where('key','secation_third')->orderBy('order','ASC')->get();

            return $secationSecond;

        }

        return FooterSecation::where('business_id',0)->get();

    }



    public static function GetCompanyPoratalMediasecation(){

        $slug = request('username');

        $user = User::where('slug',$slug)->first();

        if($user){

            $media  = BusinessInfo::where('business_id',$user->id)->first();

            return $media ;

        }

        return BusinessInfo::where('business_id',0)->get();

    }



    public static function GetcartCount(){

        return Cart::where('session_id', Session::getId())->get();

    }

    
    public static function ExpirationDate($date,$month)
    {
        
        $expirationDate = $date;
        $newDate = $expirationDate->addMonths($month);

        $lastDayOfMonth = $newDate;
        $formattedExpirationDate = $lastDayOfMonth->format('Y-m-d');
        return $formattedExpirationDate;
    }
   

    

}



