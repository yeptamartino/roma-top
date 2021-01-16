<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;
	use SoftDeletes;
	protected $dates   = ['deleted_at'];
	protected $table   = "stocks";
	protected $guarded = [];

	public function catalog()
	{
		return $this->belongsTo(Catalog::class);
    }
    
    public function warehouse()
	{
		return $this->belongsTo(Warehouse::class);
	}

	public static $validation = [
		'total' => 'required|string|min:1',
	];
}
