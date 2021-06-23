<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mazo extends Model
{
    use HasFactory;

    protected $fillable = [
        'player_id',
        'title',
    ];

    public function player () {
        return $this->belongsTo('App\Models\Player');
    }

    public function cards () {
        return $this->hasMany('App\Models\Card');
    }
}
