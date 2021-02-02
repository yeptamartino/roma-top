<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $dates   = ['deleted_at'];
    protected $table   = "categories";
    protected $guarded = [];

    public function catalogs()
    {
        return $this->hasMany(Catalog::class);
    }

    public static $validation = [
        'name' => 'required|string|min:5',

    ];

}