<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $dates   = ['deleted_at'];
    protected $table   = "payment_methods";
    protected $guarded = [];

    public static $validation = [
		'name' => 'required|string|min:3',
	];
}
