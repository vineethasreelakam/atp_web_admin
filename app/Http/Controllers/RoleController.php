<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Role;
use App\Models\Privillege;
use App\Models\Form;
use App\Models\RoleAccess;


class RoleController extends Controller
{

    public function index() 
    {
        $pageLimit=20;
        $data['paginationRoute']="role"; 
    	$data['listData'] = Role::with('Privilleges','Forms')->orderBy('id','desc')->paginate($pageLimit);
    	//print_r($data['listData']);exit;
        return view('role.index',$data);
    }
    public function create(Request $request) 
    {
        $input=$request->all();
        $data['formData']=new Role;
        $data['privilleges']=Privillege::get();
        $data['forms']=Form::get();

        if(isset($input['id'])){
            //$data['formData']=Role::find($input['id']);
            $data['formData']=Role::with('Privilleges','Forms')->find($input['id']);
            //Print_r($data['formData']);exit;
        }
        return view('role.create',$data);
    }
    public function store(Request $request) 
    {
        $input=$request->all();

        if(isset($input['id'])){
            $role=Role::find($input['id']);
            $role->title=$input['title'];
            $role->update();
            
            RoleAccess::where('role_id',$role->id)->where('type','privillege')->delete();
            RoleAccess::where('role_id',$role->id)->where('type','form')->delete();

            if(isset($input['privilleges'])){
                foreach($input['privilleges'] as $val){
                    $data['role_id']=$role->id;
                    $data['privillege_id']=$val;
                    $data['type']="privillege";
                    RoleAccess::create($data);
                }
            }

            if(isset($input['forms'])){
                foreach($input['forms'] as $val){
                    $data['role_id']=$role->id;
                    $data['form_id']=$val;
                    $data['type']="form";
                    RoleAccess::create($data);
                }
            }
            
            $message="Successfully Updated";
        }
        else{
            $role=Role::create(["title"=>$input['title']]);
            if(isset($input['privilleges'])){
                foreach($input['privilleges'] as $val){
                    $privillegedata['role_id']=$role->id;
                    $privillegedata['privillege_id']=$val;
                    $privillegedata['type']="privillege";
                    RoleAccess::create($privillegedata);
                }
            }
            if(isset($input['forms'])){
                foreach($input['forms'] as $val){
                    $formdata['role_id']=$role->id;
                    $formdata['form_id']=$val;
                    $formdata['type']="form";
                    RoleAccess::create($formdata);
                }
            }
            $message="Successfully Saved";
        }
        
        return redirect()->route('role')->with('message',$message);
    }

    public function destroy(Request $request,$id)
    {
        $role=Role::find($id);
        $role->delete();
        $roleAccess=RoleAccess::where('role_id',$id)->delete();
        $message="Successfully Deleted the Record";
        return redirect()->route('role')->with('deleteMessage',$message);
    }

     
}