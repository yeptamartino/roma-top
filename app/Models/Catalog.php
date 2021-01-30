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

	public function category()
	{
		return $this->belongsTo(Category::class);
	}

	public function stocks()
  {
      return $this->hasMany(Stock::class);
  }

  public function composite_catalogs()
  {
    return $this->belongsToMany(Catalog::class, 'composites', 'catalog_id', 'composite_id')->with('stocks');
  }

  public function composites() {
    return $this->hasMany(Composite::class);
  }

	public static $validation = [
		'name'            => 'required|string|min:5',
		'description'     => 'required|string|min:5',
		'selling_price'   => 'required|integer|min:1',
		'capital_price'   => 'required|integer|min:1',
		'thumbnail'       => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
  ];
}
