<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

use Hash;

class Privillege extends Model
{
    protected $table = 'privillege_master';
    protected $fillable = [
        'title',
        'value',
        'status',
        'created_at',
        'updated_at'
    ];
    
}