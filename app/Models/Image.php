<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;


    protected $fillable = ["url"];

    //revisa el .env tiene que ser public en vez de local donde se va a guardar imagenes

    //relacion polimorfica

    public function imageable(){
        return $this->morphTo();
    }
}
