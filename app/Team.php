<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Team extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'teams';
    protected $fillable = [
        'id',
        'name',
    ];
}
