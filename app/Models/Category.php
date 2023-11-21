<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

   // protected $table = "nombre de la tabla en tu bd"; esto lo usas en todo caso no respetes la nomenclatura de tabla y modelo con laravel asi q forzosamente usas el $table para escribir con que tabla se vinculara

    protected $fillable = ["name","slug"];

    public function getRouteKeyName(){
        return "slug";
    }

     //relacion 1 a muchos
     public function posts(){
        return $this->hasMany(Post::class);
    }
}
