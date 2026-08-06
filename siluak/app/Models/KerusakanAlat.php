<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KerusakanAlat extends Model
{
    use HasFactory;

    protected $table = 'kerusakan_alats';
    protected $guarded = [];
}