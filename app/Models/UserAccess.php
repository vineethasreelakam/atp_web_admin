<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

use Hash;

class UserAccess extends Model
{
    protected $table = 'user_access';
    protected $fillable = [
        'user_id',
        'privillege_id',
        'tournament_id',
        'type',
        'created_at',
        'updated_at'
    ];
   
   
    
}