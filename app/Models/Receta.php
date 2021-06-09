<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receta extends Model
{
    use HasFactory;
    // protected $gard
    protected $guarded = [];

    // optiene la categoria de la receta via FK
    public function categoria()
    {
        return $this->belongsTo( Categoria::class );
    }

    public function user()
    {
        return $this->belongsTo( User::class );
    }

    public function likes()
    {
        return $this->belongsToMany( User::class, 'like_receta' );
    }
}
