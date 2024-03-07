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
use App\Models\Country;
use App\Models\Blog;
use App\Models\Banner;
use Hash;
use Validator;

  
class ApiController extends Controller
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
    
     public function countries_get(Request $request) {
        $datas = Country::get();
        $newdata =[];
        $collect =[];
        foreach ($datas as $data) {
                $collect['country_id'] =  encrypt($data['country_id']);
                $collect['name'] =  encrypt($data['name']);
                $collect['currency'] =  encrypt($data['currency']);
                $collect['currency_symbol'] =  encrypt($data['currency_symbol']); 
                $collect['enable_currency'] =  encrypt($data['enable_currency']);
                $collect['status'] =  encrypt($data['status']);
                 # code...
                $newdata[] = $collect;
                
        }
        //$newdata = $collect[]; 
        return response()->json([
            'message' => 'Data Fetched!',
            'data'    =>$newdata
        ], 201);

    }
 



     public function categories_get()
    {
      //dd("kkk");
        $categories = Category::with('children')
            ->where('sub_of','=','null')
            ->get();

        // $categories1 =   encrypt($categories);

        return response()->json($categories);
    }

    

     public function products_get()
    {
        //dd("kkk");
        $datas = Product::select('title','id')->with('CoreImages','AccountPrice')
            ->get();

        // $categories1 =   encrypt($categories);

        return response()->json($datas);
    }

    public function product_details(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'product_id' => 'required',
            //'password' => 'required|string|min:6',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        //dd("kkk");
        $datas = Product::with('CoreImages','ProductVariation.Variation','AccountPrice')
            ->where('id',$request->product_id)->latest()->first();

        // $categories1 =   encrypt($categories);

        return response()->json($datas);
    }

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

            $data['user_id'] =Auth::user()->id;
            $data['variations'] =json_encode($request->variations);
            $data['product_price'] =@$productData['AccountPrice']->price;
            $data['total_product_price'] =@$productData['AccountPrice']->price *$request->quantity ;
            $data['date'] =date("Y-m-d");
            $data['tax_per_1'] =@$productData['AccountPrice']->tax_per_1;
            $data['tax_per_2'] =@$productData['AccountPrice']->tax_per_2;


            $cart = OrderCart::create($data);
            if($cart){

                return response()->json([
                    'message' => 'Cart Added successfully',
                    'cart' => $cart
                ], 201);

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
    public function homepage(Request $request)


    {
        $banners= array(

                            'img_url'=>  'https://serena.luxe/web/images/banner1.png' ,
                            'img_url2'=> 'https://serena.luxe/web/images/banner2.png' ,
                            'img_url3'=>'https://serena.luxe/web/images/banner3.png' ,
                            'img_url4'=>   'https://serena.luxe/web/images/sample-video.mp4'
                        );
       // $banner[]=[];
        $items = array();
        foreach ($banners as $key=>$value) {
            $items[][$key] = $value;
        }

        $blogs = array([
            "id"=>"1",
            "title"=> "title 1",
            "content"=> "content 1",
            "img_url"=> "https://serena.luxe/web/images/homepro-1.png",
            "link"=> "https://sepiastories.in/sustainability-slow-fashion/"
        ],[
            "id"=> "2",
            "title"=> "title 2",
            "content"=> "content 2",
            "img_url"=> "https://serena.luxe/web/images/homepro-2.png",
            "link"=> "https://sepiastories.in/why-handmade-cotton-clothing-is-now-trending/"
        ],[

            "id"=> "3",
            "title"=> "title 2",
            "content"=> "content 2",
            "img_url"=> "https://serena.luxe/web/images/homepro-3.png",
            "link"=> "https://sepiastories.in/why-zero-waste-fashion-is-our-future/"
        ],[
            "id"=>"4",
            "title"=> "title 4",
            "content"=> "content 4",
            "img_url"=> "https://serena.luxe/web/images/homepro-4.png",
            "link"=> "https://thefashionguitar.com/2019/10/15/moda-operandi-the-platform-where-you-will-discover-fashion/"
        ],[
            "id"=> "5",
            "title"=> "title 5",
            "content"=> "content 5",
            "img_url"=> "https://serena.luxe/web/images/homepro-5.png",
            "link"=> "https://thefashionguitar.com/2019/10/07/beautiful-fall-with-hilfiger-collection/"
        ],[
            "id"=> "6",
            "title"=> "title 6",
            "content"=> "content 6",
            "img_url"=> "https://serena.luxe/web/images/homepro-6.png",
            "link"=> "https://thefashionguitar.com/2019/08/31/how-khaite-converted-me-to-a-more-minimal-way-of-dressing/"
        ]);
        $ddd= $blogs;
       // dd(json_encode($blogs));

           

        return response()->json(['banner'=>$items,'blog_post'=>$ddd]);

    }

    public function homepagenew(Request $request)
    {
       $items = Banner::select('img_url','img_url4','img_url2','img_url3')->first();
       $ddd    = Blog::select('id','title','content','link','img_url')->get();
         return response()->json(['banner'=>$items,'blog_post'=>$ddd]);
    }


    


    
       

    

    

    

    

    







    
     
}