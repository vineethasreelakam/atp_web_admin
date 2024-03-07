<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\Role;
use App\Models\Privillege;
use App\Models\Form;
//use App\Models\RoleAccess;
use App\Models\UserAccess;
use App\Models\UserForm;


class AdminController extends Controller
{

    public function index() 
    {
        $pageLimit=20;
        $data['paginationRoute']="admin"; 
    	$data['listData'] = User::where('admin','1')->paginate($pageLimit);
        return view('admin.index',$data);
    }
    public function create(Request $request) 
    {
        $input=$request->all();
        $data['formData']=new User;
        $data['role']=Role::where('admin','1')->get();
        $data['roleMaster']=new Role;
        $data['privilleges']=Privillege::get();
        $data['forms']=Form::get();
        //print_r($data['role']);exit;
        if(isset($input['id'])){
            //$data['formData']=Role::find($input['id']);
            $user=User::with('Privilleges','Forms')->find($input['id']);
            $data['roleMaster']=Role::find($user->role_id);
            $data['formData']=$user;
            //Print_r($data['roleMaster']);exit;
        }
        return view('admin.create',$data);
    }
    public function store(Request $request) 
    {
        $input=$request->all();
        //print_r($input);exit;
        if(isset($input['id'])){
            $user=User::find($input['id']);
            $user->name=$input['name'];
            $user->email=$input['email'];
            $user->role_id=$input['role_id'];
            $user->admin=$input['admin'];
            $user->update();

            UserAccess::where('user_id',$input['id'])->where('type','privillege')->delete();
            UserForm::where('user_id',$input['id'])->delete();

            if(isset($input['privilleges'])){
                foreach($input['privilleges'] as $val){
                    $data['user_id']=$user->id;
                    $data['privillege_id']=$val;
                    $data['type']="privillege";
                    UserAccess::create($data);
                }
            }

            if(isset($input['forms'])){
                foreach($input['forms'] as $val){
                    $data['user_id']=$user->id;
                    $data['form_id']=$val;
                    $data['status']="1";
                    UserForm::create($data);
                }
            }
            $message="Successfully Updated";
        }
        else{
            
            $input['admin']='1';
            $input['password']=$this->random_strings(6);
            $input['type']='admin';
            $user=User::create($input);
            $message="Successfully Saved";

            $roleDetails=Role::with('Privilleges','Forms')->where('id',$input['role_id'])->first();
            if($roleDetails->Privilleges){
                foreach($roleDetails->Privilleges as $val){
                    $data['privillege_id']=$val->privillege_id;
                    $data['user_id']=$user->id;
                    $data['type']="privillege";
                    UserAccess::create($data);
                }
            }

            if($roleDetails->Forms){
                foreach($roleDetails->Forms as $val){
                    $data['user_id']=$user->id;
                    $data['form_id']=$val->form_id;
                    $data['status']="1";
                    UserForm::create($data);
                }
            }

        }
        
        return redirect()->route('admin')->with('message',$message);
    }

    public function destroy(Request $request,$id)
    {
        $user=User::find($id);
        $user->delete();
        UserAccess::where('user_id',$id)->delete();
        UserForm::where('user_id',$id)->delete();
        $message="Successfully Deleted the Record";
        return redirect()->route('admin')->with('deleteMessage',$message);
    }

    public function changeStatus(Request $request,$id)
    {
        $user=User::find($id);
        if($user->status==1){
            $user->status='0';
        }
        else{
            $user->status='1';
        }
        $user->save();
        $message="Successfully Changed Status";
        return redirect()->route('admin')->with('message',$message);
    }

    public function random_strings($length_of_string)
    {
  
     // String of all alphanumeric character
     $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
  
     // Shuffle the $str_result and returns substring
     // of specified length
     return substr(str_shuffle($str_result),
                        0, $length_of_string);
    }
     
}