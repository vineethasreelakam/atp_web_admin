<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

use Hash;

class Role extends Model
{
    protected $table = 'role_master';
    protected $primaryKey = 'id';
    protected $fillable = [
        'title',
        'admin',
        'status',
        'created_at',
        'updated_at'
    ];
   
     
    public function Privilleges(){
        return $this->hasmany('App\Models\RoleAccess', 'role_id','id')->where('type','privillege');
    }
     
     public function Forms(){
        return $this->hasmany('App\Models\RoleAccess', 'role_id','id')->where('type','form');
    }
}