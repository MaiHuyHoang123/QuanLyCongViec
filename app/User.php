<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class User extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'users';
    protected $fillable = [
        'id',
        'role_id',
        'name',
        'email',
        'avatar',
        'password',
        'team_id',
    ];
}
