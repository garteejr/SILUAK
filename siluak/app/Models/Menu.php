<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = [
        'nama_layanan',
        'slug',
        'icon',
        'is_active'
    ];
} 
