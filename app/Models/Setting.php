<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    protected $table   = "settings";
    protected $guarded = [];
    public static $validation = [
        'point_ratio'  => 'required|string|min:1',
        'logo'   => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
	];

    
}
