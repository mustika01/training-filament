<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $fillable=[
        'name_c', 
        'email_c', 
        'phone_c', 
        'born_c', 
    ];

    protected $casts = [
        'born_c' => 'datetime',
    ];
}
