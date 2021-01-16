<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'address',
        'phone',
        'role',
        'thumbnail',
        'password',
    ];

    public static function getValidation($idExcepted = null) {
        if($idExcepted) {
          return [
            'name' => 'required|string|min:5',
            'email' => 'email|unique:users,email,' . $idExcepted,
            'address' => 'required|string|min:5',
            'phone' => 'required|string|min:10|max:13|unique:users,phone,'. $idExcepted,
          ];
        }
        return [
          'name' => 'required|string|min:5',
          'email' => 'email|unique:users,email',
          'address' => 'required|string|min:5',
          'phone' => 'required|string|min:10|max:13|unique:users,phone',
        ];
      }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
