<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $dates   = ['deleted_at'];
    protected $table   = "warehouses";
    protected $guarded = [];

    public function stock()
    {
        return $this->hasMany(Stock::class);
    }

    public static $validation = [
        'name'      => 'required|string|min:5',
        'address'   => 'required|string|min:5',
        'thumbnail' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',

    ];
}
