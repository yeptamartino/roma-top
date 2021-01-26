<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;
    protected $table   = "discounts";
    protected $guarded = [];

    public static $validation = [
		'name'         => 'required|string|min:5',
        'description'  => 'required|string|min:5',
        'type'         => 'required|string|min:1',
		'amount'       => 'required|string|min:1',
	];
}
