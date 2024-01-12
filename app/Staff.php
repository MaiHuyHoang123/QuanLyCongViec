<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class Staff extends Model implements AuthenticatableContract
{
    use HasFactory,Authenticatable;
    public $timestamps = false;
    protected $table = 'staffs';
    protected $guarded = [];
    public static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            // Chuyển đổi trường password thành Bcrypt nếu có thay đổi
            if ($model->isDirty('password')) {
                $model->password = Hash::make($model->password);
            }
        });
    }
}
