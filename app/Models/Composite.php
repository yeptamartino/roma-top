<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Composite extends Model
{
    use HasFactory;

    public function catalog() {
        return $this->belongsTo(Catalog::class);
    }

    public function item() {
        return $this->belongsTo(Catalog::class, 'composite_id', 'id');
    }

    public function get_total_stock_by_warehouse_id($warehouse_id) {
        $total_stock = 0;
        foreach($this->item->stocks as $stock) {
            if($stock->warehouse_id == $warehouse_id) {
                $total_stock = $stock->total;
            }
        }
        return $total_stock;
    }
}
