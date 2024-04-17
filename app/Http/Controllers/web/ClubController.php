<?php

namespace App\Http\Controllers\web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Models\{User,Product,ProductImage,Payment,PrductVariation,PrductVariationOption,OrderItem};
use Mail,Hash,File,Http,DB,Auth,Session,Stripe;
use Carbon\Carbon;
use Illuminate\Validation\Rule;

class ClubController extends Controller
{

//Start Club Moduel//    
    public function ClubAdd(){
        try {
            $data= "";
            return view('web.dashboard.product-add',compact('data'));
        } catch (\Throwable $e) {
            return back()->withInput()->withError("something went wrong");

        }
    }

    public function ClubStore(Request $request){
        $data = $request->all();
        
        if($data['product_discount'] && $data['product_price'] <= $data['product_discount']){
          return back()->withInput()->withError("The Discount price must be lessthen than the original price.");
        }
        $request->validate([
            'product_name' => [
                'required',
                Rule::unique('products', 'product_name')->where('business_id', auth()->user()->id),
            ],
            'product_price' => 'required|numeric|min:0.01',
           // 'product_discount' => 'numeric',
            'product_quantity' => 'required|numeric',
            'product_sku' => 'required',
            'product_stock' => 'required',
         //   'product_description' => 'required',
            'image' => 'required',
          //  'terms' => 'required',
            'sort_description' => 'required',
        ]);
        try {
            if (isset($data['size']) && $data['size'] !== "") {
                $sizes = json_encode($data['size']);
            } else {
                $sizes = "";
            }
            if (isset($data['product_color']) && $data['product_color'] !== "") {
                $colors = json_encode($data['product_color']);
            } else {
                $colors = "";
            }

            $fixedAmount = $data['product_price'] - ($data['product_price'] * ($data['product_discount']/100));
            $product = new Product;
            $product->product_name = $data['product_name'];
            $product->business_id = auth()->user()->id;
            $product->product_price = $data['product_price'];
            $product->product_discount = $data['product_discount'];
            $product->fixed_amount = $fixedAmount;
            $product->product_quantity = $data['product_quantity'];
            $product->product_sku = $data['product_sku'];
            $product->product_stock = $data['product_stock'];
            $product->terms = $data['terms'];
            $product->sort_description = $data['sort_description'];
            $product->product_description = $data['product_description'];
            $product->meta_title = $data['meta_title'];
            $product->meta_description = $data['meta_description'];
            // $product->size =$data['size'];
            // $product->product_color = $data['product_color'];
            $product->save();
            $product_images = $request->file('image');
            if ($request->hasFile('image')) {
                foreach($product_images as $product_image) {
                    $name = md5(time().rand(11111111,99999999)).'.'.$product_image->getClientOriginalExtension();
                    $product_image->move('product_image/', $name);
                    $car_img['product_id'] = $product->id;
                    $car_img['image'] = $name;
                    $auction_image = ProductImage::create($car_img);
                }

            }
            $sizes = explode(',', $data['size']);
            $colors = explode(',', $data['product_color']);
            if($data['size'] != ''){
                foreach ($sizes as $size) {
                        PrductVariationOption::create([
                            'product_id' => $product->id,
                            'type' => 'size',
                            'option' => $size,

                            ]);
                }
            }
            if($data['product_color'] != ''){
                foreach ($colors as $color) {
                    PrductVariationOption::create([
                        'product_id' => $product->id,
                        'option' => $color,
                        'type' => 'color',
                    ]);
                }
            }

            if($data['size'] != ''){
                foreach ($sizes as $size) {
                    foreach ($colors as $color) {
                        PrductVariation::create([
                            'product_id' => $product->id,
                            'size' => $size,
                            'color' => $color,
                            'quantity' => '0',
                            'price' => $product->product_price,
                            'discount_price' => $product->product_discount,
                        ]);
                    }
                }
            }elseif ($data['product_color'] != '') {
                foreach ($colors as $color) {
                    PrductVariation::create([
                        'product_id' => $product->id,
                        'size' => '',
                        'color' => $color,
                        'quantity' => '0',
                        'price' => $product->product_price,
                        'discount_price' => $product->product_discount,s
                    ]);
                }
            }else{}

            if($data['product_color'] != '' || $data['size'] != ''){
                return redirect()->route('product_variation_edit', $product->id)->withSuccess('Product Added Successfully. Please Update Product Variation.');
            }else{
                return redirect()->route('product_list')->withSuccess('Product Added Successfully!.');
            }
        } catch (\Throwable $e) {
            return back()->withInput()->withError("something went wrong");

        }
    }

    public function ClubList(){
        try {
            $data = Product::where('business_id',auth()->user()->id)->orderBy('id','DESC')->paginate(10);
           
            return view('web.dashboard.product-list',compact('data'));
        } catch (\Throwable $e) {
            return back()->withInput()->withError("something went wrong");
        }
    }

   
    
    
    public function ClubVariationEdit(Request $request,$slug){

        try {
            $data = Product::where('id',$slug)->first();
             return view('web.dashboard.edit-product-variation',compact('data'));
        } catch (\Throwable $e) {
            return back()->withInput()->withError("something went wrong");

        }
    }
    
    

    public function ClubVariationUpdate(Request $request,$slug){
        $data = $request->all();
        try {
            $product = Product::where('slug',$slug)->first();
           // dd($product->product_quantity);
            $queintity = array_sum($data['queintity']);
            if($product->product_quantity < $queintity){
                return back()->withInput()->withError("The product variation quantity must be less then the product quantity.");
            }
            foreach ($data['variation_id'] as $key => $variation) {
                if($data['price'][$key] <= 0){
                    return back()->withInput()->withError("The price must be greater than 0");
                }
                if($data['discount_price'][$key] && $data['price'][$key] <= $data['discount_price'][$key]){
                  return back()->withInput()->withError("The Discount price must be lessthen than the original price.");
                }
                  $variation = PrductVariation::where('id',$variation)->first();
                  $variation->quantity = $data['queintity'][$key];
                  $variation->price = $data['price'][$key];
                  $variation->discount_price = $data['discount_price'][$key] ?? '0';
                  $variation->update();

            }
            return redirect()->route('product_list')->withSuccess('Product Variation Updated Successfully!.');

        } catch (\Throwable $e) {
            dd($e);
            return back()->withInput()->withError("something went wrong");
        }
    }

    public function ClubVariationRemove(Request $request){
        $data = $request->all();
       try {
            PrductVariation::where('id',$data['id'])->delete();
            return response()->json(['success' => true]);
        } catch (\Throwable $e) {
            return back()->withInput()->withError("something went wrong");

        }
    }

    public function ClubEdit(Request $request,$slug){
        try {
            $data = Product::where('id',$slug)->first();
      
            return view('web.dashboard.product-add',compact('data'));

        } catch (\Throwable $e) {
            return back()->withInput()->withError("something went wrong");

        }
    }

   

    public function ClubUpdate(Request $request,$slug){
        $data = $request->all();
        if($data['product_discount'] && $data['product_price'] <= $data['product_discount']){
            return back()->withInput()->withError("The Discount price must be lessthen than the original price.");
        }
        $request->validate([
            'product_name' => [
                'required',
                Rule::unique('products', 'product_name')
            ->where('business_id', auth()->user()->id)
            ->ignore($data['product_id']),
            ],
            
            'product_price' => 'required|numeric|min:0.01',
            //'product_discount' => 'numeric',
            'product_quantity' => 'required|numeric',
            'product_sku' => 'required',
            'product_stock' => 'required',
        //    'product_description' => 'required',
      //      'terms' => 'required',
            'sort_description' => 'required',
        ]);
        try {
           
            DB::beginTransaction();
            $fixedAmount = $data['product_price'] - ($data['product_price'] * ($data['product_discount']/100));
            $product = Product::where('slug',$slug)->first();
            $productvariation = PrductVariation::where('product_id',$product->id)->sum('quantity');
            if($data['product_quantity'] < $productvariation){
                return back()->withInput()->withError("The product quantity must be less then the product variation quantity.");
            }
            $product->product_name = $data['product_name'];
            $product->business_id = auth()->user()->id;
            $product->product_price = $data['product_price'];
            $product->product_discount = $data['product_discount'];
            $product->fixed_amount = $fixedAmount;
            $product->product_quantity = $data['product_quantity'];
            $product->product_sku = $data['product_sku'];
            $product->product_stock = $data['product_stock'];
            $product->product_description = $data['product_description'];
            $product->terms = $data['terms'];
            $product->sort_description = $data['sort_description'];
            $product->meta_title = $data['meta_title'];
            $product->meta_description = $data['meta_description'];
            //$product->product_color = $data['product_color'];
            //$product->size = $data['size'];
            $product->update();
            $product_images = $request->file('image');
            if ($request->hasFile('image')) {
                $id = Product::where('slug',$slug)->first();
                ProductImage::where('product_id',$id->id)->delete();
                foreach($product_images as $product_image) {
                    $name = md5(time().rand(11111111,99999999)).'.'.$product_image->getClientOriginalExtension();
                    $product_image->move('product_image/', $name);
                    $product_image = productImage::updateOrCreate([
                      'product_id' => $id->id,
                      'image' => $name,
                  ]);
                }
            }
            //Prduct Variation Option Upadte  //
            $sizes = explode(',',$data['size']);
            $colors = explode(',',$data['product_color']);
            $all_product_varioation = array();
            if($data['size'] != '' && $data['product_color'] != ''){
                foreach ($sizes as $size) {
                    foreach($colors as $color){
                        $product_variation = PrductVariation::where('product_id', $product->id)->where('color', $color)->where('size', $size)->first();
                        if($product_variation){
                            array_push($all_product_varioation,$product_variation->id);
                        }else{
                            $product_variation = PrductVariation::create([
                                'product_id' => $product->id,
                                'size' => $size,
                                'color' => $color,
                                'quantity' => '0',
                                'price' => $product->product_price,
                                'discount_price' => $product->product_discount,

                            ]);
                            array_push($all_product_varioation,$product_variation->id);
                        }
                    }
                }
            }elseif($data['size'] != ''){
                foreach ($sizes as $size) {
                    $product_variation = PrductVariation::where('product_id', $product->id)->where('size', $size)->where('color','')->first();
                    if($product_variation){
                        array_push($all_product_varioation,$product_variation->id);
                    }else{
                        $product_variation = PrductVariation::create([
                            'product_id' => $product->id,
                            'size' => $size,
                            'quantity' => '0',
                            'price' => $product->product_price,
                            'discount_price' => $product->product_discount,
                        ]);
                        array_push($all_product_varioation,$product_variation->id);
                    }
                }
            }elseif($data['product_color'] != ''){
                foreach ($colors as $color) {
                    $product_variation = PrductVariation::where('product_id', $product->id)->where('color', $color)->where('size','')->first();
                    if($product_variation){
                        array_push($all_product_varioation,$product_variation->id);
                    }else{
                        $product_variation = PrductVariation::create([
                            'product_id' => $product->id,
                            'color' => $color,
                            'quantity' => '0',
                            'price' => $product->product_price,
                            'discount_price' => $product->product_discount,
                        ]);
                        array_push($all_product_varioation,$product_variation->id);
                    }
                }
            }else{
                PrductVariation::where('product_id',$product->id)->delete();
                PrductVariationOption::where('product_id',$product->id)->delete();
            }
            PrductVariationOption::where('product_id',$product->id)->delete();
            PrductVariation::where('product_id',$product->id)->whereNotIn('id',$all_product_varioation)->delete();
            if($data['product_color'] != ''){
                foreach ($colors as $color) {
                    PrductVariationOption::create([
                        'product_id' => $product->id,
                        'type' => 'color',
                        'option' => $color,
                    ]);
                }
            }
            if($data['size'] != ''){
                foreach ($sizes as $size) {
                    PrductVariationOption::create([
                        'product_id' => $product->id,
                        'type' => 'size',
                        'option' => $size,
                    ]);
                }
            }
            DB::commit();
            
            if($data['product_color'] != '' || $data['size'] != ''){
                return redirect()->route('product_variation_edit', $product->id)->withSuccess('Product Updated Successfully. Please Update Product Variation.');
            }else{
                return redirect()->route('product_list')->withSuccess('Product Updated Successfully!.');
            }
        } catch (\Throwable $e) {
            DB::rollback();
            return back()->withInput()->withError("something went wrong");
        }
    }

    public function ClubRemove(Request $request){
        try {
            $delete = Product::destroy($request->product_id);
            if ($delete == 1) {
                $message = "Product deleted successfully.";
            } else {
                $message = "Product not found.";
            }
        return redirect()->route('product_list')->withSuccess($message);
        } catch (\Throwable $e) {
            return back()->withInput()->withError("something went wrong");

        }
    }

    public function ClubHistory(){
        try {
            $data = Payment::where('type', 'product')
            ->where('destination', Auth::user()->stripe_connect_id)
            ->orderBy('id','DESC')
            ->paginate(14);
            return view('web.dashboard.product-history',compact('data'));
        } catch (\Throwable $th) {
            return back()->withInput()->withError("something went wrong");
        }
    }

    public function ClubHistoryDetails(Request $request,$id){
        try {
            $data = Payment::with('getproductOrderItem')->where('id', $id)->where('type', 'product')
            ->where('destination', Auth::user()->stripe_connect_id)
            ->first();
            $item = OrderItem::where('order_id',$data->booking_id)->where('type','product')->get();
            // dd($data);
            return view('web.dashboard.product-history-details',compact('data','item'));
        } catch (\Throwable $th) {
            return back()->withInput()->withError("something went wrong");
        }
    }
    
//End Club Moduel//    



}
