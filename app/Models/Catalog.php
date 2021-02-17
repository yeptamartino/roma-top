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

  public function prices() {
    return $this->hasMany(CatalogPrice::class);
  }

  public function get_total_stock_by_warehouse_id($warehouse_id) {
      $total_stock = 0;
      foreach($this->stocks as $stock) {
          if($stock->warehouse_id == $warehouse_id) {
              $total_stock = $stock->total;
          }
      }
      return $total_stock;
  }

	public static $validation = [
		'name'            => 'required|string|min:2',
		'capital_price'   => 'required|integer|min:1',
		'thumbnail'       => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
  ];
}
