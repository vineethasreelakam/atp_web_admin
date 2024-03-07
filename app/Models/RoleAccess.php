<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

use Hash;

class RoleAccess extends Model
{
    protected $table = 'role_access';
    protected $fillable = [
        'role_id',
        'privillege_id',
        'form_id',
        'type',
        'status',
        'created_at',
        'updated_at'
    ];
   
   
    
}