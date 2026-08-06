<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KerusakanGedung extends Model
{
    use HasFactory;

    protected $table = 'kerusakan_gedungs';
    protected $guarded = [];
}