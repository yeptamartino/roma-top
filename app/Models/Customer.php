<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $dates   = ['deleted_at'];
    protected $table   = "customers";
    protected $guarded = [];

    public static $validation = [
	    'name'        => 'required|string|min:5',
        'address'     => 'required|string|min:5',
        'email'       => 'required|string|min:5',
        'phone'       => 'required|string|min:10',
        'thumbnail'   => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ];
    
    public static $validationUpdate = [
		'name'        => 'string|min:5',
        'address'     => 'string|min:5',
        'email'       => 'string|min:1',
        'phone'       => 'string|min:10',
        'thumbnail'   => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
	];
}
