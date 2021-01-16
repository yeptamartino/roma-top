<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Catalog extends Model
{
    use HasFactory;
	use SoftDeletes;
	protected $dates   = ['deleted_at'];
	protected $table   = "catalogs";
	protected $guarded = [];

	public function product_category()
	{
		return $this->belongsTo(ProductCategory::class);
	}

	public static $validation = [
		'name'            => 'required|string|min:5',
        'descriptions'    => 'required|string|min:5',
        'selling_price'   => 'required|string|min:5',
		'capital_price'   => 'required|string|min:1',
		'thumbnail'       => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
	];
}
