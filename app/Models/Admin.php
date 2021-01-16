<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $with = ['users'];

    public static function getValidation($idExcepted = null) {
        if($idExcepted) {
          return [
            'name' => 'required|string|min:1',
            'email' => 'email|unique:users,email,' . $idExcepted,
            'address' => 'required|string|min:5',
            'phone' => 'required|string|min:10|max:13|unique:users,phone,'. $idExcepted,
            'password' => 'nullable|min:8',
            'thumbnail' => 'image|mimes:jpeg,png,jpg,gif,gif,svg|max:2048',
          ];
        }
        return [
            'name' => 'required|string|min:1',
            'email' => 'email|unique:users,email',
            'address' => 'required|string|min:5',
            'phone' => 'required|string|min:10|max:13|unique:users,phone',
            'password' => 'string|min:8',
            'thumbnail' => 'image|mimes:jpeg,png,jpg,gif,gif,svg|max:2048',
        ];
      }

}
