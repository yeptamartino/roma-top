<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;
	use SoftDeletes;
	protected $dates   = ['deleted_at'];
	protected $table   = "users";
	protected $guarded = [];

	public static $validation = [
	'name'     => 'required|string|min:5',
    'email'    => 'required|string|min:5',
    'phone'    => 'required|string|min:10',
	'address'  => 'required|string|min:1',
    'password' => 'required|string|min:6',
	'thumbnail'=> 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
  ];
  
  public static $validationUpdate = [
	'name'     => 'required|string|min:5',
    'email'    => 'required|string|min:5',
    'phone'    => 'required|string|min:10',
	'address'  => 'required|string|min:1',
	'thumbnail'=> 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
	];
    
}
