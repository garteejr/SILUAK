<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Atk extends Model
{
    use HasFactory;

    protected $table = 'atk';
    protected $guarded = [];
    protected $casts = [
    'items' => 'array',
];

}