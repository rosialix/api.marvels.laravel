<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Comic extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_comics',
        'title',
        'thumbnail',
        'creators',
        'stories',
    ];
    //Relaciones
    // public function favoritos(): HasMany{
    //     return $this->hasMany(related:Favorito::class);
    // }
}
