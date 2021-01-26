<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Constants;

class Transaction extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $dates   = ['deleted_at'];
    protected $table   = "transactions";
    protected $guarded = [];    

    public function transaction_items() {
      return $this->hasMany(TransactionItem::class);
    }

    public function customer() {
      return $this->belongsTo(Customer::class);
    }

    public function discount(){
      return $this->belongsTo(Discount::class);
    }

    public function total_capital_price() {
      $total_capital_price = 0;
      foreach($this->transaction_items as $item) {
        $total_capital_price += ($item->capital_price * $item->quantity);
      }
      return $total_capital_price;
    }

    public function total_selling_price() {
      $total_selling_price = 0;
      foreach($this->transaction_items as $item) {
        $total_selling_price += ($item->selling_price * $item->quantity);
      }
      return $total_selling_price;
    }

    public function total_discount() {
      $discount = $this->discount;
      
      if($discount) {
        if ($discount->type === Constants::$PERCENTAGE) {
          return ($this->total_selling_price() / 100) * $discount->amount;
        } else {
          return $discount->amount;
        }
      }
      return 0;
    }

    public function total_price() {
      $total_price = 0;
      foreach($this->transaction_items as $item) {
        $total_price += ($item->selling_price * $item->quantity);
      }
      $total_price -= $this->total_discount();
      $total_price += $this->total_ongkir;
      return $total_price;
    }

    public function change() {
      return $this->total_paid - $this->total_price();
    }
}
