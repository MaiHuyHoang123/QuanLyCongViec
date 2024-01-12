<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Job extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'jobs';
    protected $fillable = [
        'id',
        'name',
        'desc',
        'content',
        'start_file',
        'start_time',
        'end_time',
        'complete_file',
        'prioritize',
        'status',
        'flag'
    ];
}
