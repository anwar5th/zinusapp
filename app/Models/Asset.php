<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * 
     */
    protected $fillable = [
        'asset_id', 'type', 'location','department','name','manufacture','atribut'
    ];
}
