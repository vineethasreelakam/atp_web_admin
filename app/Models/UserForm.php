<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

use Hash;

class UserForm extends Model
{
    protected $table = 'user_form';
    protected $fillable = [
        'user_id',
        'form_id',
        'status',
        'created_at',
        'updated_at'
    ];
   
   
    
}