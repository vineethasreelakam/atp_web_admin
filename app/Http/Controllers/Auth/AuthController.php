<?php
  
namespace App\Http\Controllers\Auth;
  
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Models\User;
use App\Models\AccountSystemUser;

use Hash;
use Validator;
  
class AuthController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index()
    {
        return view('auth.login');
    }  
      
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function registration()
    {
        return view('auth.register');
    }
      
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function postLogin(Request $request)
    {
       /* $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
   
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
          
             return view('dashboard');
           
        }*/
        //dd("jjj");



        if(Auth::guard('web')->attempt($request->only(['email', 'password'])))
        {
            $user=Auth::guard('web')->user();
            if($user->type=='super_admin'){
                session(['user_id' => Auth::guard('web')->user()->system_user_id,'user_name'=>Auth::guard('web')->user()->name]);
                $userId = session('user_id');
                return redirect()->route('user');
            }
            else{
                return redirect()
                ->back()
                ->withErrors(['msg' => 'Invalid Admin']);
    
            }
          
        }else{
            return redirect()
            ->back()
            ->withErrors(['msg' => 'Invalid Username or Password']);

        }

       
  
       /* return redirect("login")->withSuccess('Oppes! You have entered invalid credentials');*/
    }
      
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function postRegistration(Request $request)
    {  
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:account_system_users',
            'password' => 'required|min:6',
        ]);
           
        $data = $request->all();

        AccountSystemUser::create([
            'name' => $data['name'],
            'email' => $data['email'],
           // 'member_code' => $data['member_code'],
            'password' => Hash::make($data['password']),
        ]);


       // $check = $this->create($data);


         
        return redirect("dashboard")->withSuccess('Great! You have Successfully loggedin');
    }
    
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function dashboard()
    {
       //if(Auth::check()){
            //dd("hhh");
        if(Auth::guard('web')){

           //dd(Auth::guard('admin')->user());

           
            return view('dashboard');
        }
  
        //return redirect("login")->withSuccess('Opps! You do not have access');
    }
    
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function create(array $data)
    {
      return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password'])
      ]);
    }
    
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function logout() {
        Session::flush();
        Auth::guard('web')
            ->logout();
  
        return Redirect('login');
    }

    public function changePassword(Request $request) {

        return view('auth.passwords.changePassword');
    }

    public function password_reset(Request $request) {
        // dd("ppp");
         # Validation
         
 
         $validator = Validator::make($request->all(), [
             'old_password' => 'required',
             'new_password' => 'required',
         ]);
         $errors = $validator->errors()->all() ;
         
         $err='';
         if ($validator->fails()) {
 
             foreach ($errors as $key=>$error) {
                 $err =$err." ".$error;
                 }
             return redirect()->back()->with('error', "current password and new password required.");
             
         }
 
         
 
          //dd((auth()->user()));
 
         #Match The Old Password
         if(!Hash::check($request->old_password, auth()->user()->password)){
             //dd("jj");
             return redirect()->back()->with('error', "Sorry current password is wrong.");
            // return back()->with("error", "Old Password Doesn't match!");
         }
 
 
         #Update the new Password
         User::whereId(auth()->user()->id)->update([
             'password' => Hash::make($request->new_password)
         ]);
 
         return redirect()->back()->with('success', "Successfully changed your password.");
 
         //return back()->with("status", "Password changed successfully!");
 
     }
}