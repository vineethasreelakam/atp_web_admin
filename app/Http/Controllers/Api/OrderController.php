<?php
  
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\OrderCart;
use App\Models\OrderUserAddress;
use App\Models\Order;
use App\Models\OrderProduct;
use Hash;
use Validator;

  
class OrderController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    /*public function index()
    {
        return view('auth.login');
    }  

     public function products_get()
    {
    }*/

    
     public function cart_add(Request $request)
    {
         //dd(auth::user()->id);
        $validator = Validator::make($request->all(), [
            'product_id' => 'required',
            'quantity' => 'required',
             'country_id' => 'required',
              'variations' => 'required',


        ]);
        $errors = $validator->errors()->all() ;
        
        $err='';
        if ($validator->fails()) {

            foreach ($errors as $key=>$error) {
                $err =$err." ".$error;
                }
            return response()->json(['errors'=>$err,422]);
            
        }
        $data = $request->all();

        $productData = Product::with('AccountPrice')
            ->where('id',$request->product_id)->latest()->first();

           // dd($productData['AccountPrice']->price);
        if($request->action == 1){
            $data['user_id'] =Auth::user()->id;
            $data['variations'] =json_encode($request->variations);
            $data['product_price'] =@$productData['AccountPrice']->price;
            $data['total_product_price'] =@$productData['AccountPrice']->price *$request->quantity ;
            $data['date'] =date("Y-m-d");
            $data['tax_per_1'] =@$productData['AccountPrice']->tax_per_1;
            $data['tax_per_2'] =@$productData['AccountPrice']->tax_per_2;
            $data['status'] =2;


            $cart = OrderCart::create($data);
            if($cart){

                return response()->json([
                    'message' => 'Cart Added successfully',
                    'cart' => $cart
                ], 201);

            }

        }
        if($request->action == 2){

            $data['quantity'] =$request->quantity;
            $data['variations'] =json_encode($request->variations);
            $data['product_price'] =@$productData['AccountPrice']->price;
            $data['total_product_price'] =@$productData['AccountPrice']->price *$request->quantity ;
           // $data['date'] =date("Y-m-d");
            //$data['tax_per_1'] =@$productData['AccountPrice']->tax_per_1;
           // $data['tax_per_2'] =@$productData['AccountPrice']->tax_per_2;
            $cart_id = $request->cart_id;

             $cartUpdate=OrderCart::where('cart_id',$cart_id) ->update($data);


           // $cart = OrderCart::create($data);
            if($cartUpdate){

                return response()->json([
                    'message' => 'Cart Updated successfully',
                    'cart' => $cartUpdate
                ], 201);

            }

        }

         if($request->action == 3){

            $cart_id = $request->cart_id;
            $cartDelete = OrderCart::where('cart_id',$cart_id)->delete();
           if($cartDelete){

                return response()->json([
                    'message' => 'Cart Deleted successfully',
                    
                ], 201);

            }
         }


            

        

       
       // $datas = Product::with('CoreImages','ProductVariation.Variation','AccountPrice')
           // ->where('id',$request->product_id)->latest()->first();

        // $categories1 =   encrypt($categories);

        //return response()->json($datas);
    }

     public function cart_list(Request $request)
    {

        
        if(!Auth::user()){
             return response()->json([
                    'message' => 'User Unauthenticated',
                   
                ], 201);
         }
         $user_id =Auth::user()->id;
         $cart = OrderCart::with('Product','Product.AccountPrice')->where('user_id',$user_id)->get();
         if($cart){

                return response()->json([
                    'message' => 'Data Fetched!',
                    'cart' => $cart
                ], 201);

            }





    }

    public function address_action(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'action' => 'required',
           
        ]);
        $errors = $validator->errors()->all() ;
        
        $err='';
        if ($validator->fails()) {

            foreach ($errors as $key=>$error) {
                $err =$err." ".$error;
                }
            return response()->json(['errors'=>$err,422]);
            
        }
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;

        if($request->action == 1){
             $add  = OrderUserAddress::create($data);
              if($add){

                return response()->json([
                    'message' => 'Data Added!',
                    'cart' => $add
                ], 201);

            }
        }
        if($request->action == 2){
            $validator = Validator::make($request->all(), [
            'user_address_id' => 'required',
           
                ]);
                if ($validator->fails()) {
                    return response()->json($validator->errors(), 422);
                }

            $user_address_id  = $request->user_address_id;

            $dataUpdate=OrderUserAddress::where('user_address_id',$user_address_id)->update($data);


           // $cart = OrderCart::create($data);
            if($dataUpdate){

                return response()->json([
                    'message' => 'Address Updated successfully',
                    'cart' => $dataUpdate
                ], 201);

            }
        }

        if($request->action == 3){
            $validator = Validator::make($request->all(), [
            'user_address_id' => 'required',
           
                ]);
                if ($validator->fails()) {
                    return response()->json($validator->errors(), 422);
                }

            $user_address_id  = $request->user_address_id;
            $dataUpdate=OrderUserAddress::where('user_address_id',$user_address_id)->update(['status'=>3]);

            $dataDelete=OrderUserAddress::where('user_address_id',$user_address_id)->delete();


       
            if($dataDelete){

                return response()->json([
                    'message' => 'Address Deleted successfully',
                    'cart' => $dataDelete
                ], 201);

            }
        }
    }

     public function address_list(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
           
        ]);
        $errors = $validator->errors()->all() ;
        
        $err='';
        if ($validator->fails()) {

            foreach ($errors as $key=>$error) {
                $err =$err." ".$error;
                }
            return response()->json(['errors'=>$err,422]);
            
        }
        $user_id = Auth::user()->id;
        $data  = OrderUserAddress::where('user_id', $user_id)->get();
        return response()->json([
                    'message' => 'Data Fetched!',
                    'data' => $data
                ], 201);



    }

      public function place_order(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_address_id' => 'required'
           
        ]);
        $errors = $validator->errors()->all() ;
        
        $err='';
        if ($validator->fails()) {

            foreach ($errors as $key=>$error) {
                $err =$err." ".$error;
                }
            return response()->json(['errors'=>$err,422]);
            
        }

        $user_id = Auth::user()->id;
        $user_address_id = $request->user_address_id;
        $address_data =OrderUserAddress::where('user_address_id', $user_address_id)->first();

        $cartDatas = OrderCart::where('user_id', $user_id)->get();
        $total_product_price =0;
        $total_tax_price =0;
        $total_price =0;
        

        foreach ($cartDatas as $cartData) {

            $order['user_id'] =$cartData['user_id'];
            $order['product_id'] =$cartData['product_id'];
            $order['quantity'] =$cartData['quantity'];
            $order['date'] =$cartData['date'];
            $order['product_price'] =$cartData['product_price'];
            $order['total_product_price'] =$cartData['total_product_price'];
            $order['tax_per_1'] =$cartData['tax_per_1'];
            $order['tax_per_2'] =$cartData['tax_per_2'];
            $order['total_tax_price'] =$cartData['total_tax_price'];
            $order['total_price'] =$cartData['total_price'];
            $order['variations'] =$cartData['variations'];
            $order['status'] =$cartData['status'];

            OrderProduct::create($order);
            $total_product_price +=$cartData['total_product_price'];
            $total_tax_price +=$cartData['total_tax_price'];
            $total_price +=$cartData['total_price'];

            
            # code...
        }
        //return ($total_product_price ."and  ".$total_tax_price." total price".$total_price);

        $user_id = Auth::user()->id;

        $order['name']  = $address_data->name;
        $order['address_1']  = $address_data->address_1;
        $order['address_2']  = $address_data->address_2;
        $order['city']  = $address_data->city;
        $order['state']  = $address_data->state;
        $order['pincode']  = $address_data->pincode;
        $order['mobile_no']  = $address_data->mobile_no;
        $order['total_product_price']  = $total_product_price;
        $order['total_tax']  = $total_tax_price;
        $order['total_price']  = $total_price;
        $order['user_id']  = $user_id;
        $order['status']  = 0;
        
        
        

        //$order['state']  = $address_data->state;

   

        $data  = Order::create($order);
        return response()->json([
                    'message' => 'Data Fetched!',
                    'data' => $data
                ], 201);






    }

    

    
       

    

    

    

    

    







    
     
}