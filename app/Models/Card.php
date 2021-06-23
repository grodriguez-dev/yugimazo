<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    use HasFactory;

     protected $fillable = [
        'name',
        'skill',
        'type',
        'atk',
        'def',
        'image',
        'mazo_id'
    ];

   public function mazo () {
      return $this->belongsTo('App\Models\Mazo');
   }
}
