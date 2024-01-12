<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Role extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'roles';
    protected $fillable = [
        'id',
        'name',
        'display_name'
    ];
}
